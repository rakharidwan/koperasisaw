@extends('layouts.temp')

@section('title', 'Daftar Kolektif')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daftar Kolektif</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Daftar Kolektif</li>
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
                  <h3 class="card-title">Daftar Kolektif</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                    <th style="width:2%">No</th>
                    <th>Anggota</th>
                    <th style="width:15%">Tanggal Pembayaran</th>
                    <th style="width:15%">Nominal Pembayaran</th>
                    <th style="width:15%">Terlambat</th>
                    </tr>
                    @forelse($kolektif as $pm)
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
