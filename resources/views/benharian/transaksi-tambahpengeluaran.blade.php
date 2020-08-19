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
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
        </div>
          <!-- /.sidebar -->
  </aside>
</section>

<div class="content-wrapper" style="min-height: 1196.05px;">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->
    <div class="col-md-12">
        <div class="card card-default">
           <div class="card-header" align=center><strong>TAMBAH PENGELUARAN HARIAN</strong>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form action="{{ route('tambahPengeluaran') }}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-prepend">
                           <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                           </span>
                          </div>
                          <input type="text" class="datepicker-here form-control" name="tanggal" data-language='en' data-multiple-dates="3" data-multiple-dates-seperator=", " data-position='bottom left' placeholder="Masukan Tanggal Pemasukan">
                        </div>
                    </div>
                  </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama Pengeluaran</label>
                      <div class="col-sm-10">
                      <input name="nama_pengeluaran" type="text" class="form-control" id="nama_pengeluaran" aria-describedby="textHelp" placeholder="Masukan Nama Pengeluaran">
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nominal</label>
                      <div class="col-sm-10">
                      <input name="nominal" type="number" class="form-control" id="nominal" aria-describedby="textHelp" id="nominal" placeholder="Masukan Nominal Pengeluaran">
                    </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Keterangan</label>
                      <div class="col-sm-10">
                      <input name="keterangan" type="text" class="form-control" id="keterangan" aria-describedby="textHelp" id="keterangan" placeholder="Masukan Keterangan">
                    </div>
                    </div>
                <!--    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Bukti Transaksi</label>
                      <div class="col-sm-10">
                      <input name="bukti_pembayaran" type="file" class="form-control" id="bukti_pembayaran" aria-describedby="textHelp" placeholder="Upload Bukti Pembayaran">
                    </div>
                    </div>-->

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Bukti Transaksi</label>
                      <div class="col-sm-10">
                      <div class="preview-zone hidden">
                        <div class="box box-solid">
                          <div class="box-header with-border">
                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-danger btn-xs remove-preview"><i class="fa fa-times"></i> Reset</button>
                            </div>
                          </div>
                          <div class="box-body"></div>
                        </div>
                      </div>
                      <div class="dropzone-wrapper">
                        <div class="dropzone-desc">
                          <i class="glyphicon glyphicon-download-alt"></i>
                          <div>Pilih Gambar atau Taruh Gambar Di sini</div>
                        </div>
                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="dropzone" />
                      </div>
                    </div>
                    </div>

                  </div>
                    <div class="card-footer">
                      <a class="btn btn-default" href="/transaksi"><i class="fas fa-arrow-circle-left"></i></a>
                  <button type="submit" value="upload" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

@endsection
