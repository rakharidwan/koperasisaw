@extends('layouts.temp')

@section('title', 'Profil Karyawan')

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
            <li class="breadcrumb-item"><a href="{{url('/karyawan')}}">Karyawan</a></li>
              <li class="breadcrumb-item">Profil Karyawan</li>
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
        <div class="col-md-3">
            <div class="card">
            <div class="card card border-0">
                <div class="d-flex justify-content-between">
                </div>
              </div>
              <!-- /.card-header -->
                  <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/nopict.png')}}" alt="User profile picture">
                </div>
                <br>

                <h3 class="profile-username text-center">{{ $karyawan->name }}</h3>

                <p class="text-muted text-center">{{ $karyawan->role }}</p>
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-9">
            <div class="card">
            <div class="card-header border-0">
            <a href="{{url('/karyawan')}}" class=float-right><i class="fa fa-arrow-left"></i> Kembali</a>

                <div class="d-flex justify-content-between">
                </div>
            </div>
              <div class="card-body">
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
        </div>
    </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
