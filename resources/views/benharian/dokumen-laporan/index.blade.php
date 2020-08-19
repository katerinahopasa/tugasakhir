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
      <div class="col-md-12">
        @if (session('sukses'))
                <div
                    class="alert alert-success alert-dismissable custom-success-box"
                    role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ session('sukses') }}
                </div>
                @endif
                <div class="col-md-12 col-xl-12 col-sm-12">
                        <div class="card-header">
                            <h6 class="text-center"><b>DAFTAR FILE LAPORAN KEUANGAN DIVISI WISATA HARIAN</b></h6>
                        </div>
                        <div class="card-body">
                          @role('benharian')
                          <a href="{{ url('dokumen-laporan/create') }}" class="btn btn btn-primary btn-sm">Tambah Dokumen</a>
                          @endrole
                                <table id="example" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Dokumen</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($file as $key => $data)
                                      <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$data->judul_dokumen}}</td>
                                        <td>{{$data->deskripsi}}</td>
                                        <td>
                                          <!-- <a href="/dokumen-laporan/{{$data->id}}" class="btn btn-outline-secondary"><i class="fas fa-file-alt"></i>&nbsp; LIHAT</a> -->
                                          <a href="/dokumen-laporan/download/{{$data->file}}" class="btn btn-outline-secondary"><i class="fas fa-download"></i>&nbsp; DOWNLOAD</a>
                                          @role('benharian')
                                          <a href="/dokumen-laporan/hapus/{{$data->id}}" class="btn btn-outline-secondary" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i>&nbsp; Hapus</a>
                                          @endrole
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
               </div>
            </section>
         </div>

@endsection

@section('script')
<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    $(function () {
$("#example").DataTable();
});
    </script>

@endsection