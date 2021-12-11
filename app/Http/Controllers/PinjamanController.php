<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Peminjaman;


class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pinjaman = Pinjaman::get();
        return view('pinjaman',['pinjaman' => $pinjaman]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tambah_pinjaman');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nominal_bunga = ($request->bunga * $request->jumlah_pinjaman)/100;
        $total_pinjaman = $request->jumlah_pinjaman + $nominal_bunga;
        $cicilan = $total_pinjaman / $request->tenor;
        $decimal = number_format((float)$cicilan);

        $validate = $request->validate([
            'jumlah_pinjaman' => 'numeric|digits_between:4,9|required',
            'bunga' => 'required|digits_between:0,2|numeric',
            'tenor' => 'required|digits_between:0,2|numeric'
        ]);

        $pinjaman = Pinjaman::create([
            'jumlah_pinjaman' => $total_pinjaman,
            'bunga' => $request->bunga,
            'tenor' => $request->tenor,
            'cicilan' => str_replace(",","",$decimal),
        ]);

        return redirect('/pinjaman')->with(['success' => 'Berhasil Menambahkan Data Pinjaman']);
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
        $peminjaman = Peminjaman::join('pinjamans','peminjamans.id_pinjaman','=','pinjamans.id_pinjaman')->where('peminjamans.id_pinjaman',$id)->where('peminjamans.status','Belum Lunas')->count();

        if ($peminjaman > 0) {
            return redirect('pinjaman')->with(['danger' => 'Ada Anggota Yang Belum Melunasi Pinjaman Tersebut']);
        }
        $pinjaman = Pinjaman::where('id_pinjaman',$id);
        $pinjaman->delete();
        return redirect('pinjaman')->with(['success' => 'Berhasil Menghapus Data']);
    }
}
