@extends('layouts.temp')

@section('title', 'Peminjaman Belum Lunas')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Peminjaman Belum Lunas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Peminjaman Belum Lunas</li>
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
                  <h3 class="card-title">Peminjaman Belum Lunas</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width : 3%">No</th>
                        <th>Anggota</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                    @forelse($peminjaman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nik }} -  {{$p->nama}}</td>
                        <td>Rp. {{number_format($p->jumlah_pinjaman,0,'.','.')}}</td>
                        <td>{{ date('d-m-Y', strtotime($p->tanggal_pinjam));}}</td>
                        <td>{{ $p->status}}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5">
                        <center>
                          Tidak Ada Data Pada Tabel
                        </center>
                      </td>
                    </tr>
                    @endforelse
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
