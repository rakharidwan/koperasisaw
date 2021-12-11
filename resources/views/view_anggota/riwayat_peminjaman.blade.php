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
              <li class="breadcrumb-item"><a href="{{url('/peminjaman')}}">Peminjaman</a></li>
              <li class="breadcrumb-item"><a href="{{url('/peminjaman/riwayat')}}">Riwayat</a></li>
              <li class="breadcrumb-item">{{$year}} - {{$month}}</li>
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
                  <h3 class="card-title">Riwayat Peminjaman Dan Pembayaran Anggota</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                @forelse($peminjaman as $value)
                <h5>{{ date('F, Y', strtotime($value->tanggal_pinjam)); }}</h5>
                <div class="row">
                    <div class="col-lg-4">
                    <table class="table table-bordered">
                    <tr>
                                    <td><dt>Jumlah Pinjaman</dt></td>
                                    <td>Rp. {{number_format($value->jumlah_pinjaman,0,'.','.')}}</td>
                                </tr>
                                <tr>
                                    <td><dt>Tenor</dt></td>
                                    <td>{{$value->tenor}} Bulan</td>
                                </tr>
                                <tr>
                                    <td><dt>Tanggal Pinjam</dt></td>
                                    <td>{{$value->tanggal_pinjam}}</td>
                                </tr>
                                <tr>
                                    <td><dt>Status</dt></td>
                                    <td>{{$value->status}}</td>
                                </tr>
                            </table>
                    </div>
                    <div class="col-lg-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Total Bayar</th>
                            <th>Terlambat</th>
                            <th>Denda</th>
                        </tr>
                        @foreach($pembayaran->where('id_peminjaman',$value->id_peminjaman) as $p)
                        <tr>
                          <td>{{$p->tanggal_pembayaran}}</td>
                          <td>{{number_format($p->total_pembayaran,0,'.','.')}}</td>
                          <td>{{$p->terlambat}} Hari</td>
                          <td>{{number_format($p->denda_pembayaran,0,'.','.')}}</td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                </div>
                @empty
                <center>
                  <h5>Anda Tidak Memiliki Riwayat Peminjaman Anggota</h5>
                </center>
               @endforelse
                </div>
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
