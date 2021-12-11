<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Koperasisaw | Masuk</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <style type="text/css">
    .black{
      color:#666;
      font-size:1.2rem;
    }
  </style>
</head>
<div class="login-logo">
    <a href="#"><b>Koperasisaw</b></a>
    </div>
<body class="hold-transition login-page">
    <div class="login-box">
    @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
          </div>
    @endif
    @if ($message = Session::get('gagal'))
  <div class="alert alert-danger alert-dismissible">
          <ul>
{{ $message }}
</ul>
        </div>
  @endif
    @if ($message = Session::get('email'))
  <div class="alert alert-danger alert-dismissible">
          <ul>
{{ $message }}
</ul>
        </div>
  @endif
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk</p>

            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="( NIK@koperasisaw.com )" id="email" name="email" value="{{old('email')}}" required autofocus>
                  
                </div>
                <div class="input-group mb-3" id="pw">
                  <input type="password" class="form-control" placeholder="Kata Sandi"  id="password"
                  name="password"
                  required autocomplete="current-password" >
                  <div class="input-group-append">
            <div class="input-group-text">
            <a href="#" id="icon" type="checkbox" class="far fa-eye black" onclick="myFunction()"></a>

                </div>
              </div>
            </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 mb-2">
              <br>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-3">
        <a href="{{route('register')}}" class="text-center">Daftar Anggota</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script>
  function myFunction() {
  var x = document.getElementById("password");
  var i = document.getElementById("icon");
  if (i.className === "far fa-eye black") {
    i.className = "fa fa-eye-slash black";
  } else {
    i.className = "far fa-eye black";
  }

  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }


}
</script>
</body>
</html>
