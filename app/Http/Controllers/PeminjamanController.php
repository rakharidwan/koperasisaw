<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Karyawan;
use App\Models\Pinjaman;
use App\Models\Penilaian;
use App\Models\PenilaianKolektif;
use App\Models\Pembayaran;
Use \Carbon\Carbon;
use DateTime;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role == 'Anggota') {
            $user = Anggota::where('id_user',Auth::user()->id)->first();
            $peminjaman = Peminjaman::where('peminjamans.peminjam',$user->id_anggota)
            ->where('peminjamans.status','Belum Lunas')
            ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')
            ->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')
            ->latest('peminjamans.created_at')
            ->firstOrNew();
  
            $pembayaran = Pembayaran::where('id_peminjaman',$user->id_anggota)->get();
            return view('view_anggota.peminjaman',['peminjaman' => $peminjaman,'pembayaran' => $pembayaran]);
        }

        $peminjaman = Peminjaman::join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')->get();
        
        return view('peminjaman',['peminjaman' => $peminjaman]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $anggota = Anggota::join('users','anggotas.id_user','=','users.id')->where('users.status_akun','terdaftar')->get();
        $pinjaman = Pinjaman::get();

        return view('tambah_peminjaman',['anggota' => $anggota,'pinjaman' => $pinjaman]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $validate = $request->validate([
            'peminjam' => 'required|exists:anggotas,id_anggota',
            'pinjaman' => 'required|exists:pinjamans,id_pinjaman'
        ]);

        $peminjaman_belum_lunas = Peminjaman::where('peminjam',$request->peminjam)->where('status','Belum Lunas')->get();

        if (count($peminjaman_belum_lunas) >= 1) {
            return redirect('peminjaman/tambah')->with(['danger' => 'Anggota Belum Melunasi Peminjaman Sebelumnya']);
        }
        
        $tanggal_sekarang = Carbon::now();
        $penambahan_waktu_jatuh_tempo = Carbon::now()->addWeeks(1);
        $jatuh_tempo =  date('Y-m-5', strtotime($penambahan_waktu_jatuh_tempo));
        $peminjaman = Peminjaman::create([
            'peminjam' => $request->peminjam,
            'id_pinjaman' => $request->pinjaman,
            'tanggal_pinjam' => $tanggal_sekarang,
            'jatuh_tempo' => $jatuh_tempo,
            'status' => 'Belum Lunas',
        ]);
        return redirect('/peminjaman')->with(['success' => 'Berhasil Menambahkan Data Peminjaman Anggota']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        
        $peminjaman = Peminjaman::where('peminjamans.id_peminjaman',$id)->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')->first();
        $pembayaran = Pembayaran::where('id_peminjaman',$id)->get();
        
        return view('rincian_peminjaman',['peminjaman' => $peminjaman,'pembayaran' => $pembayaran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bayar($id)
    {
        //
        $tanggal_sekarang = Carbon::now()->format('W-Y');
        $peminjaman = Peminjaman::where('id_peminjaman',$id)->first();
        $pembayaran = Pembayaran::where('id_peminjaman',$id)->first();

        $rincian_peminjaman = Peminjaman::where('peminjamans.id_peminjaman',$id)->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')->first();
        $rincian_pembayaran = Pembayaran::where('id_peminjaman',$id)->get();

        $tanggal_bayar = pembayaran::where('id_peminjaman',$id)->latest()->first();

        if ($tanggal_bayar == null) {
            return view('pembayaran',['id' => $id,'rincian_peminjaman' => $rincian_peminjaman,'rincian_pembayaran' => $rincian_pembayaran]);
        }

        if (date('W-Y', strtotime($tanggal_bayar->tanggal_pembayaran)) == $tanggal_sekarang) {
            return Redirect::back()->with(['danger' => 'Anggota Sudah Melakukan Pembayaran Minggu Ini']);
        }

        if ($peminjaman->status == 'Lunas') {
            return redirect('/peminjaman/rincian/'.$id)->with(['danger' => 'Peminjaman Ini Telah Lunas']);
        }


        return view('pembayaran',['id' => $id,'rincian_peminjaman' => $rincian_peminjaman,'rincian_pembayaran' => $rincian_pembayaran]);
       
    }
    
    public function pembayaran(Request $request,$id)
    {
        //
        $waktu_sekarang = Carbon::now();
        $pembayaran_minggu_ini = Pembayaran::where('id_peminjaman',$id)->whereBetween('tanggal_pembayaran', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->first(); 
        // Pembayaran Gagal Karena Sudah Membayaran Cicilan Mingguan
            if ($pembayaran_minggu_ini > [0]) {
                return Redirect::back()->with(['danger' => 'Anggota Sudah Melakukan Pembayaran Minggu Ini']);
            }

        $peminjaman = Peminjaman::where('id_peminjaman',$id)->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')->first();
        $anggota = Anggota::where('id_anggota',$peminjaman->peminjam)->first();

        $pembayaran_terakhir = Pembayaran::where('id_peminjaman',$id)->latest()->first();
        $jatuh_tempo = Carbon::parse($peminjaman->tanggal_pinjam)->addWeeks(1)->format('d-m-Y');

        if ($pembayaran_terakhir > [0]) {
            $jatuh_tempo = Carbon::parse($pembayaran_terakhir->tanggal_pembayaran)->addWeeks(1)->format('d-m-Y');
        }

        $jumlahhariterlambat = '0';
        if ($waktu_sekarang->format('d-m-Y') > $jatuh_tempo) {
            $jumlahhariterlambat = Carbon::parse($jatuh_tempo->format('d-m-Y'))->diffInDays($waktu_sekarang);
        }


        $pembayaran = Pembayaran::create([
            'id_peminjaman' => $id,
            'tanggal_pembayaran' => $waktu_sekarang,
            'total_pembayaran' => $peminjaman->cicilan,
            'terlambat' => $jumlahhariterlambat,
        ]);

               
        $id_karyawan = Karyawan::where('id_user',Auth::user()->id)->first();
        $request->request->add(['id_pembayaran' => $pembayaran->id_pembayaran]);
        $tanggal_penilaian = Carbon::now()->format('Y-m-d');

        $penilaian = Penilaian::where('id_karyawan',$id_karyawan->id_karyawan)
            ->whereMonth('tanggal_penilaian',Carbon::now()->format('m'))
            ->whereYear('tanggal_penilaian',Carbon::now()->format('Y'))
            ->first();

        $penilaian_kolektif = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')
            ->where('id_karyawan',$id_karyawan->id_karyawan)
            ->whereMonth('tanggal_penilaian',Carbon::now()->format('m'))
            ->whereYear('tanggal_penilaian',Carbon::now()->format('Y'))->count();

        $total_pembayaran = Pembayaran::where('id_peminjaman',$id)->sum('total_pembayaran');

        if ($total_pembayaran >= $peminjaman->jumlah_pinjaman) {
            $update_status = Peminjaman::where('id_peminjaman',$id)->update([
            'status' => 'Lunas',]);
        }

        if ($waktu_sekarang->format('d-m-Y') > $jatuh_tempo) {
            if ($penilaian == null) {
                    $tambah_penilaian =  Penilaian::create([
                        'id_karyawan' => $id_karyawan->id_karyawan,
                        'tanggal_penilaian' => $waktu_sekarang,
                    ]);
                
                    $request->request->add(['id_penilaian' => $tambah_penilaian->id_penilaian]);

                    $kolektif = PenilaianKolektif::create([
                        'id_penilaian' => $request->id_penilaian,
                        'id_pembayaran' => $request->id_pembayaran,
                    ]);
                }
                elseif ($penilaian->count() >= 1) {
                    $kolektif = PenilaianKolektif::create([
                        'id_penilaian' => $penilaian->id_penilaian,
                        'id_pembayaran' => $request->id_pembayaran,
                    ]);
                    
                }
        }

        return redirect('/peminjaman/rincian/'.$id)->with(['primary' => 'Pinjaman '.$anggota->nama.' ( '.$anggota->nik.' ) '.'Telah Dibayar Sebesar Rp. '.number_format($peminjaman->cicilan,0,'.','.')]);
    }

    public function history($id){
        
        $peminjaman = Peminjaman::where('peminjamans.peminjam',$id)
        ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')
        ->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')
        ->get();

        $anggota = Anggota::where('id_anggota',$id)->first();

        $pembayaran = Pembayaran::where('peminjamans.peminjam',$id)->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')->get();
        return view('riwayat_peminjaman',['pembayaran' => $pembayaran,'peminjaman' => $peminjaman,'anggota' => $anggota]);
    }
    
    public function user_history($year,$month){
        
        $user = Anggota::where('id_user',Auth::user()->id)->first();
        $peminjaman = Peminjaman::where('peminjamans.peminjam',$user->id_anggota)
        ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')
        ->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')
        ->whereMonth('peminjamans.tanggal_pinjam',$month)
        ->whereYear('peminjamans.tanggal_pinjam',$year)
        ->get();

        $pembayaran = Pembayaran::where('peminjamans.peminjam',$user->id_anggota)
        ->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')
        ->whereMonth('peminjamans.tanggal_pinjam',$month)
        ->whereYear('peminjamans.tanggal_pinjam',$year)
        ->get();

        return view('view_anggota.riwayat_peminjaman',['peminjaman' => $peminjaman, 'pembayaran' => $pembayaran, 'month' => $month, 'year' => $year]);
    }

    public function select_history(){

        if (Auth::user()->role == 'Anggota') {
            $user = Anggota::where('id_user',Auth::user()->id)->first();
            $peminjaman = Peminjaman::where('peminjam',$user->id_anggota)->select( DB::raw("DATE_FORMAT(tanggal_pinjam, '%M-%Y') new_date"),  DB::raw('YEAR(tanggal_pinjam) year, MONTH(tanggal_pinjam) month'))
            ->groupby('year','month')
            ->get();

            return view('view_anggota.pilih_riwayat',['peminjaman' => $peminjaman]);
        }

        $anggota = Anggota::join('users','anggotas.id_user','=','users.id')->where('users.status_akun','terdaftar')->get();

        return view('pilih_history',['anggota' => $anggota]);
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
        $anggota = Peminjaman::where('id_peminjaman',$id);
        $anggota->delete();
        return redirect('peminjaman')->with(['danger' => 'Berhasil Menghapus Data']);
    }
}
