@extends('layouts.temp')

@section('title', 'Rincian Peminjaman')

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
              <li class="breadcrumb-item">Rincian Simpanan</li>
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
        @foreach(['success','danger','primary'] as $msg)
        @if ($message = Session::has($msg))
  <div class="alert alert-{{$msg}} alert-dismissible">
          <ul>
          {{ Session::get($msg) }}
</ul>
        </div>
  @endif
  @endforeach
  
                <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Simpananku</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                           <td colspan="5">
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
