@extends('layouts.temp')

@section('title', 'Tambah Pinjaman')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pinjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/pinjaman')}}">Pinjaman</a></li>
              <li class="breadcrumb-item">Tambah Pinjaman</li>
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
                  <h3 class="card-title">Tambah Pinjaman</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <form method="POST" action="{{ url('pinjaman/simpan') }}">
            @csrf
            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                <div class="input-group">
                <div class="input-group-prepend">
                      <span class="input-group-text"><b>Rp. </b></span>
                    </div>
                    <input type="number" value="{{old('jumlah_pinjaman')}}" placeholder="Masukan Jumlah Pinjaman" onkeyPress="if(this.value.length == 9) return false; "name="jumlah_pinjaman" class="form-control" required autofocus class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="bunga">Margin</label>
                        <div class="input-group">
                            <input type="number" value="{{old('bunga')}}" onkeyPress="if(this.value.length == 2) return false; " placeholder="Masukan Margin" name="bunga" class="form-control" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <b>%</b>
                                </div>
                                </div>
                    </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tenor">Tempo</label>
                        <div class="input-group">
                            <input type="text" value="{{old('tenor')}}" placeholder="Masukan Tempo" onkeyPress="if(this.value.length == 3) return false; " value="{{old('tenor')}}" name="tenor" class="form-control" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <b>Minggu</b>
                                </diV>
                                </diV>
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
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
     function validate_int(myEvento) {
  if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
    dato = true;
  } else {
    dato = false;
  }
  return dato;
}

function phone_number_mask() {
  var myMask = "000000";
  var myCaja = document.getElementById("j");
  var myText = "";
  var myNumbers = [];
  var myOutPut = ""
  var theLastPos = 1;
  myText = myCaja.value;
  //get numbers
  for (var i = 0; i < myText.length; i++) {
    if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
      myNumbers.push(myText.charAt(i));
    }
  }
  //write over mask
  for (var j = 0; j < myMask.length; j++) {
    if (myMask.charAt(j) == "0") { //replace "_" by a number 
      if (myNumbers.length == 0)
        myOutPut = myOutPut + myMask.charAt(j);
      else {
        myOutPut = myOutPut + myNumbers.shift();
        theLastPos = j + 1; //set caret position
      }
    } else {
      myOutPut = myOutPut + myMask.charAt(j);
    }
  }
  document.getElementById("j").value = myOutPut;
  document.getElementById("j").setSelectionRange(theLastPos, theLastPos);
}

document.getElementById("j").onkeypress = validate_int;
document.getElementById("j").onkeyup = phone_number_mask;
  </script>
 
  @endsection
