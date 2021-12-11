<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Penilaian;
use App\Models\PenilaianKolektif;
use App\Models\PenilaianSholat;
use App\Models\PenilaianSikap;
Use \Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function waktu(){
        
    }

    public function dashboard()
    {   
        $waktu = Carbon::now();
        $jam = Carbon::now()->format('H:i');
        $pesan = '';
        $w = '';
        if ($jam >= '03:00' && $jam <= '10:59') {
            $w = 'Pagi';
            $pesan = 'Awal yang bagus dengan memulai aktivitas dengan sarapan serta secangkir kopi dan jangan lupa untuk cek data peminjaman kamu di koperasisaw barangkali ada peminjaman yang sudah jatuh tempo loh';
        }
        elseif ($jam >= '11:00' && $jam <= '15:59') {
            $w = 'Siang';
            $pesan = 'Masih semangat untuk beraktivitas hari ini? Tenang saja Koperasisaw siap melayani anda kapanpun dan dimanapun.Tetap semangat dan jaga kesehatan Yaa...';
        }
        elseif ($jam >= '16:00' && $jam <= '17:59') {
            $w = 'Sore';
            $pesan = 'Masih semangat untuk beraktivitas hari ini? Tenang saja Koperasisaw siap melayani anda kapanpun dan dimanapun.Tetap semangat dan jaga kesehatan Yaa...';
        }
        elseif ($jam >= '18:00') {
            $w = 'Malam';
            $pesan = 'Bagaimana Aktivitas Hari Ini? Semoga Saja Menyenangkan Dan Jangan Lupa Istirahat Untuk Menjaga Kesehatan Tubuh Dan Pikiran yaa, Oh Iya Sambil Istirahat Jangan Lupa Untuk Cek Koperasisaw Untuk Melihat Informasi Terbaru Anda';
        }
        
        elseif ($jam >= '00:00') {
            $w = 'Malam';
            $pesan = 'Bagaimana Aktivitas Hari Ini? Semoga Saja Menyenangkan yaa, Oh Iya Sambil Istirahat Jangan Lupa Untuk Cek Koperasisaw Untuk Melihat Informasi Terbaru Anda';
        }

        //widgets
        $jumlah_anggota_belum_diverifikasi = Anggota::join('users', 'anggotas.id_user', '=', 'users.id')->where('users.status_akun','menunggu verifikasi')->count();
        $peminjaman_belum_lunas = Peminjaman::where('status','Belum Lunas')->count();
        $pembayaran_terlambat = Pembayaran::where('terlambat','>=', 1)->whereMonth('tanggal_pembayaran',Carbon::now()->format('m'))->whereYear('tanggal_pembayaran',Carbon::now()->format('Y'))->count();
        //end widgets
        
        $pembayaran_masuk = Pembayaran::join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->whereDate('tanggal_pembayaran',Carbon::now())->get();
        
        
        if (Auth::user()->role == 'Karyawan') {
            $karyawan = Karyawan::where('id_user',Auth::user()->id)->join('users','karyawans.id_user','=','users.id')->first();
            $kolektif = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')->where('penilaians.id_karyawan',$karyawan->id_karyawan)->count();
            $kolektif_hari_ini = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')->join('pembayarans','penilaian_kolektifs.id_pembayaran','=','pembayarans.id_pembayaran')
        ->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')
        ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->whereDate('penilaian_kolektifs.created_at',Carbon::now())->where('penilaians.id_karyawan',$karyawan->id_karyawan)->get();

            $riwayat_penilaian = Penilaian::where('id_karyawan',$karyawan->id_karyawan)->get();
           $waktu = Carbon::now();
        $jam = Carbon::now()->format('H:i');
        $pesan = '';
        $w = '';
        if ($jam >= '03:00' && $jam <= '10:59') {
            $w = 'Pagi';
            $pesan = 'Awal yang bagus dengan memulai aktivitas dengan sarapan serta secangkir kopi dan jangan lupa untuk cek data peminjaman kamu di koperasisaw barangkali ada peminjaman yang sudah jatuh tempo loh';
        }
        elseif ($jam >= '11:00' && $jam <= '15:59') {
            $w = 'Siang';
            $pesan = 'Masih semangat untuk beraktivitas hari ini? Tenang saja Koperasisaw siap melayani anda kapanpun dan dimanapun.Tetap semangat dan jaga kesehatan Yaa...';
        }
        elseif ($jam >= '16:00' && $jam <= '17:59') {
            $w = 'Sore';
            $pesan = 'Masih semangat untuk beraktivitas hari ini? Tenang saja Koperasisaw siap melayani anda kapanpun dan dimanapun.Tetap semangat dan jaga kesehatan Yaa...';
        }
        elseif ($jam >= '18:00') {
            $w = 'Malam';
            $pesan = 'Bagaimana Aktivitas Hari Ini? Semoga Saja Menyenangkan Dan Jangan Lupa Istirahat Untuk Menjaga Kesehatan Tubuh Dan Pikiran yaa, Oh Iya Sambil Istirahat Jangan Lupa Untuk Cek Koperasisaw Untuk Melihat Informasi Terbaru Anda';
        }
        
        elseif ($jam >= '00:00') {
            $w = 'Malam';
            $pesan = 'Bagaimana Aktivitas Hari Ini? Semoga Saja Menyenangkan yaa, Oh Iya Sambil Istirahat Jangan Lupa Untuk Cek Koperasisaw Untuk Melihat Informasi Terbaru Anda';
        }
            return view('view_karyawan.dashboard',['pesan' => $pesan,'kolektif_hari_ini' => $kolektif_hari_ini,'kolektif' => $kolektif,'riwayat_penilaian' => $riwayat_penilaian,'w' => $w,'jam' => $jam,'waktu' => $waktu]);
        }
        
        return view('/dashboard',['pesan' => $pesan,'waktu' => $waktu,'pembayaran_masuk' => $pembayaran_masuk,'w' => $w,'pembayaran_terlambat' => $pembayaran_terlambat,'peminjaman_belum_lunas' => $peminjaman_belum_lunas,'jumlah_anggota_belum_diverifikasi'=>$jumlah_anggota_belum_diverifikasi]);
    }
    
    public function profil()
    {   
        $user = Auth::user()->id;
        if (Auth::user()->role == 'Karyawan') {
            $karyawan = Karyawan::where('id_user',$user)->join('users','karyawans.id_user','=','users.id')->first();
            $kolektif = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')->whereMonth('penilaians.tanggal_penilaian',Carbon::now()->format('m'))->whereYear('penilaians.tanggal_penilaian',Carbon::now()->format('Y'))->where('penilaians.id_karyawan',$karyawan->id_karyawan)->count();
            $sholat = PenilaianSholat::join('penilaians','penilaian_sholats.id_penilaian','=','penilaians.id_penilaian')->whereMonth('penilaians.tanggal_penilaian',Carbon::now()->format('m'))->whereYear('penilaians.tanggal_penilaian',Carbon::now()->format('Y'))->where('penilaians.id_karyawan',$karyawan->id_karyawan)->get();
            $sikap = PenilaianSikap::join('penilaians','penilaian_sikaps.id_penilaian','=','penilaians.id_penilaian')->whereMonth('penilaians.tanggal_penilaian',Carbon::now()->format('m'))->whereYear('penilaians.tanggal_penilaian',Carbon::now()->format('Y'))->where('penilaians.id_karyawan',$karyawan->id_karyawan)->firstOrNew();
            return view('profil',['karyawan' => $karyawan,'kolektif' => $kolektif,'sholat' => $sholat,'sikap' => $sikap]);
        }
        if (Auth::user()->role == 'Anggota') {
            $anggota = Anggota::where('id_user',$user)->join('users','anggotas.id_user','=','users.id')->first();
            return view('profil',['anggota' => $anggota]);
        }
        if (Auth::user()->role == 'Admin') {
            $admin = User::where('id',$user)->first();
            $jumlah_anggota = Anggota::join('users','anggotas.id_user','=','users.id')->where('status_akun','terdaftar')->count();
            $jumlah_karyawan = Karyawan::count();
            return view('profil',['admin' => $admin,'jumlah_karyawan' => $jumlah_karyawan,'jumlah_anggota' => $jumlah_anggota]);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PeminjamanBelumLunas()
    {
        $peminjaman = Peminjaman::where('status','Belum Lunas')->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')->get();

        return view('dashboard_widgets_3',['peminjaman' => $peminjaman]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function PembayaranTerlambat()
    {
        $pembayaran = Pembayaran::where('terlambat','>=', 1)->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->whereMonth('tanggal_pembayaran',Carbon::now()->format('m'))->whereYear('tanggal_pembayaran',Carbon::now()->format('Y'))->get();
        
        return view('dashboard_widgets_4',['pembayaran' => $pembayaran]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PenilaianKolektif()
    {
        //
        $karyawan = Karyawan::where('id_user',Auth::user()->id)->join('users','karyawans.id_user','=','users.id')->first();
        $kolektif = PenilaianKolektif::join('penilaians','penilaian_kolektifs.id_penilaian','=','penilaians.id_penilaian')->join('pembayarans','penilaian_kolektifs.id_pembayaran','=','pembayarans.id_pembayaran')
        ->join('peminjamans','pembayarans.id_peminjaman','=','peminjamans.id_peminjaman')
        ->join('anggotas','peminjamans.peminjam','=','anggotas.id_anggota')->where('penilaians.id_karyawan',$karyawan->id_karyawan)->get();

        return view('view_karyawan.dashboard_widgets_3',['kolektif' => $kolektif]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function RiwayatPenilaian()
    {
        //
        $karyawan = Karyawan::where('id_user',Auth::user()->id)->join('users','karyawans.id_user','=','users.id')->first();
        $penilaian = Penilaian::where('id_karyawan',$karyawan->id_karyawan)->get();

        return view('view_karyawan.dashboard_widgets_2',['penilaian' => $penilaian]);
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
