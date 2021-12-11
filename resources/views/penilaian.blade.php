@extends('layouts.temp')

@section('title', 'Penilaian')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penilaian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Penilaian</li>
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
                  <h3 class="card-title">Data Karyawan</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width: 2%;">NO</th>
                    <th style="width: 15%;">NIK</th>
                    <th >Nama</th>
                    <th style="width: 20%;">Tempat/Tanggal Lahir</th>
                    <th style="width: 4%;">Aksi</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($karyawan as $data_karyawan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_karyawan->nik }}</td>
                    <td>{{ $data_karyawan->nama }}</td>
                    <td>{{ $data_karyawan->tempat_lahir }}, {{ date('d F Y', strtotime($data_karyawan->tanggal_lahir)); }}</td>
                    <td>
                    <a href="{{url('penilaian',[$data_karyawan->id_karyawan])}}"class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a>
                  </tr>
                  
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
