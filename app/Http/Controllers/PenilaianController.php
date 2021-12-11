<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Penilaian;
use App\Models\Karyawan;
use \Carbon\Carbon;
use App\Models\PenilaianSikap;
use Redirect;
use App\Models\PenilaianKolektif;
use App\Models\PenilaianSholat;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role == 'Karyawan') {
            $user = Karyawan::where('id_user',Auth::user()->id)->first();
            $penilaian_sikap = PenilaianSikap::join('penilaians','penilaian_sikaps.id_penilaian','=','penilaians.id_penilaian')->where('penilaians.id_karyawan',$user->id_karyawan)->get();
            $penilaian_sholat = PenilaianSholat::join('penilaians','penilaian_sholats.id_penilaian','=','penilaians.id_penilaian')->where('penilaians.id_karyawan',$user->id_karyawan)->get();
            $penilaian_kolektif = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')
                                                    ->join('pembayarans','penilaian_kolektifs.id_pembayaran','=','pembayarans.id_pembayaran')
                                                    ->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')
                                                    ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')
                                                    ->where('penilaians.id_karyawan',$user->id_karyawan)->get();
            return view('view_karyawan.penilaian',['karyawan' => $user,'penilaian_sikap' => $penilaian_sikap,'penilaian_sholat' => $penilaian_sholat,'id' => $user->id_karyawan,'penilaian_kolektif' => $penilaian_kolektif]);

        }

        $karyawan = Karyawan::join('users', 'karyawans.id_user', '=', 'users.id')->get();

        return view('penilaian',['karyawan' => $karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function TambahPenilaianSholat($id)
    {
        //
        $karyawan = Karyawan::join('users', 'karyawans.id_user', '=', 'users.id')->where('id_karyawan',$id)->first();
        return view('tambah_penilaian_sholat',['id' => $id,'karyawan' => $karyawan]);
    }
    
    public function TambahPenilaianSikap($id)
    {
        //
        $karyawan = Karyawan::join('users', 'karyawans.id_user', '=', 'users.id')->where('id_karyawan',$id)->first();
        return view('tambah_penilaian_sikap',['id' => $id,'karyawan' => $karyawan]);
    }

    public function SimpanPenilaianSikap(Request $request,$id){
        //

        $validate = $request->validate([
            'nilai' => 'required|in:A,B,C,D,E,F',
        ]);
        
        $tanggal_sekarang = Carbon::now();
        $cek_penilaian = PenilaianSikap::join('penilaians','penilaian_sikaps.id_penilaian','=','penilaians.id_penilaian')
        ->where('penilaians.id_karyawan',$id)
        ->whereMonth('penilaian_sikaps.created_at',Carbon::now()->format('m'))
        ->count();

        if ($cek_penilaian >= 1) {
            return redirect('penilaian/'.$id.'/tambah-penilaian-sikap')->with(['danger' => 'Penilaian Sikap Gagal Ditambahkan - Penilaian Sikap Bulan Ini Sudah Ditambahkan']);
        }

        $id_karyawan = Karyawan::where('id_karyawan',$id)->first();
        $tanggal_penilaian = Carbon::now()->format('Y-m');
        $penilaian = Penilaian::where('id_karyawan',$id)
        ->whereMonth('tanggal_penilaian',Carbon::now()->format('m'))
        ->whereYear('tanggal_penilaian',Carbon::now()->format('Y'))
        ->first();

            $nilai = '';
            if ($request->nilai == "A") {
                $nilai = "100";
             }
             elseif ($request->nilai == "B") {
                 $nilai = "080";
             }
             elseif ($request->nilai == "C") {
                 $nilai = "060";
             }
             elseif ($request->nilai == "D") {
                 $nilai = "040";
             }
             elseif ($request->nilai == "E") {
                 $nilai = "020";
             }

        if ($penilaian == null) {

            $tambah_penilaian =  Penilaian::create([
                'id_karyawan' => $id,
                'tanggal_penilaian' => $tanggal_sekarang,
            ]);
            
            $request->request->add(['id_penilaian' => $tambah_penilaian->id_penilaian]);
            
            $penilaian_sikap = PenilaianSikap::create([
                'id_penilaian' => $request->id_penilaian,
                'nilai' => $request->nilai,
            ]);
        }
        elseif ($penilaian->count() >= 1) {
                $penilaian_sikap = PenilaianSikap::create([
                    'id_penilaian' => $penilaian->id_penilaian,
                    'nilai' => $request->nilai
                ]);

            }

        return redirect('penilaian/'.$id)->with(['success' => 'Penilaian Sikap Berhasil Ditambahkan']);
    }

    public function SimpanPenilaianSholat(Request $request,$id)
    {
        //
        $validate = $request->validate([
            'subuh' => 'in:1|nullable',
            'dzuhur' => 'in:1|nullable',
            'ashar' => 'in:1|nullable',
            'maghrib' => 'in:1|nullable',
            'isya' => 'in:1|nullable',
            'sunnah' => 'in:1|nullable',
        ]);

        $cek_penilaian_sholat_harian = PenilaianSholat::join('penilaians','penilaian_sholats.id_penilaian','=','penilaians.id_penilaian')
        ->where('penilaians.id_karyawan',$id)
        ->whereDate('penilaian_sholats.created_at',Carbon::now())
        ->count();

        $penilaian_sholat = PenilaianSholat::join('penilaians','penilaian_sholats.id_penilaian','=','penilaians.id_penilaian')
        ->where('penilaians.id_karyawan',$id)
        ->whereMonth('penilaians.tanggal_penilaian',Carbon::now()->format('m'))
        ->whereYear('penilaians.tanggal_penilaian',Carbon::now()->format('Y'))
        ->first();
        
        if ($cek_penilaian_sholat_harian >= 1) {
            return redirect('penilaian/'.$id.'/tambah-penilaian-sholat')->with(['danger' => 'Penilaian Sholat Gagal Ditambahkan - Penilaian Sholat Hari Ini Sudah Ditambahkan']);
        }

        $tanggal_sekarang = Carbon::now();
        $id_karyawan = Karyawan::where('id_karyawan',$id)->first();
        $tanggal_penilaian = Carbon::now()->format('Y-m');
        $penilaian = Penilaian::where('id_karyawan',$id)
        ->whereMonth('tanggal_penilaian',Carbon::now()->format('m'))
        ->whereYear('tanggal_penilaian',Carbon::now()->format('Y'))
        ->first();
        
        $o = "00";
        $nilai_sholat1 = $request->subuh + $request->dzuhur + $request->ashar + $request->maghrib + $request->isya + $request->sunnah;
        if ($penilaian == null) {
             $tambah_penilaian =  Penilaian::create([
                'id_karyawan' => $id,
                'tanggal_penilaian' => $tanggal_sekarang,
            ]);

            $request->request->add(['id_penilaian' => $tambah_penilaian->id_penilaian]);
    
            $tambah_penilaian_sholat = PenilaianSholat::create([
                'id_penilaian' => $request->id_penilaian,
                'subuh' => $request->subuh,
                'dzuhur' => $request->dzuhur,
                'ashar' => $request->ashar,
                'maghrib' => $request->maghrib,
                'isya' => $request->isya,
                'sunnah' => $request->sunnah,
            ]);
            
        }
            elseif ($penilaian->count() >= 1) {
                $tambah_penilaian_sholat = PenilaianSholat::create([
                    'id_penilaian' => $penilaian->id_penilaian,
                    'subuh' => $request->subuh,
                    'dzuhur' => $request->dzuhur,
                    'ashar' => $request->ashar,
                    'maghrib' => $request->maghrib,
                    'isya' => $request->isya,
                    'sunnah' => $request->sunnah,
                ]);
                
               
            }
        
        return redirect('penilaian/'.$id)->with(['success' => 'Penilaian Sikap Berhasil Ditambahkan']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $karyawan = Karyawan::join('users', 'karyawans.id_user', '=', 'users.id')->where('id_karyawan',$id)->first();

        $penilaian_sikap = PenilaianSikap::join('penilaians','penilaian_sikaps.id_penilaian','=','penilaians.id_penilaian')->where('penilaians.id_karyawan',$id)->get();
        $penilaian_sholat = PenilaianSholat::join('penilaians','penilaian_sholats.id_penilaian','=','penilaians.id_penilaian')->where('penilaians.id_karyawan',$id)->get();
        $penilaian_kolektif = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')
                                                ->join('pembayarans','penilaian_kolektifs.id_pembayaran','=','pembayarans.id_pembayaran')
                                                ->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')
                                                ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')
                                                ->where('penilaians.id_karyawan',$id)->get();

        return view('rincian_penilaian',['karyawan' => $karyawan,'penilaian_sikap' => $penilaian_sikap,'penilaian_sholat' => $penilaian_sholat,'id' => $id,'penilaian_kolektif' => $penilaian_kolektif]);
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
