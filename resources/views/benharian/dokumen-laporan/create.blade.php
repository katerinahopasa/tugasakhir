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
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
        <!-- /.sidebar -->
  </aside>

<div class="content-wrapper" style="min-height: 1196.05px;">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->
    <div class="col-md-12">
        <div class="card card-default">
           <div class="card-header" align=center><strong>UPLOAD DOKUMEN LAPORAN TRANSAKSI</strong>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form action="/dokumen-laporan" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="card-body">

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Judul Dokumen Laporan</label>
                  <div class="col-sm-10">
                    <input name="judul_dokumen" type="type" class="form-control" id="judul_dokumen" aria-describedby="textHelp" placeholder="Masukan Judul Dokumen">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                   <input name="deskripsi" type="text" class="form-control" id="deskripsi" aria-describedby="textHelp" placeholder="Masukan Deskripsi (Opsional)">
                  </div>
                </div>

                <div class="form-group row">
                   <label for="Upload File" class="col-sm-2 col-form-label">Upload File</label>
                   <div class="col-sm-10">
                       <input type="file" name="file">
                   </div>
                </div>
                      <div id="app">
                          @yield('content')
                      </div>
                  </div><!-- /.card-body -->
                <div class="card-footer">
                  <a class="btn btn-default" href="/dokumen-laporan"><i class="fas fa-arrow-circle-left"></i></a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>

@endsection