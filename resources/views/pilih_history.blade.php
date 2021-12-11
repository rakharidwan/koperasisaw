@extends('layouts.temp')

@section('title', 'Pembayaran Pinjaman')

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
                <li class="breadcrumb-item">Riwayat</li>
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
        
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pilih Riwayat Peminjaman</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table class="table table-bordered" id="example1">
                      <thead>
                          <tr>
                            <th style="width : 1%">No</th>
                            <th>Anggota</th>
                            <th style="width : 4%">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      @foreach($anggota as $a)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$a->nama}} ( {{$a->nik}} )</td>
                          <td><a href="{{url('peminjaman/riwayat/'.$a->id_anggota)}}" class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a></td>
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
