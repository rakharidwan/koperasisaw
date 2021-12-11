@extends('layouts.temp')

@section('title', 'Pencapaian')

@section('content')
<style type="text/css">
.tr-color1{
  background-color:#f7ec92;
}

.tr-color2{
  background-color:#f2f2f2;
}

.tr-color3{
  background-color:#e6d2ae;
}
/* 
tr {
  cursor: pointer;
} */
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pencapaian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/pencapaian')}}">Pencapaian</a></li>
              <li class="breadcrumb-item">{{$m}} - {{$y}}</li>
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
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pencapaian Karyawan</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
              <table class="table table-bordered" id="myTable2">
                <tr>
                    <th>Karyawan</th>
                    <th>Tempat / Tanggal Lahir</th>
                    <th>Nilai Penilaian Sholat</th>
                    <th>Nilai Penilaian Sikap</th>
                    <th>Nilai Kolektif</th>
                    <th onclick="sortTable(1)">Nilai Rata Rata</th>
                  </tr>
                  <?php  
                  Use \Carbon\Carbon;
                    ?>
                  @foreach($penilaian as $p)
                  <?php
                    foreach($penilaian_sholat->where('id_penilaian',$p->id_penilaian) as $ps){
                      $nilai_sholat = $ps->where('id_penilaian',$p->id_penilaian);
                      $nilai_sholat1 = $ps->where('id_penilaian',$p->id_penilaian)->groupBy('id_penilaian');
                    }
                    $jumlah_nilai_sholat = $nilai_sholat->sum('subuh') + $nilai_sholat->sum('dzuhur') + $nilai_sholat->sum('ashar') + $nilai_sholat->sum('maghrib') + $nilai_sholat->sum('isya') + $nilai_sholat->sum('sunnah');
                    $nilai_sholat_terbesar[] = $nilai_sholat1->sum('subuh') + $nilai_sholat1->sum('dzuhur') + $nilai_sholat1->sum('ashar') + $nilai_sholat1->sum('maghrib') + $nilai_sholat1->sum('isya') + $nilai_sholat1->sum('sunnah');
                    foreach($penilaian_sikap->where('id_penilaian',$p->id_penilaian) as $ps1){
                      $nilai = '';
                      if ($ps1->nilai == "A") {
                        $ps1->nilai = "100";
                     }
                     elseif ($ps1->nilai == "B") {
                         $ps1->nilai = "080";
                     }
                     elseif ($ps1->nilai == "C") {
                         $ps1->nilai = "060";
                     }
                     elseif ($ps1->nilai == "D") {
                         $ps1->nilai = "040";
                     }
                     elseif ($ps1->nilai == "E") {
                         $ps1->nilai = "020";
                     }

                      $nilai_sikap_tertinggi[] = $ps1->nilai;
                    }
                    $nilai_kolektif = $kolektif->where('id_penilaian',$p->id_penilaian)->count();
                    $nilai_kolektif_terbesar[] = $kolektif->where('id_penilaian',$p->id_penilaian)->groupBy('id_penilaian')->count();
                    
                    $max_sikap = max($nilai_sikap_tertinggi);
                    $max_sholat = max($nilai_sholat_terbesar);
                    $max_kolektif = max($nilai_kolektif_terbesar);

                    ?>
                 <tr>
                    <td>{{$p->nama}}</td>
                    <td>{{ $p->tempat_lahir }}, {{ Carbon::parse($p->tanggal_lahir)->translatedFormat('d F Y');  }}</td>
                    <td>{{$ps1->nilai / $max_sikap}}</td>
                    <td>{{$jumlah_nilai_sholat / $max_sholat}}</td>
                    <td>{{$nilai_kolektif /  $max_kolektif}}</td>
                    <td>{{round((($ps1->nilai / $max_sikap) + ($jumlah_nilai_sholat / $max_sholat) + $nilai_kolektif /  $max_kolektif) / 3 ,2)}}</td>
                  </tr>
                    @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <script>
    window.onload = sortTable(1);
    function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "desc") {
        dir = "asc";
        switching = true;
      }
    }
  }
}
</script>
@endsection
