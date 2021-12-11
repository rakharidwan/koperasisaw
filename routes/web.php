<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PencapaianController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth']);
Route::get('/profil', [UserController::class, 'profil'])->middleware(['auth']);
    Route::group(['middleware' => ['auth', 'checkRole:Admin']],function(){
        Route::get('/karyawan', [KaryawanController::class, 'index'])->middleware(['auth']);
        Route::get('/karyawan/tambah', [KaryawanController::class, 'create'])->middleware(['auth']);
        Route::get('/karyawan/{id}', [KaryawanController::class, 'show'])->middleware(['auth']);
        Route::post('/karyawan/simpan', [KaryawanController::class, 'store'])->middleware(['auth']);
        Route::get('/karyawan/ubah/{id}', [KaryawanController::class, 'edit'])->middleware(['auth']);
        Route::patch('/karyawan/perbarui/{id}', [KaryawanController::class, 'update'])->middleware(['auth']);
        Route::get('/karyawan/hapus/{id}', [KaryawanController::class, 'destroy'])->middleware(['auth']);

        //Anggota
        Route::get('/anggota', [AnggotaController::class, 'index'])->middleware(['auth']);
        Route::get('/anggota/verifikasi_akun', [AnggotaController::class, 'account_verification'])->middleware(['auth']);
        Route::get('/anggota/{id}', [AnggotaController::class, 'show'])->middleware(['auth']);
        Route::get('/anggota/ubah/{id}', [AnggotaController::class, 'edit'])->middleware(['auth']);
        Route::patch('/anggota/perbarui/{id}', [AnggotaController::class, 'update'])->middleware(['auth']);
        Route::get('/anggota/hapus/{id}', [AnggotaController::class, 'destroy'])->middleware(['auth']);
        Route::patch('/anggota/verifikasi_akun/{id}', [AnggotaController::class, 'account_verification_update'])->middleware(['auth']);
        Route::get('/anggota/verifikasi_akun/rincian/{id}', [AnggotaController::class, 'show_not_registered'])->middleware(['auth']);

        //pinjaman
        Route::get('/pinjaman', [PinjamanController::class, 'index'])->middleware(['auth']);
        Route::get('/pinjaman/tambah', [PinjamanController::class, 'create'])->middleware(['auth']);
        Route::post('/pinjaman/simpan', [PinjamanController::class, 'store'])->middleware(['auth']);
        Route::get('/pinjaman/hapus/{id}', [PinjamanController::class, 'destroy'])->middleware(['auth']);
        Route::patch('/pinjaman/perbarui/{id}', [PinjamanController::class, 'update'])->middleware(['auth']);
    });
    Route::group(['middleware' => ['auth', 'checkRole:Karyawan']],function(){

    });
    
    Route::group(['middleware' => ['auth', 'checkRole:Karyawan,Admin']],function(){
        //Peminjaman
        Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create'])->middleware(['auth']);
        Route::post('/peminjaman/simpan', [PeminjamanController::class, 'store'])->middleware(['auth']);
        Route::get('/peminjaman/bayar/{id}', [PeminjamanController::class, 'bayar'])->middleware(['auth']);
        Route::patch('/peminjaman/pembayaran/{id}', [PeminjamanController::class, 'pembayaran'])->middleware(['auth']);
        
        //Peminjaman
        Route::get('/peminjaman/rincian/{id}', [PeminjamanController::class, 'show'])->middleware(['auth']);
        Route::get('/peminjaman/riwayat/{id}', [PeminjamanController::class, 'history'])->middleware(['auth']);

        //Simpanan
        Route::get('/simpanan/{id}', [SimpananController::class, 'show'])->middleware(['auth']);
        Route::get('/simpanan/{id}/pilih-jenis-transaksi', [SimpananController::class, 'PilihJenisTransaksi'])->middleware(['auth']);
        Route::post('/simpanan/{id}/pilih-jenis-transaksi/tambah-simpanan', [SimpananController::class, 'create'])->middleware(['auth']);
        Route::post('/simpanan/{id}/pilih-jenis-transaksi/tambah-simpanan/simpan', [SimpananController::class, 'store'])->middleware(['auth']);
        
    });
    Route::group(['middleware' => ['auth', 'checkRole:Karyawan,Admin,Anggota']],function(){
        Route::get('/peminjaman/riwayat', [PeminjamanController::class, 'select_history'])->middleware(['auth']);
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->middleware(['auth']);
        Route::get('/simpanan', [SimpananController::class, 'index'])->middleware(['auth']);
        
    });
    
    Route::group(['middleware' => ['auth', 'checkRole:Anggota']],function(){
        Route::get('/peminjaman/riwayat/{year}/{month}', [PeminjamanController::class, 'user_history'])->middleware(['auth']);
    });

    Route::get('/penilaian', [PenilaianController::class, 'index'])->middleware(['auth']);
    Route::get('/penilaian/{id}', [PenilaianController::class, 'show'])->middleware(['auth']);
    Route::get('/penilaian/{id}/tambah-penilaian', [PenilaianController::class, 'create'])->middleware(['auth']);
    Route::post('/penilaian/{id}/tambah-penilaian/simpan', [PenilaianController::class, 'store'])->middleware(['auth']);
    Route::get('penilaian/{id}/tambah-penilaian-sikap', [PenilaianController::class, 'TambahPenilaianSikap'])->middleware(['auth']);
    Route::post('penilaian/{id}/tambah-penilaian-sikap/simpan', [PenilaianController::class, 'SimpanPenilaianSikap'])->middleware(['auth']);
    
    Route::get('penilaian/{id}/tambah-penilaian-sholat', [PenilaianController::class, 'TambahPenilaianSholat'])->middleware(['auth']);
    Route::post('penilaian/{id}/tambah-penilaian-sholat/simpan', [PenilaianController::class, 'SimpanPenilaianSholat'])->middleware(['auth']);
    
    Route::get('/pencapaian', [PencapaianController::class, 'index'])->middleware(['auth'] );
    Route::get('/pencapaian/{m}/{y}', [PencapaianController::class, 'show'])->middleware(['auth'] );
    
    //dashboard_widgets
    Route::get('/dashboard/peminjaman_belum_lunas', [UserController::class, 'PeminjamanBelumLunas'])->middleware(['auth'] );
    Route::get('/dashboard/pembayaran_terlambat', [UserController::class, 'PembayaranTerlambat'])->middleware(['auth'] );

    Route::get('/dashboard/penilaian_kolektif', [UserController::class, 'PenilaianKolektif'])->middleware(['auth'] );
    Route::get('/dashboard/riwayat_penilaian', [UserController::class, 'RiwayatPenilaian'])->middleware(['auth'] );


require __DIR__.'/auth.php';
