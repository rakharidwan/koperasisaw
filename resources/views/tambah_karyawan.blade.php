@extends('layouts.temp')

@section('title', 'Tambah Karyawan')

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
              <li class="breadcrumb-item">Tambah Karyawan</li>
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
        @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
      </div>
@endif
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Tambah Karyawan</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="{{ url('karyawan/simpan') }}">
            @csrf
        <div class="form-group">
        <label for="nik">Nik</label>
          <input type="number" name="nik" class="form-control" value="{{old('nik')}}" onkeyPress="if(this.value.length == 16) return false;" placeholder="Masukan NIK">
        </div>

        <div class="form-group">
        <label for="name">Nama</label>
          <input type="text" name="name" class="form-control" value="{{old('name')}}" onkeyPress="if(this.value.length == 45) return false; " placeholder="Masukan Nama Lengkap">
        </div>
        
        <div class="form-group">
        <label for="ttl">Tempat/Tanggal Lahir</label>
          <div class="row">
            <div class="col-6">
              <input type="text" name="tempat_lahir" class="form-control" value="{{old('tempat_lahir')}}" placeholder="Masukan Tempat Lahir">
            </div>
            <div class="col-6">
              <input type="text" name="tgl_lahir" onfocus="(this.type='date')" value="{{old('tgl_lahir')}}" id="date" placeholder="Masukan Tanggal Lahir" class="form-control" >
            </div>
          </div>
        </div>

        <div class="form-group">
        <label for="exampleInputEmail1">Jenis Kelamin</label>
        <div class="form-check">
          <input class="form-check-input" value="P" type="radio" name="jk" {{ old('jk') == "P" ? "checked" : "" }}>
              <label class="form-check-label">Pria</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="W" type="radio" name="jk" {{ old('jk') == "W" ? "checked" : "" }}>
              <label class="form-check-label">Wanita</label>
            </div>
        </div>
        
        <label for="alamat">Alamat Lengkap</label>
        <div class=row>
          <div class="col-6">
            <div class="form-group">
              <input type="text" name="provinsi" placeholder="Masukan Provisi" onkeyPress="if(this.value.length == 15) return false; " value="{{old('provinsi')}}" class="form-control" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
                <input type="text" name="kota" placeholder="Masukan Kabupaten / Kota" value="{{old('kota')}}" onkeyPress="if(this.value.length == 15) return false; " class="form-control" >
              </div>
            </div>
          </div>
          
          <div class=row>
            <div class="col-6">
                <div class="form-group">
                  <input type="text" name="kec" placeholder="Masukan Kecamatan" value="{{old('kec')}}" onkeyPress="if(this.value.length == 20) return false; " class="form-control" >
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" name="kel" placeholder="Masukan Kelurahan / Desa" value="{{old('kel')}}" onkeyPress="if(this.value.length == 20) return false; " class="form-control" >
                </div>
              </div>
            </div>

            <div class=row>
          <div class="col-6">
            <div class="form-group">
                <input type="number" name="rt" placeholder="Masukan Rt" value="{{old('rt')}}" class="form-control" onkeyPress="if(this.value.length == 2) return false; " >
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <input type="number" name="rw" placeholder="Masukan Rw" value="{{old('rw')}}" class="form-control"onkeyPress="if(this.value.length == 2) return false; " >
              </div>
            </div>
          </div>

            <div class="form-group">
              <input type="text" name="alamat" placeholder="Masukan Alamat Rumah" value="{{old('alamat')}}" class="form-control" >
            </div>
            
        <div class="form-group">
        <label for="agama">Agama</label>
          <select name="agama" class="form-control">
            <option value="">-- Pilih Agama --</option>
            <option value="Islam" {{ old('agama') == "Islam" ? "selected" : "" }}>Islam</option>
            <option value="Protestan" {{ old('agama') == "Protestan" ? "selected" : "" }}>Protestan</option>
            <option value="Katolik" {{ old('agama') == "Katolik" ? "selected" : "" }}>katolik</option>
            <option value="Hindu" {{ old('agama') == "Hindu" ? "selected" : "" }}>Hindu</option>
            <option value="Buddha" {{ old('agama') == "Buddha" ? "selected" : "" }}>Buddha</option>
            <option value="Khonghucu" {{ old('agama') == "Khonghucu" ? "selected" : "" }}>Khonghucu</option>
            <option value="Lainnya" {{ old('agama') == "Lainnya" ? "selected" : "" }}>Lainnya</option>
          </select>
        </div>

        <div class="form-group">
        <label for="status_perkawinan">Status Perkawinan</label>
          <select name="status_perkawinan" class="form-control">
              <option value="">-- Pilih Status Perkawinan --</option>
              <option value="Kawin" {{ old('status_perkawinan') == "Kawin" ? "selected" : "" }}>Kawin</option>
              <option value="Belum Kawin" {{ old('status_perkawinan') == "Belum Kawin" ? "selected" : "" }}>Belum Kawin</option>
              <option value="Cerai Hidup" {{ old('status_perkawinan') == "Cerai Hidup" ? "selected" : "" }}>Cerai Hidup</option>
              <option value="Cerai Mati" {{ old('status_perkawinan') == "Cerai Mati" ? "selected" : "" }}> Cerai Mati</option>
          </select>
        </div>

        <div class="form-group">
        <label for="pekerjaan">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" value="{{old('pekerjaan')}}" placeholder="Masukan Pekerjaan" onkeyPress="if(this.value.length == 20) return false; ">
        </div>
        
        <div class="form-group">
        <label for="kewarganegaraan">Kewarganegaraan</label>
          <input type="text" name="kewarganegaraan" class="form-control" value="{{old('kewarganegaraan')}}" placeholder="Masukan Kewarganegaraan" onkeyPress="if(this.value.length == 25) return false; ">
        </div>

        <div class="form-group">
        <label for="password">Kata Sandi</label>
          <input type="text" name="password" class="form-control" placeholder="Masukan Kata Sandi" onkeyPress="if(this.value.length == 20) return false; ">
        </div>
              <br>
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
         
      </form>
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
