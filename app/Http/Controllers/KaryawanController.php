<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $karyawan = Karyawan::orderBy('created_at','desc')->get();
        return view('karyawan',['karyawan' => $karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tambah_karyawan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dt = new Carbon\Carbon();
        $before = $dt->subYears(17)->format('Y-m-d');

        $validate = $request->validate([
            'nik' => 'required|unique:karyawans,nik|numeric|digits:16',
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'jk' => 'required|in:P,W',
            'tempat_lahir' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
            'tgl_lahir' => 'required|date|before:'.$before,
            'provinsi' => 'required|max:15|min:2|regex:/^[\pL\s\-]+$/u',
            'kota' => 'required|max:15|min:2|regex:/^[\pL\s\-]+$/u',
            'kel' => 'required|max:15|min:2|regex:/^[\pL\s\-]+$/u',
            'rt' => 'required|max:2',
            'rw' => 'required|max:2',
            'alamat' => 'required|min:3',
            'agama' => 'required|in:Islam,Protestan,Katolik,Buddha,Hindu,Khonghucu,Lainnya',
            'pekerjaan' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:25',
            'kewarganegaraan' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'password' => 'required|min:5|Max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->nik.'@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make($request->password),
        ]);

        $request->request->add(['id_user' => $user->id]);

        $anggota = Karyawan::create([
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

        return redirect('/karyawan')->with(['success' => 'Data Berhasil Ditambahkan']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $karyawan = Karyawan::join('users','karyawans.id_user','=','users.id')->where('id_user',$id)->first();
        return view('rincian_karyawan', ['karyawan' => $karyawan]);
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
        $karyawan = Karyawan::where('id_user',$id)->first();
        return view('edit_karyawan',['karyawan' => $karyawan]);
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
        $karyawan = Karyawan::where('id_user',$id)->first();
        
        $validate = $request->validate([
            'nik' => 'required|numeric|digits:16|'.Rule::unique('karyawans')->ignore($id, 'id_user'),
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'jk' => 'required|in:W,P',
            'tempat_lahir' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir' => 'required|date',
            'prov' => 'required|max:15|min:2|regex:/^[\pL\s\-]+$/u',
            'kota' => 'required|max:15|min:2|regex:/^[\pL\s\-]+$/u',
            'kel' => 'required|max:15|min:2|regex:/^[\pL\s\-]+$/u',
            'rt' => 'required|max:2',
            'rw' => 'required|max:2',
            'alamat' => 'required|min:3',
            'agama' => 'required|in:Islam,Protestan,Katolik,Buddha,Hindu,Khonghucu,Lainnya',
            'pekerjaan' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:25',
            'kewarganegaraan' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'password' => 'required|min:5|Max:20',
        ]);
        
        $user = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->nik.'@koperasisaw.com',
            'password' => Hash::make($request->password),
        ]);

        $update = Karyawan::where('id_user',$id)->update([
            'nik' => $request->nik,
            'nama' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jk,
            'alamat' => $request->alamat,
            'provinsi' => $request->prov,
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

        return redirect('/karyawan')->with(['success' => 'Data Karyawan Berhasil Diubah']);
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
        $anggota = User::find($id);
        $anggota->delete();
        return redirect('karyawan')->with(['danger' => 'Berhasil Menghapus Data']);
    }
}
