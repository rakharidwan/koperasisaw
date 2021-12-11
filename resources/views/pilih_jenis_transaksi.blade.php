@extends('layouts.temp')

@section('title', 'Pilih Jenis Transaksi')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Simpanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/simpanan')}}">Simpanan</a></li>
              <li class="breadcrumb-item"><a href="{{url('/simpanan/'.$id)}}">Rincian Simpanan</a></li>
              <li class="breadcrumb-item">Pilih Jenis Transaksi</li>
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

<div class="row">
                  <div class="col-xl-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Simpanan Anggota</h3>
                </div>
              </div>
              <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2" class="text-center"  style="width: 2px;">No</th>
                            <th rowspan="2" class="text-center">Tanggal Transaksi</th>
                            <th colspan="2" class="text-center">Jenis Transaksi</th>
                        </tr>
                        <tr>
                       <th>Debit</th>
                            <th>Kredit</th>
                       </tr>
                       @forelse($simpanan as $s)
                       <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $s->tanggal_transaksi }}</td>
                           @if($s->jenis_transaksi == 'Debit')
                           <td>Rp. {{ number_format($s->debit,0,'.','.') }}</td>
                           <td></td>
                           @endif
                           @if($s->jenis_transaksi == 'Kredit')
                           <td></td>
                           <td>Rp. {{ number_format($s->kredit,0,'.','.') }}</td>
                           @endif
                       </tr>
                       @empty
                       <tr>
                         <td colspan="5" class="text-center">
                           Anggota Ini Belum Memiliki Simpanan
                          </td>
                        </tr>
                        @endforelse
                        <tr>
                          <th colspan="2">Saldo</th>
                            @if($simpanan_anggota > [0])
                            <td colspan="2" >Rp. {{number_format($simpanan_anggota->saldo,0,'.','.')}}</td>
                            @else
                            <td colspan="2" >Rp. 0</td>
                            @endif
                          </tr>
                      </table>
                  </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
                  <div class="col-xl-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pilih Jenis Transaksi</h3>
                </div>
              </div>
              <div class="card-body">
        <form method="POST" action="{{ url('simpanan/'.$id.'/pilih-jenis-transaksi/tambah-simpanan') }}">
            @csrf
            <div class="form-group">
                <label for="jenis_transaksi">Jenis Transaksi</label>
                <select name="jenis_transaksi" id="myselect" class="form-control">
                    <option value="">-- Pilih Jenis Transaksi --</option>
                    @if($simpanan_anggota == null)
                    <option value="Kredit"{{ old('jenis_transaksi') == 'Kredit' ? "selected" : "" }}>Kredit (+) </option>
                    @else
                    <option value="Debit"{{ old('jenis_transaksi') == 'Debit' ? "selected" : "" }}>Debit (-)</option>
                    <option value="Kredit"{{ old('jenis_transaksi') == 'Kredit' ? "selected" : "" }}>Kredit (+)</option>
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary float-right">Berikutnya</button>
        </form>
      
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <script>
  </script>
  @endsection
