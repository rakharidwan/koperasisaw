@extends('layouts.temp')

@section('title', 'Pencapaian')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pencapaian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Pencapaian</li>
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
                  <h3 class="card-title">Pencapaian</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width : 3px">No</th>
                    <th>Bulan</th>
                    <th style="width : 60px"></th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($penilaian as $p)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ date('F - Y', strtotime($p->tanggal_penilaian)); }}</td>
                        <td><a href="{{url('/pencapaian',[date('m', strtotime($p->tanggal_penilaian)),date('Y', strtotime($p->tanggal_penilaian))])}}" class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a></td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="3">
                          <center>
                            Tidak Ada Data Dalam Tabel
                          </center>
                        </td>
                      </tr>
                      @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection
