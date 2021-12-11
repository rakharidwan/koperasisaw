<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $jumlah_anggota_belum_diverifikasi = Anggota::join('users', 'anggotas.id_user', '=', 'users.id')->where('users.status_akun','menunggu verifikasi')->count();
        $anggota = Anggota::join('users', 'anggotas.id_user', '=', 'users.id')->where('users.status_akun','terdaftar')->get();
        return view('anggota',['anggota' => $anggota,'jabd' => $jumlah_anggota_belum_diverifikasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show_not_registered($id)
    {
        //
        $anggota = Anggota::join('users','anggotas.id_user','=','users.id')->where('id_user',$id)->first();
        return view('rincian_verifikasi_anggota',['anggota' => $anggota]);
       
    }

    public function account_verification()
    {   
        $anggota = Anggota::join('users', 'anggotas.id_user', '=', 'users.id')->whereNotIn('users.status_akun',['terdaftar'])->orderBy('users.status_akun','desc')->get();
        return view('verifikasi_anggota',['anggota' => $anggota]);
    }

    public function account_verification_update(Request $request ,$id)
    {   
        if ($request->action == 'terima') {
            $anggota = User::where('id',$id)->update([
                'status_akun' => 'terdaftar',
            ]);
            return redirect('anggota/verifikasi_akun')->with(['primary' => 'Data Calon Anggota Berhasil Disetujui Menjadi Anggota']);
        }

        elseif($request->action == 'tolak'){
            $anggota = User::where('id',$id)->update([
                'status_akun' => 'ditolak',
            ]);
            return redirect('anggota/verifikasi_akun')->with(['danger' => 'Data Calon Anggota Ditolak Menjadi Anggota']);
        }

        elseif($request->action == 'pulihkan'){
            $anggota = User::where('id',$id)->update([
                'status_akun' => 'menunggu verifikasi',
            ]);
            return redirect('anggota/verifikasi_akun')->with(['success' => 'Data Calon Anggota Berhasil Dipulihkan']);
        }
        
        elseif($request->action == 'hapus'){
            $anggota = User::find($id);
            $anggota->delete();
            return redirect('anggota/verifikasi_akun')->with(['danger' => 'Data Calon Anggota Berhasil Dihapus']);
        }

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
        $anggota = Anggota::join('users','anggotas.id_user','=','users.id')->where('id_user',$id)->first();
        return view('rincian_anggota',['anggota' => $anggota]);
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
        $anggota = Anggota::where('id_user',$id)->first();
        return view('edit_anggota',['anggota' => $anggota]);
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
        $anggota = Anggota::where('id_user',$id)->first();
        
        $validate = $request->validate([
            'nik' => 'required|numeric|digits:16'.Rule::unique('anggotas')->ignore($id, 'id_user'),
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'jk' => 'required|in:L,P',
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
        ]);
        
        $user = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->nik.'@koperasisaw.com',
        ]);

        $update = Anggota::where('id_user',$id)->update([
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

        return redirect('/anggota')->with(['success' => 'Data Anggota Berhasil Diubah']);
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
        return redirect('anggota')->with(['danger' => 'Berhasil Menghapus Data']);
    }
}
