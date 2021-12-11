@extends('layouts.temp')

@section('title', 'Peminjaman')

@section('content')
<?php

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Pembayaran;
Use \Carbon\Carbon;

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Peminjaman</li>
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
                  <h3 class="card-title">Data Peminjaman</h3>
                    <a class="btn" data-toggle="dropdown" href="#" aria-expanded="false">
                      <i class="fa fa-ellipsis-v fa-lg"></i>
                    </a>
                    <div class="dropdown-menu" style="">
                      @if(auth()->user()->role == 'Karyawan')
                      <a class="dropdown-item" tabindex="-1" href="{{url('peminjaman/tambah')}}"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Peminjaman</a>
                      @endif
                      <a class="dropdown-item" tabindex="-1" href="{{url('peminjaman/riwayat')}}"><i class="fa fa-history"></i>&nbsp;&nbsp;Riwayat Peminjaman</a>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width: 3%;">NO</th>
                    <th>Peminjam</th>
                    <th style="width: 15%;">Tanggal Pinjam</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 3%;">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($peminjaman as $p)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p['nama'] }} ( {{$p->nik}} )</td>
                        <td>{{ date('d-m-Y', strtotime($p->tanggal_pinjam));}}</td>
                        <td>{{ $p->status}}</td>
                        <td>
                                <a href="{{url('/peminjaman/rincian',[$p->id_peminjaman])}}" class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a>
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
