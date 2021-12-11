@extends('layouts.temp')

@section('title', 'Dashboard')

@section('content')
<style>
  .link{
    cursor: pointer;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @if(auth()->user()->role == 'Admin')
      <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/pencapaian/'.date('m', strtotime($waktu)).'/'.date('Y', strtotime($waktu)))}}">
              <div class="info-box bg-primary link">
                <span class="info-box-icon"><i class="fa fa-trophy"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Pencapaian Bulan Ini</span>
                <span class="info-box-number">{{ date('F Y', strtotime($waktu)) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('anggota/verifikasi_akun')}}">

              <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-user-clock"></i></span>
                
                <div class="info-box-content">
                  <span class="info-box-text">Anggota Meminta Persetujuan</span>
                  <span class="info-box-number">{{ $jumlah_anggota_belum_diverifikasi }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </a>
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('dashboard/peminjaman_belum_lunas')}}">

              <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fa fa-money-check-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Peminjaman Belum Lunas</span>
                <span class="info-box-number">{{ $peminjaman_belum_lunas }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/dashboard/pembayaran_terlambat')}}">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fa fa-search-dollar"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Pembayaran Terlambat Bulan Ini</span>
                <span class="info-box-number">{{ $pembayaran_terlambat }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </a>
          <!-- /.col -->
        </div>
        @endif
        <div class="row">
        <div class="col-sm-8">
          <div class="card">
          <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">@if(auth()->user()->role == 'Admin') Pembayaran Masuk Hari Ini @endif</h3>
                </div>
              </div>
            <div class="card-body table-responsive">
            @if(auth()->user()->role == 'Admin')
                <table class="table table-bordered">
                  <tr>
                    <th>No</th>
                    <th>Anggota</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Nominal Pembayaran</th>
                    <th>Terlambat</th>
                  </tr>
                  @forelse($pembayaran_masuk as $pm)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pm->nik}} - {{$pm->nama}}</td>
                    <td>{{$pm->tanggal_pembayaran}}</td>
                    <td>Rp. {{number_format($pm->total_pembayaran,0,'.','.')}}</td>
                    @if($pm->terlambat > 0 )
                    <td>{{$pm->terlambat}} Hari</td>
                    @else
                    <td>-</td>
                    @endif
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5">
                    <center>
                        Tidak Ada Data Dalam Tabel
                      </center>
                    </td>
                  </tr>
                  @endforelse
                </table>
                @endif
                @if(auth()->user()->role == 'Anggota')
                  <h2>Hallo {{auth()->user()->name}}</h2>
                @endif
            </div>
            </div>
          </div>
        <div class="col-sm-4">
        <div class="card card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Koperasisaw Bot</span>
                      <span class="direct-chat-timestamp float-right">{{date('d M h:i a',strtotime($waktu))}}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        Selamat {{$w}} {{auth()->user()->name}}!! Bagaimana? Masih semangat untuk beraktivitas hari ini? Tenang saja Koperasisaw siap melayani anda kapanpun dan dimanapun.Tetap semangat dan jaga kesehatan Yaa...
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                 
                  <!-- /.direct-chat-msg -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <a href="#"class="btn btn-primary">Send</a>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
