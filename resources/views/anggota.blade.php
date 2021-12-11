@extends('layouts.temp')

@section('title', 'Anggota')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Anggota</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Anggota</li>
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
                  <h3 class="card-title">Data Anggota</h3>
                  <a href="{{url('/anggota/verifikasi_akun')}}" class="btn"><i class="fas fa-user-clock fa-lg float-right"></i>
                  @if($jabd > 0)
                  <span class="badge bg-danger">{{$jabd}}</span>
                  @endif
                  </a>
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
                    <th style="width : 8%">Aksi</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      Use \Carbon\Carbon;
                    ?>
                      @foreach($anggota as $data_anggota)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_anggota->nik }}</td>
                    <td>{{ $data_anggota->nama }}</td>
                    <td>{{ $data_anggota->tempat_lahir }}, {{ Carbon::parse($data_anggota->tanggal_lahir)->translatedFormat('d F Y');  }}</td>
                    <td>
                    <a href="{{url('/anggota',[$data_anggota->id_user])}}" class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a>
                    <a href="{{url('/anggota/hapus',[$data_anggota->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @endforeach
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
 
  <script type="text/javascript">
$('.modal-default').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  </script>
  @endsection
