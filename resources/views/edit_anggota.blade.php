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
              <li class="breadcrumb-item"><a href="#">Anggota</a></li>
              <li class="breadcrumb-item active">Ubah Anggota</li>
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
              <div class="card-header">
                <h3 class="card-title">Ubah Data Anggota</h3>
                <a href="{{url('/anggota')}}" class=float-right><i class="fa fa-arrow-left"></i> Kembali</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('anggota/perbarui/'.$anggota->id_user)}}" method="post">
                @csrf
                @method('patch')
                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control" value="{{old('nik',$anggota->nik)}}" name="nik" onkeyPress="if(this.value.length == 16) return false; "  placeholder="Masukan NIK" required autofocus>
                  </div>
                
                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{old('name', $anggota->nama)}}" name="name" onkeyPress="if(this.value.length == 50) return false; "  placeholder="Masukan Nama Lengkap" required autofocus>
                  </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="tempat_lahir">Tempat Lahir</label>
                      <input type="text" class="form-control" value="{{old('tempat_lahir', $anggota->tempat_lahir)}}" name="tempat_lahir" onkeyPress="if(this.value.length == 15) return false; "  placeholder="Masukan Tempat Lahir" required autofocus>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="Date" class="form-control" name="tanggal_lahir" value="{{old('tanggal_lahir',$anggota->tanggal_lahir)}}" placeholder="Masukan Tanggal Lahir"  required autofocus>
                    </div>
                  </div>
                </div>
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <div class="form-check">
                  <input class="form-check-input" value="P" type="radio" name="jk" {{ old('jk', $anggota->jenis_kelamin) == "P" ? 'checked' : '' }}>
                  <label class="form-check-label">Pria</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" value="W" type="radio" name="jk" {{ old('jk', $anggota->jenis_kelamin) == "W" ? 'checked' : '' }}>
                    <label class="form-check-label">Wanita</label>
                </div>
                <br>
                <label for="alamat">Alamat Leng kap</label>
        <div class=row>
          <div class="col-6">
            <div class="form-group">
              <input type="text" name="prov" placeholder="Provisi" value="{{old('prov',$anggota->provinsi)}}" class="form-control" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
                <input type="text" name="kota" placeholder="Kabupaten / Kota" value="{{old('kota',$anggota->kabupaten_kota)}}" class="form-control" >
              </div>
            </div>
          </div>
          
          <div class=row>
            <div class="col-6">
                <div class="form-group">
                  <input type="text" name="kec" placeholder="Kecamatan" value="{{old('kec',$anggota->kecamatan)}}" class="form-control" >
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" name="kel" placeholder="Kelurahan / Desa" class="form-control" value="{{old('kel',$anggota->kelurahan_desa)}}">
                </div>
              </div>
            </div>

            <div class=row>
          <div class="col-6">
            <div class="form-group">
                <input type="number" name="rt" placeholder="Rt" value="{{old('rt',$anggota->rt)}}" class="form-control" >
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <input type="number" name="rw" placeholder="Rw" :value="old('rw')" class="form-control" value="{{old('rw',$anggota->rw)}}">
              </div>
            </div>
          </div>
                <div class="form-group">
            <textarea name="alamat" placeholder="Alamat Lengkap" class="form-control" required autofocus>{{old('alamat', $anggota->alamat)}}</textarea>
          </div>
          
          <div class="form-group">
            <label for="agama">Agama</label>
            <select name="agama" class="form-control" required>
                  <option value="">-- Pilih Agama --</option>
                  <option value="Islam" {{ old('agama', $anggota->agama) == "Islam" ? 'selected' : '' }}>Islam</option>
                  <option value="Protestan" {{ old('agama', $anggota->agama) == "Protestan" ? 'selected' : '' }}>Protestan</option>
                  <option value="Katolik" {{ old('agama', $anggota->agama) == "Katolik" ? 'selected' : '' }}>katolik</option>
                  <option value="Hindu" {{ old('agama', $anggota->agama) == "Hindu" ? 'selected' : '' }}>Hindu</option>
                  <option value="Buddha" {{ old('agama', $anggota->agama) == "Buddha" ? 'selected' : '' }}>Buddha</option>
                  <option value="Khonghucu" {{ old('agama', $anggota->agama) == "Khonghucu" ? 'selected' : '' }}>Khonghucu</option>
                  <option value="Lainnya" {{ old('agama', $anggota->agama) == "Lainnya" ? 'selected' : '' }}>Lainnya</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" placeholder="Masukan Pekerjaan" class="form-control" onkeyPress="if(this.value.length == 20) return false; "  value="{{old('pekerjaan',$anggota->pekerjaan)}}" required autofocus>
              </div>
              
              <div class="form-group">
                <label for="status_perkawinan">Status Perkawinan</label>
                <select name="status_perkawinan" class="form-control" required autofocus>
                    <option value="">-- Pilih Status Perkawinan --</option>
                    <option value="Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == "Kawin" ? 'selected' : '' }}>Kawin</option>
                    <option value="Belum Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == "Belum Kawin" ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan', $anggota->status_perkawinan) == "Cerai Hidup" ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan', $anggota->status_perkawinan) == "Cerai Mati" ? 'selected' : '' }}>Cerai Mati</option>
                  </select>
                </div>
              <div>
                <div class="form-group">
                  <label for="kewarganegaraan">Kewarganegaraan</label>
                  <input type="text" name="kewarganegaraan" placeholder="Masukan Kewarganegaraan" onkeyPress="if(this.value.length == 20) return false; "  value="{{old('kewarganegaraan',$anggota->kewarganegaraan)}}" class="form-control" required autofocus>
                </div>
                
              </div>
              
                <button class="btn btn-primary float-right">Selesai</button>
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
