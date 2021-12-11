@extends('layouts.temp')

@section('title', 'Karyawan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Karyawan</li>
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
                  <a href="{{url('karyawan/tambah')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width : 1%">NO</th>
                    <th style="width :15%">NIK</th>
                    <th>Nama</th>
                    <th style="width :20%">Tempat/Tanggal Lahir</th>
                    <th style="width : 10%">Aksi</th>
                    
                  </tr>
                  </thead>
                  <?php 
                      Use \Carbon\Carbon;
                    ?>
                  <tbody>
                      @foreach($karyawan as $data_karyawan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_karyawan->nik }}</td>
                    <td>{{ $data_karyawan->nama }}</td>
                    <td>{{ $data_karyawan->tempat_lahir }}, {{ Carbon::parse($data_karyawan->tanggal_lahir)->translatedFormat('d F Y');  }}</td>
                    <td>
                    <a href="{{url('/karyawan',[$data_karyawan->id_user])}}" class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a>
                    <a href="{{url('/karyawan/ubah',[$data_karyawan->id_user])}}" class="btn btn-warning btn-sm"><i class="fa fa-pen"></i></a>
                    <a href="{{url('/karyawan/hapus',[$data_karyawan->id_user])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             {{$karyawan}}
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
