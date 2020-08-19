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
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
        <!-- /.sidebar -->
  </aside>

<div class="content-wrapper" style="min-height: 1196.05px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @role('benharian')
              <li class="breadcrumb-item active">Selamat Datang, Bendahara Harian!</li>
              @endrole
              @role('Manajer')
              <li class="breadcrumb-item active">Selamat Datang, Pak Manajer!</li>
              @endrole
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-arrow-circle-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pemasukan</span>
                <span class="info-box-number">Rp <strong>{{number_format($pemasukan,0,'.','.')}}</strong></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-arrow-circle-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pengeluaran</span>
                <span class="info-box-number">Rp <strong>{{number_format($pengeluaran,0,'.','.')}}</strong></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">Rp <strong>{{number_format($saldo,0,'.','.')}}</strong></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <br>

          <div class="card">
            <div class="card-header">
              <div class="form-group col-md-3">
                <h5 class="card-title"><b>Laporan Grafik Divisi Wisata Harian</b></h5>
               </div>
           </div>
            <div class="card-header">
              <div class="form-group col-md-3">
                    <label for="name">Tahun :  {{$tahun_pilihan}}</label>
                      <form method="post" action="{{route('pilih-tahun')}}">
                        @csrf
                    {!! Form::selectRange('tahun', 2018, 2050, $tahun_pilihan, ['class' => 'form-control','id' => 'pilihTahun', 'placeholder' => '-- Tahun --']) !!}
                    <div class="form-group">
                        <button type="submit" id="cariTahun" class="btn btn-default btn-md">Cari</button>
                    </div>
                    </form>
                  </div>
          </div>
          <div class="row">
            <div class="col-md-6">
            <div class="card card-grafik">
              <div class="card-header pt-4">
                <h5 class="card-title">Grafik Keuangan <b>Per Bulan</b> Di Tahun {{$tahun_pilihan}}</h5>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="myChart" height="500" style="display: block; height: 200px; width: 872px;" width="1308" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
          </div>

            <div class="col-md-6">
              <div class="card card-grafik">
                <div class="card-header pt-4">
                  <h5 class="card-title">Grafik Jumlah Pengunjung <b>Per Bulan</b> Di Tahun {{$tahun_pilihan}}</h5>
                </div>
                <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="grafikpengunjung" height="500" style="display: block; height: 200px; width: 872px;" width="1308" class="chartjs-render-monitor"></canvas>
                </div>

                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script>

var ctx = document.getElementById('myChart');
var ctx = document.getElementById('myChart').getContext('2d');
var ctx = $('#myChart');
var ctx = 'myChart';

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
        datasets: [
          {
              label: 'Pemasukan',
              backgroundColor: '#007bff',
              borderColor    : '#007bff',
              data           : [
                        <?php
                          foreach ($pemasukan_perbulan as $key => $value) {
                              if($value->total == ""){
                                  echo "0,";
                                }else{
                                  echo $value->total.",";
                                }
                          }
                          ?>
              ]
            },
            {
              label: 'Pengeluaran',
              backgroundColor: '#ced4da',
              borderColor    : '#ced4da',
              data           : [
                        <?php
                          foreach ($pengeluaran_perbulan as $key => $value) {
                              if($value->total == ""){
                                  echo "0,";
                                }else{
                                  echo $value->total.",";
                                }
                          }
                          ?>
              ]
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
})

var ctx = document.getElementById('grafikpengunjung');
var ctx = document.getElementById('grafikpengunjung').getContext('2d');
var ctx = $('#grafikpengunjung');
var ctx = 'grafikpengunjung';
var grafikpengunjung = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
        datasets: [
          {
              label: 'Jumlah Pengunjung',
              backgroundColor: '#007012',
              borderColor    : '#007012',
              data           : [
                        <?php
                          foreach ($jml_pengunjung_perbulan as $key => $value) {
                              if($value->total == ""){
                                  echo "0,";
                                }else{
                                  echo $value->total.",";
                                }
                          }
                          ?>
              ]
            },
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});






</script>
    
      <!-- jQuery -->
   <!-- <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>-->
    <!-- OPTIONAL SCRIPTS -->
    <!--<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    <script src="{{asset('assets/dist/js/pages/dashboard3.js')}}"></script>-->

@endsection
