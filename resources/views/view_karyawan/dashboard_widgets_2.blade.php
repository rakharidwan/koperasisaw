@extends('layouts.temp')

@section('title', 'Riwayat Penilaian')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Riwayat Penilaian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Riwayat Penilaian</li>
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
                  <h3 class="card-title">Riwayat Penilaian</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                    <th style="width:2%">No</th>
                    <th>Tanggal Penilaian</th>
                    <th style="width:10%">Nilai Sikap</th>
                    <th style="width:10%">Nilai Sholat</th>
                    <th style="width:10%">Jumlah Kolektif</th>
                    <th style="width:15%">Jumlah Keseluruhan</th>
                    </tr>
                    @forelse($penilaian as $pm)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pm->tanggal_penilaian}}</td>
                        <td>{{$pm->nilai_sikap}}</td>
                        <td>{{$pm->nilai_sholat}}</td>
                        <td>{{$pm->nilai_kolektif}}</td>
                        <td>{{$pm->jumlah_nilai}}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6">
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
