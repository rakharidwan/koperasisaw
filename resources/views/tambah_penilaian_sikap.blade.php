@extends('layouts.temp')

@section('title', 'Tambah Penilaian Sholat')

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
              <li class="breadcrumb-item"><a href="{{url('/penilaian')}}">Penilaian</a></li>
              <li class="breadcrumb-item"><a href="{{url('/penilaian/'.$karyawan->id_karyawan)}}">{{$karyawan->nik}}</a></li>
              <li class="breadcrumb-item">Tamabah Penilaian Sholat</li>
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
                  <h3 class="card-title">Tambah Penilaian Sikap</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <form method="POST" action="{{ url('penilaian/'.$id.'/tambah-penilaian-sikap/simpan') }}">
            @csrf
            <dl>
                <dt>Karyawan</dt>
                <dd>{{$karyawan->nik}} - {{$karyawan->nama}}&nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#modal-default"><i class="fa fa-info"></i></a></dd>
            </dl>
            
    <div class="form-group">
            <label for="nilai">Nilai Sikap</label>
            <select name="nilai" id="myselect" class="form-control">
                <option value="">-- Pilih Nilai Sikap --</option>
                <option value="A"{{ old('nilai') == 'A' ? "selected" : "" }}>A - Sangat Baik</option>
                <option value="B"{{ old('nilai') == 'B' ? "selected" : "" }}>B - Cukup Baik</option>
                <option value="C"{{ old('nilai') == 'C' ? "selected" : "" }}>C - Baik</option>
                <option value="D"{{ old('nilai') == 'D' ? "selected" : "" }}>D - Kurang</option>
                <option value="E"{{ old('nilai') == 'E' ? "selected" : "" }}>E - Buruk</option>
            </select>
        </div>
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </form>
      
    </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Profil Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <dl>
                  <dt>NIK</dt>
                      <dd>{{$karyawan->nik}}</dd>
                      <dt>Nama</dt>
                      <dd>{{$karyawan->nama}}</dd>
                      <dt>Tempat Tanggal Lahir</dt>
                      <dd>{{$karyawan->tempat_lahir}}, {{ date('d F Y', strtotime($karyawan->tanggal_lahir)); }}</dd>
                      <dt>Jenis Kelamin</dt>
                      @if($karyawan->jenis_kelamin == 'P')
                      <dd>Pria</dd>
                      @elseif($karyawan->jenis_kelamin == 'W')
                      <dd>Wanita</dd>
                      @endif
                      <dt>Alamat Lengkap</dt>
                      <dd>{{$karyawan->alamat}}, RT.0{{$karyawan->rt}}/RW.0{{$karyawan->rw}}, {{$karyawan->kelurahan_desa}}, Kec. {{$karyawan->kecamatan}}, {{$karyawan->kabupaten_kota}}, {{$karyawan->provinsi}}</dd>
                      <dt>Agama</dt>
                      <dd>{{$karyawan->agama}}</dd>
                      <dt>Pekerjaan</dt>
                      <dd>{{$karyawan->pekerjaan}}</dd>
                      <dt>Status Perkawinan</dt>
                      <dd>{{$karyawan->status_perkawinan}}</dd>
                      <dt>Kewarganegaraan</dt>
                      <dd>{{$karyawan->kewarganegaraan}}</dd>
                  </dl>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <script>
    $('#modal-default').on('modal', function(){
      $('modal-default').trigger('focus')
    })
  </script>
  @endsection
