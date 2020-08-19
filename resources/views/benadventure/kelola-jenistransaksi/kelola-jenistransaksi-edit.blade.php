@extends('layouts.app')

@section('content')

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
 <!-- Brand Logo -->
  <a href="/benadventure" class="brand-link">
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
            <li class="nav-header">LAPORAN KEGIATAN</li>
             <li class="nav-item">
              <a href="{{ url('/kelola-jenistransaksi') }}" class="nav-link active">
               <i class="far fa-circle nav-icon"></i>
               <p>Kelola Jenis Transaksi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/laporan-kegiatan') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Kelola Laporan Kegiatan</p>
              </a>
            </li>
            <li class="nav-header">LAPORAN TATA BUKU</li>
             <li class="nav-item">
              <a href="{{ url('akun') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Chart of Account</p>
              </a>
             </li>
             <li class="nav-item">
               <a href="{{ url('jurnal') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Jurnal</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('buku-besar') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Buku Besar</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('neraca') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Neraca Saldo</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('nssd') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>NSSD</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('labarugi') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Laba Rugi</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('neraca-laporan') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Neraca Laporan</p>
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
         <div class="card-header" align=center><strong>EDIT DATA JENIS TRANSAKSI</strong>
         </div>
       <!-- /.card-header -->
       <!-- form start -->
      <form action="/kelola-jenistransaksi/update/{{$jenis_transaksikegiatan->id}}" method="POST">
       {{csrf_field()}}
       {{ method_field('put') }}
        <div class="card-body">
          <div class="form-group row">
             <label class="col-sm-3 col-form-label">Nama Jenis Transaksi</label>
               <div class="col-sm-9">
                  <input name="nama_jenis" type="text" class="form-control" id="nama_jenis" aria-describedby="textHelp" placeholder="Masukan Nama Jenis Transaksi" value="{{$jenis_transaksikegiatan->nama_jenis}}">
               </div>
             </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                  <input name="deskripsi" type="text" class="form-control" id="deskripsi" aria-describedby="textHelp" placeholder="Masukan Deskripsi Jenis Transaksi" value="{{$jenis_transaksikegiatan->deskripsi}}">
                </div>
             </div>
            <div id="app">
               @yield('content')
            </div>
           </div><!-- /.card-body -->
           <div class="card-footer">
              <a class="btn btn-default" href="/kelola-jenistransaksi"><i class="fas fa-arrow-circle-left"></i></a>
              <button type="submit" class="btn btn-primary">Update</button>            
           </div>
        </form>
      </div>
    </div>
</div>         

@endsection