@extends('layouts.app')

@section('content') 

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
            @role('benharian')
            <li class="nav-header">TRANSAKSI WISATA HARIAN</li>
             <li class="nav-item">
              <a href="{{ url('/transaksi') }}" class="nav-link">
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
                <a href="{{ url('/dokumen-laporan') }}" class="nav-link active">
                  <i class="fas fa-file-download nav-icon"></i>
                  <p>Dokumen Lap. Keuangan</p>
                </a>
              </li>
              @endrole
              @role('Manajer')
              <li class="nav-header">DIVISI WISATA HARIAN</li>
             <li class="nav-item">
              <a href="{{ url('/transaksi') }}" class="nav-link">
                <i class="fas fa-chart-line nav-icon"></i>
                 <p>Data Transaksi Harian</p>
                </a>
             </li>
              <li class="nav-item">
                <a href="{{ url('/dokumen-laporan') }}" class="nav-link active">
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
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
        <!-- /.sidebar -->
  </aside>

<div class="content-wrapper" style="min-height: 1196.05px;">
 <section class="content">
    <div class="card">
            <div class="row">
                @if (session('sukses'))
                <div
                    class="alert alert-success alert-dismissable custom-success-box"
                    role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ session('sukses') }}
                </div>
                @endif
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h6><a class="btn btn-default" href="/dokumen-laporan"><i class="fas fa-arrow-circle-left"></i></a> Detail File Laporan Keuangan Divisi Wisata Harian</h6>
                        </div>
                        <div class="card-body">
                                <table class="table align-items-center table-flush">
                                    <tbody>
                                        <tr>
                                            <td><b>Judul Dokumen</b></td>
                                            <td>:</td>
                                            <td>{{$data->judul_dokumen}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Deskripsi</b></td>
                                            <td>:</td>
                                            <td>{{$data->deskripsi}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Preview Dokumen</b></td>
                                            <td>:</td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <tbody>
                                        <tr>
                                            <td>
                                              <p>
                                                <iframe src="{{url('storage/'.$data->file)}}" style="width: 1100px; height: 1000px;"></iframe>
                                              </p>
                                            </td>
                                        </tr>
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>


@endsection