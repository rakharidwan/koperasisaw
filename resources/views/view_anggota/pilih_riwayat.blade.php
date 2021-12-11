@extends('layouts.temp')

@section('title', 'Rincian Peminjaman')

@section('content')
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
              <li class="breadcrumb-item">Riwayat Peminjaman</li>
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
    </div>
  @foreach($peminjaman as $p)
      <div class="col-md-3 col-sm-6 col-12">
          <a href="{{url('peminjaman/riwayat/'.$p->year.'/'.$p->month)}}" style="color:black">
              <div class="info-box">
                  <div class="info-box-content">
                      <span class="info-box-number">{{$p->year}}</span>
                      <span class="info-box-text">{{ date('F', strtotime($p->new_date)); }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
        </div>
        @endforeach
            <!-- /.card -->

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
