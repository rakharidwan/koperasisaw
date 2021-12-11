<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {   
        $dt = new Carbon\Carbon();
        $before = $dt->subYears(17)->format('Y-m-d');

        $request->validate([
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:50'],
            'nik' => ['required','digits:16','numeric','unique:App\Models\Anggota,nik'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nik' => ['required','unique:karyawans,nik','numeric','digits:16'],
            'name' => ['required','max:50','regex:/^[\pL\s\-]+$/u'],
            'jk' => ['required','in:P,W'],
            'tempat_lahir' => ['required','max:15','regex:/^[\pL\s\-]+$/u'],
            'tgl_lahir' => ['required','date','before:'.$before],
            'provinsi' => ['required','max:15','min:2','regex:/^[\pL\s\-]+$/u'],
            'kota' => ['required','max:15','min:2','regex:/^[\pL\s\-]+$/u'],
            'kel' => ['required','max:15','min:2','regex:/^[\pL\s\-]+$/u'],
            'rt' => ['required','max:2'],
            'rw' => ['required','max:2'],
            'alamat' => ['required','min:3'],
            'agama' => ['required','in:Islam,Protestan,Katolik,Buddha,Hindu,Khonghucu,Lainnya'],
            'pekerjaan' => ['required','regex:/^[\pL\s\-]+$/u','min:3','max:25'],
            'kewarganegaraan' => ['required','regex:/^[\pL\s\-]+$/u','max:25'],
            'status_perkawinan' => ['required','in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati'],
        
        ],[
            'tgl_lahir.before' => 'Umur Anda Harus Diatas 17 Tahun',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->nik.'@koperasisaw.com',
            'role' => 'Anggota',
            'status_akun' => 'menunggu verifikasi',
            'password' => Hash::make($request->password),
        ]);

        $request->request->add(['id_user' => $user->id]);

        $anggota = Anggota::create([
            'id_user' => $request->id_user,
            'nik' => $request->nik,
            'nama' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jk,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kota,
            'kecamatan' => $request->kec,
            'kelurahan_desa' => $request->kel,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'status_perkawinan' => $request->status_perkawinan,
            'kewarganegaraan' => $request->kewarganegaraan,
            
        ]);

        return redirect('/register')->with(['success' => 'Data Berhasil Terkirim Dimohon Untuk Menunggu Persetujuan Admin Dan Pastikan Data Yang Anda Kirimkan Benar']);
    }
}
