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
                <li class="breadcrumb-item"><a href="{{url('/simpanan')}}">Simpanan</a></li>
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
  <div class="row">
<div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Anggota</h3>
                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-header"> 
                  <dl id="content">
                      <dt>NIK</dt>
                      <dd>{{$anggota->nik}}</dd>
                      <dt>Nama</dt>
                      <dd>{{$anggota->nama}}</dd>
                      <dt>Tempat Tanggal Lahir</dt>
                      <dd>{{$anggota->tempat_lahir}}, {{ date('d F Y', strtotime($anggota->tanggal_lahir)); }}</dd>
                      <div id="show">
                      <dt>Jenis Kelamin</dt>
                      @if($anggota->jenis_kelamin == 'P')
                      <dd>Pria</dd>
                      @elseif($anggota->jenis_kelamin == 'W')
                      <dd>Wanita</dd>
                      @endif
                      <dt>Alamat Lengkap</dt>
                      <dd>{{$anggota->alamat}}, RT.0{{$anggota->rt}}/RW.0{{$anggota->rw}}, {{$anggota->kelurahan_desa}}, Kec. {{$anggota->kecamatan}}, {{$anggota->kabupaten_kota}}, {{$anggota->provinsi}}</dd>
                      <dt>Agama</dt>
                      <dd>{{$anggota->agama}}</dd>
                      <dt>Pekerjaan</dt>
                      <dd>{{$anggota->pekerjaan}}</dd>
                      <dt>Status Perkawinan</dt>
                      <dd>{{$anggota->status_perkawinan}}</dd>
                      <dt>Kewarganegaraan</dt>
                      <dd>{{$anggota->kewarganegaraan}}</dd>
                      </div>
                  </dl>
                  <a href="#" class="float-right" id="more" onclick="myFunction()">Selengkapnya...</a>         
                
                </div>
              </div>
            </div>
                <div class="col-lg-8">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Simpanan</h3>
                    @if($simpanan_anggota == null)
                      <form action="{{ url('simpanan/'.$anggota->id_anggota.'/pilih-jenis-transaksi/tambah-simpanan') }}" method="post">
                      @csrf
                        <button class="btn btn-primary btn-sm" name="jenis_transaksi" value="Kredit" type="submit"><i class="fa fa-plus"></i></button>
                      </form>
                      @else
                      <a href="{{url('simpanan/'.$anggota->id_anggota.'/pilih-jenis-transaksi')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                    @endif
                </div>
              </div>
              <!-- /.card-header -->
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
                           <td>{{ date('d-m-Y', strtotime($s->tanggal_transaksi)); }}</td>
                           @if($s->jenis_transaksi == 'Debit')
                           <td> - Rp. {{ number_format($s->debit,0,'.','.') }}</td>
                           <td></td>
                           @endif
                           @if($s->jenis_transaksi == 'Kredit')
                           <td></td>
                           <td> + Rp. {{ number_format($s->kredit,0,'.','.') }}</td>
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
  <script>
        show.style.display = 'none';
    function myFunction() {
      var more = document.getElementById("more");
      var show = document.getElementById("show");
      if(more.innerHTML === "Selengkapnya..."){
        more.innerHTML = "Lebih Sedikit";
        show.style.display = 'block';
      }
      else if(more.innerHTML === "Lebih Sedikit"){
        more.innerHTML = "Selengkapnya...";
        show.style.display = 'none';
        
      }
}


  </script>
  @endsection
