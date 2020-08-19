@extends('layouts.app')

@section('content')
<!-- Main Sidebar Container -->
  <section class="content">
      <aside class="main-sidebar sidebar-dark-primary ">
        <!-- Brand Logo -->
        <a href="/benharian" class="brand-link">
          <img src="{{asset('assets/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

    <div class="container-fluid main">
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
               @role('benharian')
                <li class="nav-header">TRANSAKSI WISATA HARIAN</li>
                 <li class="nav-item">
                  <a href="{{ url('/transaksi') }}" class="nav-link active">
                    <i class="fas fa-chart-line nav-icon"></i>
                     <p>Kelola Transaksi</p>
                    </a>
                 </li>
                  <li class="nav-item">
                    <a href="{{ url('/benharian/laporan') }}" class="nav-link">
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
                  @endrole
                  @role('Manajer')
                  <li class="nav-header">DIVISI WISATA HARIAN</li>
                 <li class="nav-item">
                  <a href="{{ url('/transaksi') }}" class="nav-link active">
                    <i class="fas fa-chart-line nav-icon"></i>
                     <p>Data Transaksi Harian</p>
                    </a>
                 </li>
                  <li class="nav-item">
                    <a href="{{ url('/dokumen-laporan') }}" class="nav-link">
                     <i class="fas fa-file-invoice nav-icon"></i>
                    <p>Dokumen Lap.Keuangan</p>
                   </a>
                  </li>
                  <li class="nav-header">DIVISI ADVENTURE</li>
                 <li class="nav-item">
                  <a href="{{ url('/laporan-kegiatan') }}" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Data Laporan Kegiatan</p>
                  </a>
                </li>
                  <li class="nav-item">
                   <a href="{{ url('labarugi') }}" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Laporan Laba Rugi</p>
                   </a>
                  </li>
                  <li class="nav-item">
                   <a href="{{ url('neraca-laporan') }}" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Neraca Laporan</p>
                   </a>
                  </li>
                  @endrole
                </ul>
                </li>
               </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
          </div>
        </div>
      </div>
    <!-- /.sidebar -->
  </aside>
</section>
      
<div class="content-wrapper" style="min-height: 1196.05px;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="panel panel-default">
             <div class="col-lg-12 margin-tb">
              <div class="pull-right">
                 <a class="btn btn-default" href="/transaksi"><i class="fas fa-arrow-circle-left"></i></a>
              </div>
             </div>
             <br>
              <div class="col-md-12">
               <div class="card">
                 <div class="card-header">
                   <h6><b>Detail Data Transaksi Pengeluaran</b></h6>
                    </div>
                        <!-- /.card-header -->
                      <div class="card-body p-0">
                        <table class="table align-items-center table-flush">
                           <tbody>
                            <tr>
                              <td>Tanggal</td>
                              <td>:</td>
                              <td>{{ date('d M Y',strtotime($pengeluaran->tanggal)) }}</td>
                            </tr>
                            <tr>
                              <td>Nama Pengeluaran</td>
                              <td>:</td>
                              <td>{{ $pengeluaran->nama_pengeluaran }}</td>
                            </tr>
                            <tr>
                              <td>Nominal Pengeluaran</td>
                              <td>:</td>
                              <td>{{ $pengeluaran->nominal }}</td>
                            </tr>
                            <tr>
                              <td>Keterangan</td>
                              <td>:</td>
                              <td>{{ $pengeluaran->keterangan }}</td>
                            </tr>
                            <tr>
                              <td>Bukti Transaksi</td>
                              <td>:</td>
                              <td>
                                @if($pengeluaran->bukti_pembayaran === "")
                                <h6><i>Tidak ada bukti transaksi</i></h6>
                                @endif
                                <img src="{{ asset('upload/pengeluaranharian/'.$pengeluaran->bukti_pembayaran) }}" style="width: 600px" class="mr-2"></td>
                            </tr>
                          </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection