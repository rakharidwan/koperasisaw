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
use Illuminate\Support\Facades\DB;

class PencapaianController extends Controller
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
            $penilaian = Penilaian::select('tanggal_penilaian')->where('id_karyawan',$user->id_karyawan)->groupBy(DB::raw("DATE_FORMAT(created_at, 'm-Y')"))->get();
            return view('pencapaian_karyawan_index',['penilaian' => $penilaian]);
        }
        $penilaian = Penilaian::select('tanggal_penilaian')->groupBy(DB::raw("DATE_FORMAT(created_at, 'm-Y')"))->get();
        return view('pencapaian_karyawan_index',['penilaian' => $penilaian]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($m,$y)
    {   
        
        $penilaian = Penilaian::join('karyawans','penilaians.id_karyawan','=','karyawans.id_karyawan')->whereMonth('tanggal_penilaian',$m)->whereYear('tanggal_penilaian',$y)->get();
        $penilaian_sholat = PenilaianSholat::get();
        $penilaian_sikap = PenilaianSikap::get();
        $karyawan = Karyawan::get();
        $kolektif = PenilaianKolektif::get();
        $p_kolektif = PenilaianKolektif::whereMonth('created_at',$m)->whereYear('created_at',$y)->count();
        $p_sikap = PenilaianSikap::whereMonth('created_at',$m)->whereYear('created_at',$y)->count();
        $p_sholat = PenilaianSholat::whereMonth('created_at',$m)->whereYear('created_at',$y);
       $max_sholat =  $p_sholat->sum('subuh') + $p_sholat->sum('dzuhur') + $p_sholat->sum('ashar') + $p_sholat->sum('maghrib') + $p_sholat->sum('isya') + $p_sholat->sum('sunnah');
        if ($p_sikap == 0 || $p_kolektif == 0 || $max_sholat == 0 || count($penilaian) < 2) {
            return redirect('/pencapaian')->with(['danger' => 'Mencari Nilai Tertinggi Tidak Valid']);
        }

         return view('pencapaian_karyawan',['penilaian' => $penilaian,'kolektif' => $kolektif,'karyawan' => $karyawan,'penilaian_sholat' => $penilaian_sholat,'penilaian_sikap' => $penilaian_sikap,'m'=>$m,'y'=>$y]);
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
