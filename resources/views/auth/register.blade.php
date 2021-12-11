<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Koperasisaw | Daftar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Koperasisaw</b></a>
  </div>

  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible">
          <ul>
{{ $message }}
</ul>
        </div>
  @endif
@if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                <i>{{ $error }}</i>
            @endforeach
        </ul>
      </div>
@endif
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar</p>

      <form method="POST" action="{{ route('register') }}">
            @csrf
        <div class="form-group">
          <input type="number" name="nik" class="form-control" value="{{old('nik')}}" onkeyPress="if(this.value.length == 16) return false; " placeholder="NIK">
        </div>

        <div class="form-group">
          <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Nama Lengkap">
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <input type="text" name="tempat_lahir" class="form-control" value="{{old('tempat_lahir')}}" placeholder="Tempat Lahir">
            </div>
            <div class="col-6">
              <input type="text" name="tgl_lahir" onfocus="(this.type='date')" value="{{old('tgl_lahir')}}" id="date" placeholder="Tanggal Lahir" class="form-control" >
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
              <input type="text" name="provinsi" placeholder="Provisi" value="{{old('provinsi')}}" class="form-control" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
                <input type="text" name="kota" placeholder="Kabupaten / Kota" value="{{old('kota')}}" class="form-control" >
              </div>
            </div>
          </div>
          
          <div class=row>
            <div class="col-6">
                <div class="form-group">
                  <input type="text" name="kec" placeholder="Kecamatan" value="{{old('kec')}}" class="form-control" >
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" name="kel" placeholder="Kelurahan / Desa" value="{{old('kel')}}" class="form-control" >
                </div>
              </div>
            </div>

            <div class=row>
          <div class="col-6">
            <div class="form-group">
                <input type="number" name="rt" placeholder="Rt" value="{{old('rt')}}" class="form-control" >
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <input type="number" name="rw" placeholder="Rw" value="{{old('rw')}}" class="form-control" >
              </div>
            </div>
          </div>

            <div class="form-group">
              <input type="text" name="alamat" placeholder="Alamat Rumah" value="{{old('alamat')}}" class="form-control" >
            </div>
            
        <div class="form-group">
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
          <select name="status_perkawinan" class="form-control">
              <option value="">-- Pilih Status Perkawinan --</option>
              <option value="Kawin" {{ old('status_perkawinan') == "Kawin" ? "selected" : "" }}>Kawin</option>
              <option value="Belum Kawin" {{ old('status_perkawinan') == "Belum Kawin" ? "selected" : "" }}>Belum Kawin</option>
              <option value="Cerai Hidup" {{ old('status_perkawinan') == "Cerai Hidup" ? "selected" : "" }}>Cerai Hidup</option>
              <option value="Cerai Mati" {{ old('status_perkawinan') == "Cerai Mati" ? "selected" : "" }}> Cerai Mati</option>
          </select>
        </div>

        <div class="form-group">
          <input type="text" name="pekerjaan" class="form-control" value="{{old('pekerjaan')}}" placeholder="Pekerjaan">
        </div>
        
        <div class="form-group">
          <input type="text" name="kewarganegaraan" class="form-control" value="{{old('kewarganegaraan')}}" placeholder="Kewarganegaraan">
        </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" id="pw" placeholder="Kata Sandi">
            </div>  
        
            <div class="form-group">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Konformasi Kata Sandi">
            </div>

        <div class="row">
          <div class="col-12">
              <br>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <a href="{{route('login')}}" class="text-center">Sudah Memiliki Akun?</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script>
  function myFunction() {
  var x = document.getElementById("pw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>
