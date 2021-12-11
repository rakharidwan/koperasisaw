@extends('layouts.temp')

@section('title', 'Profil')

@section('content')
<?php 
   Use \Carbon\Carbon;
 ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Profil</li>
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
            @if(auth()->user()->role == 'Admin')
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

                <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                <p class="text-muted text-center">{{ $admin->role }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Anggota</b> <a href="{{url('/anggota')}}" class="float-right">{{$jumlah_anggota}} Orang</a>
                  </li>
                  <li class="list-group-item">
                    <b>Karyawan</b> <a href="{{url('/karyawan')}}" class="float-right">{{$jumlah_karyawan}} Orang</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-4">
            <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                </div>
            </div>
              <div class="card-body">
                  <dl><dt>Email</dt>
                      <dd>{{$admin->email}}</dd></dl>
              </div>
            </div>
        </div>
        @endif
            @if(auth()->user()->role == 'Anggota')
        <div class="col-xl-3 col-lg-12 col-md-12">
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

                <h3 class="profile-username text-center">{{ $anggota->name }}</h3>

                <p class="text-muted text-center">{{ $anggota->role }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Saldo Simpanan</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Karyawan</b> <a class="float-right">543</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xl-4 col-lg-9 col-md-9">
            <div class="card">
            <div class="card-header border-0">
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
        @endif
            @if(auth()->user()->role == 'Karyawan')
        <div class="col-xl-3 col-lg-12 col-md-12">
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

                <h3 class="profile-username text-center">{{ $karyawan->name }}</h3>

                <p class="text-muted text-center">{{ $karyawan->role }}</p>
                 
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Kolektif</b> <a class="float-right">{{$kolektif}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Sholat</b> <a class="float-right">{{$sholat->sum('subuh') + $sholat->sum('dzuhur') + $sholat->sum('ashar') + $sholat->sum('maghrib') + $sholat->sum('isya') + $sholat->sum('sunnah')}}</a>
                  </li>
                  <li class="list-group-item">
                    @if($sikap->nilai == null)
                    <b>Sikap</b> <a class="float-right">0</a>
                    @endif
                    <b>Sikap</b> <a class="float-right">{{$sikap->nilai}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tanggal Penilaian</b> <a class="float-right">{{Carbon::now()->translatedFormat('d F Y');}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xl-9 col-lg-12 col-lg-12">
            <div class="card">
            <div class="card-header border-0">
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
        @endif
    </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
