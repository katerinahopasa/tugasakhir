@extends('layouts.app')

@section('content')
<h6 class="text-center"><b>LAPORAN TRANSAKSI KEUANGAN WISATA HARIAN</b></h6>
<hr>
@if(session('alert'))
<div class="alert alert-info">
  {{session('alert')}}
</div>
@endif

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
 <!-- Brand Logo -->
  <a href="/benharian" class="brand-link">
    <img src="{{asset('assets/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Ketenger Adventure</span>
  </a>

 <!-- Sidebar -->
  <div class="container-fluid main">
      <div class="sidebar">

          <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
            <li class="nav-header">TRANSAKSI WISATA HARIAN</li>
             <li class="nav-item">
              <a href="{{ url('/transaksi') }}" class="nav-link">
                <i class="fas fa-chart-line nav-icon"></i>
                 <p>Kelola Transaksi</p>
                </a>
             </li>
              <li class="nav-item">
                <a href="{{ url('/benharian/laporan') }}" class="nav-link active">
                 <i class="fas fa-file-invoice nav-icon"></i>
                <p>Laporan Keuangan</p>
               </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/dokumen-laporan') }}" class="nav-link">
                 <i class="fas fa-file-download nav-icon"></i>
                <p>Dokumen Lap. Keuangan</p>
               </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
        <!-- /.sidebar -->
  </aside>

