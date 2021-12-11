@extends('layouts.temp')

@section('title', 'Anggota')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Verifikasi Anggota</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/anggota')}}">Anggota</a></li>
                <li class="breadcrumb-item">Verifikasi Anggota</li>
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
          @foreach(['primary','danger','success'] as $msg)
        @if ($message = Session::has($msg))
  <div class="alert alert-{{$msg}} alert-dismissible">
          <ul>
          {{ Session::get($msg) }}
</ul>
        </div>
  @endif
  @endforeach
            <div class="card table-responsive">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pembayaran Terlambat Bulan Ini</h3>
                  <a href="{{url()->previous()}}" class=float-right><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <b>* Dengan Menyetujui Calon Anggota Yang Mendaftar Maka Data Tersebut Akan Resmi Menjadi Anggota</b>
                <table class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tempat/Tanggal Lahir</th>
                    <th>Status Akun</th>
                    <th>Waktu Mendaftar</th>
                    <th>Aksi</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($anggota as $data_anggota)
                  <tr id="td">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_anggota->nik }}</td>
                    <td>{{ $data_anggota->nama }}</td>
                    <td>{{ $data_anggota->tempat_lahir }}, {{ date('d F Y', strtotime($data_anggota->tanggal_lahir)); }}</td>
                    <td>{{ $data_anggota->status_akun }}</td>
                    <td>{{ $data_anggota->created_at }}</td>
                    <td>
                      <a href="{{url('/anggota/verifikasi_akun/rincian/'.$data_anggota->id_user)}}" class="btn btn-success btn-sm "><i class="fa fa-eye"></i></a>
                      <form action="{{url('anggota/verifikasi_akun/'.$data_anggota->id_user)}}" method="post">
                    @csrf
                    @method('patch')
                        @if($data_anggota->status_akun == 'menunggu verifikasi')
                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="tolak"><i class="fa fa-user-times"></i></button>
                        <button type="submit" class="btn btn-primary btn-sm" name="action" value="terima"><i class="fa fa-user-check"></i></button>
                        @endif
                        @if($data_anggota->status_akun == 'ditolak')
                        <button type="submit" class="btn btn-warning btn-sm" name="action" value="pulihkan"><i class="fa fa-undo-alt"></i></button>
                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="hapus"><i class="fas fa-trash"></i></button>
                        @endif
                    </form>
                    </td>
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

  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
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
  @endsection
      
