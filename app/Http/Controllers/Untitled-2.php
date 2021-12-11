<div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Riwayat Pembayaran Pinjaman</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @if($peminjaman->status == 'Belum Lunas')
                    <a href="{{url('/peminjaman/bayar/'.$peminjaman->id_peminjaman)}}" class="btn btn-primary float-right"><i class="fa fa-money-bill-wave"></i> Bayar</a>
                    @endif
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Total Bayar</th>
                            <th>Terlambat</th>
                            <th>Denda</th>
                        </tr>
                        @forelse($pembayaran as $p)
                        <tr>
                            <td>{{$p->tanggal_pembayaran}}</td>
                            <td>Rp. {{number_format($p->total_pembayaran,0,'.','.')}}</td>
                            @if($p->terlambat > 0 )
                            <td>{{$p->terlambat}} Hari</td>
                            @else
                            <td>-</td>
                            @endif
                            @if($p->denda > 0)
                            <td><span class="right badge badge-danger">+ Rp. {{number_format($p->denda_pembayaran,0,'.','.')}}</span></td>
                            @else
                            <td>-</td>
                            @endif
                        </tr>
                    
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Anggota Ini Belum Melakukan Pembayaran Pada Pinjaman Ini
                            </td>
                        </tr>
                        @endforelse
                        <tr>
                            <th>Sisa Bayaran </th>
                            @if($peminjaman->status == 'lunas')
                            <td>Lunas</td>
                            @else
                            <td>Rp. {{number_format($peminjaman->jumlah_pinjaman - $pembayaran->sum('total_pembayaran'),0,'.','.')}}</td>
                            @endif
                            <th>Total Denda</th>
                            <td>Rp. {{number_format($pembayaran->sum('denda_pembayaran'),0,'.','.')}}</td>
                        </tr>
                    </table>
                  </div>
                  </div>