@extends('layouts.temp')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/peminjaman')}}">Peminjaman</a></li>
              <li class="breadcrumb-item">Tambah Peminjaman</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        @foreach(['success','danger','primary'] as $msg)
        @if ($message = Session::has($msg))
  <div class="alert alert-{{$msg}} alert-dismissible">
          <ul>
          {{ Session::get($msg) }}
</ul>
        </div>
  @endif
  @endforeach
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Tambah Data Peminjaman</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('peminjaman/simpan')}}" method="post">

                @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="peminjam">Peminjam</label>
                                <select name="peminjam" class="form-control">
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach($anggota as $a)
                                    <option value="{{$a->id_anggota}}" {{ old('peminjam') == $a->id_anggota ? "selected" : "" }}>{{$a->nik}} - {{$a->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="peminjam">Pinjaman</label>
                                <select name="pinjaman" class="form-control">
                                    <option value="">-- Pilih Pinjaman --</option>
                                    @foreach($pinjaman as $p)
                                    <option value="{{$p->id_pinjaman}}" {{ old('peminjam') == $p->id_pinjaman ? "selected" : "" }}>Rp. {{ number_format($p->jumlah_pinjaman,0,'.','.') }} - Bunga {{$p->bunga}}% - Tenor {{$p->tenor}} Minggu - Cicilan Rp. {{number_format($p->cicilan,0,'.','.')}} / Minggu</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
