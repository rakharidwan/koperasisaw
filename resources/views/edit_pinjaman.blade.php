@extends('layouts.temp')

@section('title', 'Edit Pinjaman')

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
              <li class="breadcrumb-item">Edit Pinjaman</li>
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
                  <h3 class="card-title">Edit Pinjaman</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <form method="POST" action="{{ url('pinjaman/perbarui/'.$pinjaman->id_pinjaman) }}">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                <div class="input-group">
                <div class="input-group-prepend">
                      <span class="input-group-text"><b>Rp. </b></span>
                    </div>
                    <input type="number" value="{{old('jumlah_pinjaman',$pinjaman->jumlah_pinjaman)}}" placeholder="Masukan Jumlah Pinjaman" onkeyPress="if(this.value.length == 7) return false; "name="jumlah_pinjaman" class="form-control" required autofocus class="form-control">
                </div>
            </div>
            <div class="row">
            <div class="col-3">
                    <div class="form-group">
                        <label for="cicilan">Cicilan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                      <span class="input-group-text"><b>Rp. </b></span>
                    </div>
                            <input type="number" value="{{old('cicilan',$pinjaman->cicilan)}}" onkeyPress="if(this.value.length == 7) return false; " placeholder="Masukan Cicilan" value="{{old('cicilan')}}" name="cicilan" class="form-control" required autofocus>

                    </div>
                    </div>
                </div>
                
                <div class="col-3">
                    <div class="form-group">
                        <label for="bunga">Bunga</label>
                        <div class="input-group">
                            <input type="number" value="{{old('bunga',$pinjaman->bunga)}}" onkeyPress="if(this.value.length == 2) return false; " placeholder="Masukan Bunga" name="bunga" class="form-control" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <b>%</b>
                                </diV>
                                </diV>

                    </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="tenor">Tenor</label>
                        <div class="input-group">
                            <input type="text" value="{{old('tenor',$pinjaman->tenor)}}" placeholder="Masukan Tenor" onkeyPress="if(this.value.length == 2) return false; " value="{{old('tenor')}}" name="tenor" class="form-control" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <b>Bulan</b>
                                </diV>
                                </diV>

                    </div>
                    </div>
                </div>
                <div class="col-3">
                <div class="form-group">
                        <label for="bunga">Denda</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                      <div class="input-group-text"><b>Rp. </b></div>
                    </div>
                            <input type="number" value="{{old('denda',$pinjaman->denda)}}" onkeyPress="if(this.value.length == 5) return false; " placeholder="Masukan Denda" name="denda" class="form-control" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <b>/ Hari</b>
                                </div>
                                </div>

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
 
  @endsection
