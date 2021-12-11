@extends('layouts.temp')

@section('title', 'Rincian Peminjaman')

@section('content')
<?php 
  use \Carbon\Carbon;
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
              <li class="breadcrumb-item">Rincian Peminjaman</li>
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
  <div class="row">
    <div class="col-sm-4">
    <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Rincian Peminjaman Anggota</h3>
                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <dl>
                  <dt>NIK</dt>
                  <dd>{{$peminjaman->nik}}</dd>
                  <dt>Nama</dt>
                  <dd>{{$peminjaman->nama}}</dd>
                  <dt>Tanggal Pinjam</dt>
                  <dd>{{$peminjaman->tanggal_pinjam}}</dd>
                  <dt>Jatuh Tempo</dt>
                  <dd>{{$peminjaman->jatuh_tempo}}</dd>
                  <dt>Status</dt>
                  @if($peminjaman->status == 'Belum Lunas')
                        <span class="right badge badge-danger">{{$peminjaman->status}}</span></td>
                        @endif                           
                        @if($peminjaman->status == 'Lunas')
                        <span class="right badge badge-success">{{$peminjaman->status}}</span></td>
                        @endif     
                </dl>
                <br>                   
                </div>
                </div>
    </div>
    <div class="col-sm-8">
    <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pinjaman</h3>
                 </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><dt>Jumlah Pinjaman</dt></td>
                                    <td>Rp. {{number_format($peminjaman->jumlah_pinjaman,0,'.','.')}}</td>
                                </tr>
                                <tr>
                                    <td><dt>Tempo</dt></td>
                                    <td>{{$peminjaman->tenor}} Minggu</td>
                                </tr>
                                <tr>
                                    <td><dt>Margin</dt></td>
                                    <td>{{$peminjaman->bunga}}%</td>
                                </tr>
                                <tr>
                                    <td><dt>Cicilan</dt></td>
                                    <td>Rp. {{number_format($peminjaman->cicilan,0,'.','.')}} / Bulan</td>
                                </tr>
                            </table>
                            <br>
                            @if(auth()->user()->role == 'Karyawan')
              @if($peminjaman->status == 'Belum Lunas')
                    <a href="{{url('/peminjaman/bayar/'.$peminjaman->id_peminjaman)}}" class="btn btn-primary float-right"><i class="fa fa-wallet"></i> Bayar</a>
                    @endif
                    @endif
                        </div>
                    </div>
    </div>
  </div>
           
                <div class="row">
                    <div class="col-sm-12">
                    <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Riwayat Pembayaran Pinjaman</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Total Bayar</th>
                            <th>Terlambat</th>
                        </tr>
                        @forelse($pembayaran as $p)
                        <tr>
                            <td>{{$p->tanggal_pembayaran}}</td>
                            <td>Rp. {{number_format($p->total_pembayaran,0,'.','.')}}</td>
                            @if($p->terlambat > 0 )
                            <td>{{$p->terlambat}} Hari</td>
                            @else
                            <td>-</td>
                            @endif
                        </tr>
                    
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Anggota Ini Belum Melakukan Pembayaran Pada Pinjaman Ini
                            </td>
                        </tr>
                        @endforelse
                        <tr>
                            <th>Sisa Bayaran </th>
                            @if($peminjaman->status == 'lunas')
                            <td>Lunas</td>
                            @else
                            <td>Rp. {{number_format($peminjaman->jumlah_pinjaman - $pembayaran->sum('total_pembayaran'),0,'.','.')}}</td>
                            @endif
                        </tr>
                    </table>
                  </div>
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
