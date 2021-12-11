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
                  <h3 class="card-title">Tambah Penilaian Sholat</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <form method="POST" action="{{ url('penilaian/'.$id.'/tambah-penilaian-sholat/simpan') }}">
            @csrf
            <dl>
                <dt>Karyawan</dt>
                <dd>{{$karyawan->nik}} - {{$karyawan->nama}}&nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#modal-default"><i class="fa fa-info"></i></a></dd>
            </dl>
            <div class="form-group">
                <label for="">Penilaian Sholat</label>
                <h6>Waktu Sholat :</h6>
                <div class="row">
                    <div class="col-md-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="subuh" {{ old('subuh') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label">Subuh</label>
                </div>
            </div>
            <div class="col-md-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="dzuhur"{{ old('dzuhur') == '1' ? "checked" : "" }}>
                <label class="form-check-label">Dzuhur</label>
            </div>
            </div>
            <div class="col-md-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="ashar"{{ old('ashar') == '1' ? "checked" : "" }}>
                <label class="form-check-label">Ashar</label>
            </div>
            </div>
            <div class="col-md-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="maghrib"{{ old('maghrib') == '1' ? "checked" : "" }}>
                <label class="form-check-label">Maghrib</label>
            </div>
            </div>
            <div class="col-md-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="isya"{{ old('isya') == '1' ? "checked" : "" }}>
                <label class="form-check-label">isya</label>
            </div>
            </div>
            <div class="col-md-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="sunnah"{{ old('sunnah') == '1' ? "checked" : "" }}>
                <label class="form-check-label">Sunnah</label>
            </div>
            </div>
        </div>
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
