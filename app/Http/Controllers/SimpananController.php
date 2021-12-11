<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Anggota;
use Session;
use \Carbon\Carbon;
use App\Models\User;
use Illuminate\Validation\Rule;
use Redirect;
use Illuminate\Support\Facades\Auth;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'Anggota') {
            $user = Anggota::where('id_user',Auth::user()->id)->first();
            $simpanan = Simpanan::where('id_anggota',$user->id_anggota)->get();
            $simpanan_anggota = Simpanan::where('id_anggota',$user->id_anggota)->latest()->first();
            return view('view_anggota.simpanan',['simpanan' => $simpanan,'simpanan_anggota' => $simpanan_anggota]);
            
        }
        //
        $simpanan = Simpanan::join('anggotas','simpanans.id_anggota','=','anggotas.id_anggota')->get();
        $anggota = Anggota::join('users', 'anggotas.id_user', '=', 'users.id')->where('users.status_akun','terdaftar')->get();
        return view('simpanan',['anggota' => $anggota]);
        

    }
    
    public function PilihJenisTransaksi($id)
    {   
        $simpanan_anggota = Simpanan::where('id_anggota',$id)->latest()->first();
        $simpanan = Simpanan::where('id_anggota',$id)->get();
        $simpanan_anggota = Simpanan::where('id_anggota',$id)->latest()->first();
        return view('pilih_jenis_transaksi',['id' => $id,'simpanan_anggota' => $simpanan_anggota,'simpanan' => $simpanan,'simpanan_anggota' => $simpanan_anggota]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {   
        $validate = $request->validate([
            'jenis_transaksi' => 'required|'.Rule::in(['Debit', 'Kredit']),
        ]);
        
        Session::put('jenis_transaksi', $request->jenis_transaksi);
        
        return view('tambah_simpanan',['id' => $id]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $tanggal_sekarang = Carbon::now();
        $jenis_transaksi = Session::get('jenis_transaksi');
        $validate = $request->validate([
            'nominal_jenis_transaksi' => 'numeric|digits_between:4,9|required',
        ]);

        $simpanan_anggota = Simpanan::where('id_anggota',$id)->latest()->first();

        if ($simpanan_anggota == null) {
            $tambah_simpanan = Simpanan::create([
                'id_anggota' => $id,
                'kredit' => $request->nominal_jenis_transaksi,
                'saldo' => $request->nominal_jenis_transaksi,
                'tanggal_transaksi' => $tanggal_sekarang,
                'jenis_transaksi' => $jenis_transaksi
            ]);
        }

        else {
            
            
            if ($jenis_transaksi == 'Kredit') {

                $saldo = $simpanan_anggota->saldo + $request->nominal_jenis_transaksi;
            $tambah_simpanan = Simpanan::create([
                'id_anggota' => $id,
                'kredit' => $request->nominal_jenis_transaksi,
                'saldo' => $saldo,
                'tanggal_transaksi' => $tanggal_sekarang,
                'jenis_transaksi' => $jenis_transaksi
            ]);
        }
        if ($jenis_transaksi == 'Debit') {
            $saldo = $simpanan_anggota->saldo - $request->nominal_jenis_transaksi;
            if ($saldo <= 0) {
                return redirect('simpanan/'.$id)->with(['danger' => 'Saldo Anggota Kurang Anggota Harus Menambah Saldo Dengan Transaksi Kredit Terlebih Dahulu']);
            }
            
            $tambah_simpanan = Simpanan::create([
                'id_anggota' => $id,
                'debit' => $request->nominal_jenis_transaksi,
                'saldo' => $saldo,
                'tanggal_transaksi' => $tanggal_sekarang,
                'jenis_transaksi' => $jenis_transaksi
            ]);
        }
        
    }
        Session::forget('jenis_transaksi');
        return redirect('simpanan/'.$id)->with(['success' => 'Simpanan Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $simpanan_anggota = Simpanan::where('id_anggota',$id)->latest()->first();

        $anggota = Anggota::where('id_anggota',$id)->first();
        $simpanan = Simpanan::where('id_anggota',$id)->get();

        return view('rincian_simpanan',['anggota' => $anggota,'simpanan' => $simpanan,'simpanan_anggota' => $simpanan_anggota]);

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
