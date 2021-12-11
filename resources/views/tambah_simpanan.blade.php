@extends('layouts.temp')

@section('title', 'Tambah Simpanan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Simpanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/simpanan')}}">Simpanan</a></li>
              <li class="breadcrumb-item"><a href="{{url('/simpanan/'.$id)}}">Rincian Simpanan</a></li>
              <li class="breadcrumb-item"><a href="{{url('/simpanan/'.$id.'/pilih-jenis-transaksi')}}">Pilih Jenis Simpanan</a></li>
              <li class="breadcrumb-item">Tambah Simpanan</li>
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
        @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
      </div>
@endif
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Tambah Simpanan</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <form method="POST" action="{{ url('simpanan/'.$id.'/pilih-jenis-transaksi/tambah-simpanan/simpan') }}">
            @csrf
                  <div class="form-group">
                    <label for="nominal_transaksi">Nominal {{Session::get('jenis_transaksi')}}</label>
                    <input type="number" name="nominal_jenis_transaksi" class="form-control" value="{{old('nominal_transaksi')}}" placeholder="Masukan Nominal {{Session::get('jenis_transaksi')}}" onkeyPress="if(this.value.length == 8) return false;" autofocus required>
                  </div>
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </form>
      
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <script>
  </script>
  @endsection
