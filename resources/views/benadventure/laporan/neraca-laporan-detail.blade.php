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
            @role('benadventure')
            <li class="nav-header">LAPORAN KEGIATAN</li>
             <li class="nav-item">
              <a href="{{ url('/kelola-jenistransaksi') }}" class="nav-link">
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
               <a href="{{ url('neraca-laporan') }}" class="nav-link active">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Neraca Laporan</p>
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
               <a href="{{ url('neraca-laporan') }}" class="nav-link active">
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
   <div class="row">
     <div class="col-md-8">
       <div class="card">
        <div class="panel panel-default">
          <div class="card-header">
            Aktiva 
            </div>
             <div class="card-body">
                 <div class="panel-body">
                    <div class="col-md-12">
                      <h6 class="text-center">NERACA LAPORAN</h6>
                        <h6 class="text-center">Periode : <strong>{{$periode}}</strong> </h6>
                        <h6><strong>Aktiva Lancar</strong></h6>
                        <table class="table table-hover table-bordered table-striped">
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Akun</th>
                            <th class="text-center">Nominal</th>
                          </tr>
                        <?php $i = 1 ?>
                        <?php $jumlah_aktiva_lancar = 0 ?>
                        @foreach($aktiva_lancar as $data)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{$data['nama']}}</td>
                            <td>Rp. {{ number_format($data['value'], 0, ',', '.') }},-</td>
                          </tr>
                          <?php $jumlah_aktiva_lancar += $data['value'] ?>
                        @endforeach

                        <tr>
                          <th colspan="2" class="text-center">Jumlah Aktiva Lancar</th>
                          <th>Rp. {{ number_format($jumlah_aktiva_lancar, 0, ',', '.') }},-</th>
                        </tr>
                      </table>
                      <h6><strong>Aktiva Tetap</strong></h6>
                        <table class="table table-hover table-bordered table-striped">
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Akun</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center">Kredit</th>
                          </tr>
                        <?php $i = 1 ?>
                        @foreach($aktiva_tetap as $data)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{$data->nama_akun}}</td>
                            <td>@if($data->tipe == 'd')
                                Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
                                @else
                                -
                                @endif

                            </td>
                            <td>@if($data->tipe == 'k')
                                Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
                                @else
                                -
                                @endif</td>
                          </tr>
                        @endforeach

                        <?php $jumlah_aktivatetap = 0 ?>
                        @foreach($jumlah_aktiva_tetap as $data)
                            <?php $jumlah_aktivatetap += $data['value'] ?>
                        @endforeach

                        <tr>
                          <th colspan="2" class="text-center">Jumlah Aktiva Tetap</th>
                          <th colspan="2" class="text-center">Rp. {{ number_format($jumlah_aktivatetap, 0, ',', '.') }},-</th>
                        </tr>
                        <tr>
                          <th colspan="2" class="text-center">JUMLAH SELURUH AKTIVA</th>
                          <?php $jumlah_seluruh_aktiva = $jumlah_aktiva_lancar + $jumlah_aktivatetap?>
                          <th colspan="2" class="text-center"><i>Rp. {{ number_format($jumlah_seluruh_aktiva, 0, ',', '.') }},-</i></th>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
           </div>
         </div>
      <div class="col-md-8">
       <div class="card">
        <div class="panel panel-default">
          <div class="card-header">
            Pasiva 
            </div>
             <div class="card-body">
                 <div class="panel-body">
                    <div class="col-md-12">
                      <h6><strong>Pasiva</strong></h6>
                        <table class="table table-hover table-bordered table-striped">
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Akun</th>
                            <th class="text-center">Nominal</th>
                          </tr>
                        <?php $i = 1 ?>
                        <?php $jumlah_pasiva = 0 ?>
                        @foreach($pasiva as $data)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{$data['nama']}}</td>
                            <td>Rp. {{ number_format($data['value'], 0, ',', '.') }},-</td>
                          </tr>
                          <?php $jumlah_pasiva += $data['value'] ?>
                        @endforeach

                        <tr>
                          <th colspan="2" class="text-center">Jumlah Pasiva</th>
                          <th>Rp. {{ number_format($jumlah_pasiva, 0, ',', '.') }},-</th>
                        </tr>
                      </table>
                      <h6><strong>Ekuitas</strong></h6>
                        <table class="table table-hover table-bordered table-striped">
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Akun</th>
                            <th class="text-center">Nominal</th>
                          </tr>
                        <?php $i = 1 ?>
                        <?php $jumlah_ekuitas = 0 ?>
                        @foreach($ekuitas as $data)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{$data['nama']}}</td>
                            <td>Rp. {{ number_format($data['value'], 0, ',', '.') }},-</td>
                          </tr>
                          <?php $jumlah_ekuitas += $data['value'] ?>
                        @endforeach

                        <tr>
                          <th colspan="2" class="text-center">Jumlah Ekuitas</th>
                          <th>Rp. {{ number_format($jumlah_ekuitas, 0, ',', '.') }},-</th>
                        </tr>
                        <tr>
                          <th colspan="2" class="text-center">JUMLAH PASIVA DAN EKUITAS</th>
                          <?php $jumlah_pasiva_ekuitas = $jumlah_pasiva + $jumlah_ekuitas ?>
                          <th colspan="2"><i>Rp. {{ number_format($jumlah_pasiva_ekuitas, 0, ',', '.') }},-</i></th>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
           </div>
         </div>
         <div class="col-md-8">
       <div class="card">
        <div class="panel panel-default">
          <div class="card-header">
            Laba Bersih 
            </div>
             <div class="card-body">
                 <div class="panel-body">
                    <div class="col-md-12">
                      <h6><strong>Laba Bersih</strong></h6>
                        <table class="table table-hover table-bordered table-striped">
                        <tr>
                          <th colspan="2" class="text-center">Total Laba Bersih</th>
                          <th class="text-center"><i>Rp. {{ number_format($laba_bersih, 0, ',', '.') }},-</i></th>
                        </tr>
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
