@extends('layouts.temp')

@section('title', 'Penilaian')

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
                <li class="breadcrumb-item">{{$karyawan->nik}}</li>
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
            <div class="row">
              <div class="col-lg-6">

              </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sikap</h3>
                    <a href="{{url('penilaian/'.$id.'/tambah-penilaian-sikap')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width : 3%">No</th>
                        <th>Tanggal Penilaian</th>
                        <th style="width : 15%">Sikap</th>
                    </tr>
                    @forelse($penilaian_sikap as $ps)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$ps->tanggal_penilaian}}</td>
                        <td>
                          @if($ps->nilai == "A")
                            {{$ps->nilai}} - Sangat Baik
                            @elseif($ps->nilai == "B")
                            {{$ps->nilai}} - Baik
                            @elseif($ps->nilai == "C")
                            {{$ps->nilai}} - Cukup Baik
                            @elseif($ps->nilai == "D")
                            {{$ps->nilai}} - Kurang
                            @elseif($ps->nilai == "E")
                            {{$ps->nilai}} - Buruk
                            @elseif($ps->nilai == "F")
                            {{$ps->nilai}} - Sangat Buruk
                            @else
                          @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="3" class="text-center">Tidak Ada Data Didalam Tabel</td>
                    </tr>
                    @endforelse
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sholat</h3>
                  <a href="{{url('penilaian/'.$id.'/tambah-penilaian-sholat')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                      <th style="width : 3%">No</th>
                        <th>Tanggal Penilaian</th>
                        <th>Subuh</th>
                        <th>Dzuhur</th>
                        <th>Ashar</th>
                        <th>Maghrib</th>
                        <th>Isya</th>
                        <th>Sunnah</th>
                        <th>Nilai</th>
                      </tr>
                    @forelse($penilaian_sholat as $value)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$value->created_at}}</td>
                      <td>
                        <center>
                          @if($value->subuh == "1")
                        <i class="fa fa-check" style="color: green; font-size: 23px;"></i> @endif
                      </center>
                      </td>
                      <td>
                        <center>
                          @if($value->dzuhur == "1")
                          <i class="fa fa-check" style="color: green; font-size: 23px;"></i> @endif
                        </center>
                      </td>
                      <td>
                        <center>
                        @if($value->ashar == "1")
                        <i class="fa fa-check" style="color: green; font-size: 23px;"></i> @endif
                        </center>
                      </td>
                      <td>
                        <center>
                          @if($value->maghrib == "1")
                        <i class="fa fa-check" style="color: green; font-size: 23px;"></i> @endif
                        </center>
                      </td>
                      <td>
                        <center>
                          @if($value->isya == "1")
                          <i class="fa fa-check" style="color: green; font-size: 23px;"></i> @endif
                        </center>
                      </td>
                      <td>
                        <center>
                          @if($value->sunnah == "1")
                          <i class="fa fa-check" style="color: green; font-size: 23px;"></i> @endif
                        </center>
                      </td>
                      <td>{{($value->subuh + $value->dzuhur + $value->ashar + $value->maghrib + $value->isya + $value->sunnah)*20}} / {{6*20}}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center">Tidak Ada Data Didalam Tabel</td>
                    </tr>
                    @endforelse
                  </table>
                </div>
              </div>
                <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Kolektif</h3> </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <th style="width : 3%">No</th>
                    <th>Peminjam</th>
                    <th>Tanggal Bayar</th>
                    <th>Terlambat</th>
                    <th style="width : 20%">Nominal Pembayaran</th>
                  </tr>
                  @forelse($penilaian_kolektif as $pk)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pk->nik}} - {{$pk->nama}}</td>
                    <td>{{ date('d-m-Y', strtotime($pk->tanggal_pembayaran)); }}</td>
                    <td>{{$pk->terlambat}} Hari</td>
                    <td>Rp. {{ number_format($pk->total_pembayaran,0,'.','.') }}</td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="5" class="text-center">Tidak Ada Data Didalam Tabel</td>
                    </tr>
                  @endforelse
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
