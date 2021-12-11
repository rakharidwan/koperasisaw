@extends('layouts.temp')

@section('title', 'Pinjaman')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pinjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Pinjaman</li>
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
        
          @foreach(['success','danger'] as $msg)
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
                  <h3 class="card-title">Data Pinjaman</h3>
                  <a href="{{url('pinjaman/tambah')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width : 2%">NO</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Tenor</th>
                    <th>Bunga</th>
                    <th>Cicilan</th>
                    <th style="width : 3%">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($pinjaman as $p)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>Rp. {{ number_format($p->jumlah_pinjaman,0,'.','.') }}</td>
                    <td>{{ $p->tenor }} minggu</td>
                    <td>{{ $p->bunga }}%</td>
                    <td>Rp. {{ number_format($p->cicilan,0,'.','.') }}</td>
                    <td>
                      <a href="{{url('/pinjaman/hapus',[$p->id_pinjaman])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
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
