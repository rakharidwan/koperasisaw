@extends('layouts.temp')

@section('title', 'Pembayaran Pinjaman')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembayaran Pinjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/peminjaman')}}">Peminjaman</a></li>
                <li class="breadcrumb-item"><a href="{{url('/peminjaman/rincian/'.$id)}}">Rincian Peminjaman</a></li>
              <li class="breadcrumb-item">Pembayaran Pinjaman</li>
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
                  <h3 class="card-title">Pembayaran Pinjaman Anggota</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('/peminjaman/pembayaran/'.$id)}}" method="post">
                @csrf
                @method('patch')
                <div class="table-responsive"></div>
                <table class="table">
                  <tbody>
                    <tr>
                      <th>Anggota</th>
                      <td>{{$rincian_peminjaman->nama}} ( {{$rincian_peminjaman->nik}} )</td>
                    </tr>
                    <tr>
                      <th>Sisa Pembayaran</th>
                      <td>Rp. {{number_format($rincian_peminjaman->jumlah_pinjaman - $rincian_pembayaran->sum('total_pembayaran'),0,'.','.')}}</td>
                    </tr>
                    <tr>
                      <th>Nominal Yang Harus Dibayar</th>
                      <td>Rp. {{number_format($rincian_peminjaman->cicilan,0,'.','.')}}</td>
                    </tr>
                  </tbody>
                </table>
                <h6>*Uang Sebesar Rp. {{number_format($rincian_peminjaman->cicilan,0,'.','.')}} Akan Ditambahkan Ke Data Pembayaran Anggota</h6>
                <h6>&nbsp;&nbsp;Tekan Bayar Untuk Menyetujui Pembayaran</h6>
            <button type="submit" class="btn btn-primary float-right">Bayar</button>
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