<div class="content-wrapper" style="min-height: 1196.05px;">
 <section class="content">
  <div class="card">
   <div class="container main">
    <div class="row">
      <div class="col-md-9">
        <div class="card-title"><h6><strong>Pilih Waktu Transaksi</strong></h6>
        <form action="{{url('cari-laporan')}}" method="GET" class="form-inline">
          @csrf
          <label class="mr-sm-2"><h6>Mulai :</h6></label>
          <input type="date" name="mulai" required="" class="form-control mr-sm-2 mb-2">
          <label class="mr-sm-2"><h6>Selesai :</h6></label>
          <input type="date" name="selesai" required="" class="form-control mr-sm-2 mb-2">
          <button type="submit" class="btn btn-sm btn-default">Cari</button>
        </form>
      </div>
      </div>
     </div>


     @if(isset($pemasukan))
     <br>
     <table style="width: 50%">
       <tr>
         <th width="25%">DARI TANGGAL</th>
         <th width="5%" class="text-center">:</th>
          <td>{{ date('d-m-Y',strtotime($mulai)) }}</td>
       </tr>
       <tr>
         <th width="25%">SAMPAI TANGGAL</th>
         <th width="5%" class="text-center">:</th>
          <td>{{ date('d-m-Y',strtotime($selesai)) }}</td>
         </tr>
     </table>
     <br>
     <a target="_BLANK" href="{{ route('laporan_excel',['mulai' => $mulai, 'selesai' => $selesai]) }}" class="btn btn-outline-secondary"><i class="fas fa-file-excel"></i> &nbsp; CETAK EXCEL</a>
     <a target="_BLANK" href="{{ url('laporan-cetak/'.$mulai.'/'.$selesai) }}" class="btn btn-outline-secondary"><i class="fa fa-print "></i> &nbsp; CETAK PDF</a>
     <br>
     <br>
     <div class="col-md-12">
      <div class="card">
       <div class="card-header">
         <h3 class="card-title">Data Laporan Pemasukan</h3>
          </div>
              <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table align-items-center table-flush">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah Pengunjung</th>
                    <th>Pemasukan</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($pemasukan as $key => $p)
                  <tr>
                    <td>{{++$key}}</td>
                    <td style="max-width: 115px;word-wrap: break-word;">{{ date('d M Y',strtotime($p->tanggal)) }}</td>
                    <td style="max-width: 115px;word-wrap: break-word;">{{ $p->jml_pengunjung }}</td>
                    <td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($p->total_pemasukan,0,'.','.')}}</td>
                  </tr>
                 @endforeach
                  <tr>
                    <td></td>
                    <td></td>
                    <td><b>Total Pemasukan :</b></td>
                    <td><b><i>Rp {{number_format($total_pemasukan,0,'.','.')}}</i></b></td>
                  </tr>
                </tbody>
                </table>
              </div>
            </div>
          </div>
    @else
     <br>
     <div class="card-footer">
       <h6 align=center><i>Tidak ada data yang dipilih</i></h6>
     </div>

    @endif

    @if(isset($pengeluaran))
    <div class="col-md-12">
      <div class="card">
       <div class="card-header">
         <h3 class="card-title">Data Laporan Pengeluaran</h3>
          </div>
              <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table align-items-center table-flush">
                <thead>
                  <tr> 
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pengeluaran</th>
                    <th>Pengeluaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pengeluaran as $key => $p)
                  <tr>
                    <td>{{++$key}}</td>
                    <td style="max-width: 115px;word-wrap: break-word;">{{ date('d M Y',strtotime($p->tanggal)) }}</td>
                    <td style="max-width: 115px;word-wrap: break-word;">{{ $p->nama_pengeluaran }}</td>
                    <td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($p->nominal,0,'.','.')}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td></td>
                    <td></td>
                    <td><b>Total Pengeluaran :</b></td>
                    <td><b><i>Rp {{number_format($total_pengeluaran,0,'.','.')}}</i></b></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td><b>TOTAL PEMASUKAN BERSIH :</b></td>
                    <td><b><i>Rp {{number_format($total_pemasukan_bersih,0,'.','.')}}</i></b></td>
                  </tr>
                </tbody>
              </table>
          </div>
      </div>
    </div>

    <div class="col-md-6">
     <div class="card">
       <div class="card-header">
         <h6><b>Estimasi Pembagian Presentase</b></h6>
          </div>
              <!-- /.card-header -->
            <div class="card-body p-0">
              <!-- <button id="btn_add" name="btn_add" class="btn btn-default pull-right">Tambah Estimasi</button> -->
              <table class="table align-items-center table-flush">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pembagian</th>
                    <th>Persentase (%)</th>
                    <th>Nominal</th>
                  </tr>
                 </thead>
                 <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Upah Pengelola</td>
                    <td>80%</td>
                    <td><b><i>:  Rp {{number_format(80/100*$total_pemasukan_bersih,0,'.','.')}}</i></b></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>LMDH</td>
                    <td>10%</td>
                    <td><b><i>:  Rp {{number_format(10/100*$total_pemasukan_bersih,0,'.','.')}}</i></b></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Sisa Hasil Usaha (SHU)</td>
                    <td>10%</td>
                    <td><b><i>:  Rp {{number_format(10/100*$total_pemasukan_bersih,0,'.','.')}}</i></b></td>
                  </tr>
                </tbody>
                </table>
              </div>
            </div>
          </div>

    <!--<div class="col-md-6">
     <div class="card">
       <div class="card-header">
         <h6><b>Estimasi Pembagian Presentase</b></h6>
          </div>
            <div class="card-body p-0">
              <button id="btn_add" name="btn_add" class="btn btn-default pull-right">Tambah Estimasi</button>
              <table class="table align-items-center table-flush">
                <thead>
                  <tr>
                    <th>Nama Pembagian</th>
                    <th>Persentase (%)</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody id="estimasiakhirlaporan-list" name="estimasiakhirlaporan-list">
                   @foreach ($estimasiakhirlaporan as $key => $data)
                    <tr id="estimasiakhirlaporan{{$data->id}}">
                     <td>{{$data->nama_pembagian}}</td>
                     <td>{{$data->persentase}}</td>
                     <td>{{$data->nominal}}</td>
                      <td>
                      <button class="btn btn-warning btn-sm btn-detail open_modal" value="{{$data->id}}">Edit</button>
                      <button class="btn btn-danger btn-sm btn-delete delete-estimasiakhirlaporan" value="{{$data->id}}">Delete</button>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                
                <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Estimasi Pembagian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                    <div class="modal-body">
                    <form id="frmEstimasi" name="frmEstimasi" class="form-horizontal" novalidate="">
                      <div class="perhitungan">
                      <h6><b>Total Pemasukan Bersih :<i> Rp. {{ number_format($total_pemasukan_bersih, 0, ',', '.') }},-</i></b></h6>
                      <div class="form-group error">
                           <div class="col-sm-9">
                            <input type="number" class="form-control has-error" id="total_pemasukan_bersih" name="total_pemasukan_bersih" placeholder="Total Pemasukan Bersih" value="{{ $total_pemasukan_bersih}}">
                           </div>
                           </div>
                        <div class="form-group error">
                         <label for="inputName" class="col-sm-6 control-label">Nama Pembagian</label>
                           <div class="col-sm-9">
                            <input type="text" class="form-control has-error" id="nama_pembagian" name="nama_pembagian" placeholder="Nama Estimasi Pembagian" value="">
                           </div>
                           </div>
                         <div class="form-group">
                         <label for="inputDetail" class="col-sm-3 control-label">Persentase</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="persentase" name="persentase" placeholder="Masukan persentase pembagian" value="">
                            </div>
                        </div>
                        <div class="form-group">
                         <label for="inputDetail" class="col-sm-3 control-label">Nominal</label>
                            <div class="col-sm-9">
                              <input name="nominal" type="number" class="form-control" id="nominal" aria-describedby="textHelp" placeholder="Hasil Pembagian" readonly="readonly">
                            </div>
                        </div>
                           <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                             <script type ="text/javascript">
                                $(".perhitungan").keyup(function(){
                                  var persentase = parseInt($("#persentase").val())
                                  var total_pemasukan_bersih = parseInt($("#total_pemasukan_bersih").val())
                                  var nominal = (persentase*1/100)*total_pemasukan_bersih;
                                  $("#nominal").attr("value",nominal)
                                 });
                             </script>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Simpan</button>
                    <input type="hidden" id="estimasiakhirlaporan_id" name="estimasiakhirlaporan_id" value="0">
                    </div>
                </div>
              </div>
          </div>
              </div>
            </div>
          </div>
          <meta name="_token" content="{!! csrf_token() !!}" />
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
          <script src="{{asset('js/ajaxscript.js')}}"></script>-->
    
    @endif
    
  </div>
 </section>
</div>

@endsection