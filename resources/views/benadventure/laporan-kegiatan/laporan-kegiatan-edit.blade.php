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
              <a href="{{ url('/kelola-jenistransaksi') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Kelola Jenis Transaksi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/laporan-kegiatan') }}" class="nav-link active">
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
     <div class="card-header" align=center><strong>DATA LAPORAN KEGIATAN</strong>
     </div>
     <!-- /.card-header -->
     <!-- form start -->
      <form action="/laporan-kegiatan/{{$laporan_kegiatan->id}}" method="POST">
       {{csrf_field()}}
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Waktu Kegiatan</label>
              <div class="col-sm-10">
                <div class="input-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                     </span>
                   </div>
                   <input type="text" class="datepicker-here form-control" name="tgl_kegiatan" data-language='en' data-multiple-dates="3" data-multiple-dates-seperator=", " data-position='bottom left' placeholder="Masukan Tanggal Pemasukan" value="{{$laporan_kegiatan->tgl_kegiatan}}">
                </div>
              </div>
            </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
               <div class="col-sm-10">
                 <input name="nama_pelanggan" type="text" class="form-control" id="nama_pelanggan" aria-describedby="textHelp" placeholder="Masukan Harga Tiket" value="{{$laporan_kegiatan->nama_pelanggan}}">
               </div>
             </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kegiatan</label>
              <div class="col-sm-10">
                <input name="nama_kegiatan" type="text" class="form-control" id="nama_kegiatan" aria-describedby="textHelp" placeholder="Masukan Harga Tiket" value="{{$laporan_kegiatan->nama_kegiatan}}">
              </div>
            </div>

          <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Status</label>
                      <div class="col-md-9">
                        {!! Form::select('status', ['m' => 'Menunggu', 's' => 'Sudah Dilaksanakan', 'b' => 'Dibatalkan'], $laporan_kegiatan->status, ['class' => 'form-control', 'placeholder' => '-- Status Kegiatan --']) !!}
                       </div>
                   </div>
          <div id="app">
           @yield('content')
          </div>
         </div><!-- /.card-body -->    
         <div class="card-footer">
           <a class="btn btn-default" href="/laporan-kegiatan"><i class="fas fa-arrow-circle-left"></i></a>
           <button type="submit" class="btn btn-primary">Simpan</button>
        </div>          
       </div>
     </form>
    </div>
   </div>
  </div>

@endsection