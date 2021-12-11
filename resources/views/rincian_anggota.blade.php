@extends('layouts.temp')

@section('title', 'Profil Anggota')

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
              <li class="breadcrumb-item"><a href="{{url('/anggota')}}">Anggota</a></li>
              <li class="breadcrumb-item">Profil Anggota</li>
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
        <div class="col-lg-3">
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
                <h3 class="profile-username text-center">{{ $anggota->name }}</h3>

                <p class="text-muted text-center">{{ $anggota->role }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-9">
            <div class="card">
            <div class="card-header border-0">
            <a href="{{url('/anggota')}}" class=float-right><i class="fa fa-arrow-left"></i> Kembali</a>
                <div class="d-flex justify-content-between">
                </div>
            </div>
              <div class="card-body">
                  <dl>
                  <dt>NIK</dt>
                      <dd>{{$anggota->nik}}</dd>
                      <dt>Nama</dt>
                      <dd>{{$anggota->nama}}</dd>
                      <dt>Tempat Tanggal Lahir</dt>
                      <dd>{{$anggota->tempat_lahir}}, {{ date('d F Y', strtotime($anggota->tanggal_lahir)); }}</dd>
                      <dt>Jenis Kelamin</dt>
                      @if($anggota->jenis_kelamin == 'P')
                      <dd>Pria</dd>
                      @elseif($anggota->jenis_kelamin == 'W')
                      <dd>Wanita</dd>
                      @endif
                      <dt>Alamat Lengkap</dt>
                      <dd>{{$anggota->alamat}}, RT.0{{$anggota->rt}}/RW.0{{$anggota->rw}}, {{$anggota->kelurahan_desa}}, Kec. {{$anggota->kecamatan}}, {{$anggota->kabupaten_kota}}, {{$anggota->provinsi}}</dd>
                      <dt>Agama</dt>
                      <dd>{{$anggota->agama}}</dd>
                      <dt>Pekerjaan</dt>
                      <dd>{{$anggota->pekerjaan}}</dd>
                      <dt>Status Perkawinan</dt>
                      <dd>{{$anggota->status_perkawinan}}</dd>
                      <dt>Kewarganegaraan</dt>
                      <dd>{{$anggota->kewarganegaraan}}</dd>
                  </dl>
              </div>
            </div>
    </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
