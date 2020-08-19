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
           <div class="card-header" align=center><strong>EDIT PEMASUKAN HARIAN</strong>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form action="/transaksi/updatePemasukan/{{$pemasukan->id}}" method="POST">
              {{csrf_field()}}
              {{ method_field('put') }}
              <div class="perhitungan">
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
                          <input type="text" class="datepicker-here form-control" name="tanggal" data-language='en' data-multiple-dates="3" data-multiple-dates-seperator=", " data-position='bottom left' placeholder="Masukan Tanggal Pemasukan" value="{{$pemasukan->tanggal}}">
                        </div>
                    </div>
                  </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jumlah Pengunjung</label>
                  <div class="col-sm-10">
                    <input name="jml_pengunjung" type="number" class="form-control" id="jml_pengunjung" aria-describedby="textHelp" placeholder="Masukan Jumlah Pengunjung" value="{{$pemasukan->jml_pengunjung}}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Harga Tiket</label>
                  <div class="col-sm-10">
                   <input name="harga_tiket" type="number" class="form-control" id="harga_tiket" aria-describedby="textHelp" placeholder="Masukan Harga Tiket" value="{{$pemasukan->harga_tiket}}">
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Pemasukan</label>
                    <div class="col-sm-10">
                      <input name="total_pemasukan" type="text" class="form-control" id="total" aria-describedby="textHelp" placeholder="Total" value="{{$pemasukan->total_pemasukan}}" readonly="readonly">
                    </div>
                </div>
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                         <script type ="text/javascript">
                            $(".perhitungan").keyup(function(){
                              var harga_tiket = parseInt($("#harga_tiket").val())
                              var jml_pengunjung = parseInt($("#jml_pengunjung").val())
                              var total = harga_tiket*jml_pengunjung;
                              $("#total").attr("value",total)
                             });
                         </script>

                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Keterangan</label>
                   <div class="col-sm-10">
                     <input name="keterangan" type="text" class="form-control" id="keterangan" aria-describedby="textHelp" placeholder="" value="{{$pemasukan->keterangan}}">
                   </div>
                </div>
                      <div id="app">
                          @yield('content')
                      </div>
                  </div><!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>

@endsection