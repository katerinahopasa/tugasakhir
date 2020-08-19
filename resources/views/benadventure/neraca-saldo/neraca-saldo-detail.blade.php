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
               <a href="{{ url('jurnal-umum') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Jurnal Umum</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('jurnal-penyesuaian') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Jurnal Penyesuaian</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('buku-besar') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Buku Besar</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('neraca-saldo') }}" class="nav-link active">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Neraca Saldo</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('neraca-lajur') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Neraca Lajur</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('laporan') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Laporan</p>
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
 <section class="content">
      <div class="row">
       <div class="col-md-12">
        <div class="card">
        				<div class="panel panel-default">
        					<div class="card-header">
                    <a class="btn btn-default" href="{{ url('neraca-saldo/'.$akun->id) }}"><i class="fas fa-arrow-circle-left"></i></a>
                    Neraca Saldo {{ $periode }} 
        				    </div>
                    <div class="card-body">
        					   <div class="panel-body">
                        <table class="table table-hover table-bordered table-striped text-center">
                          <tr>
                            <th class="text-center" >No</th>
                            <th class="text-center" >Akun</th>
                            <th class="text-center" >Debet</th>
                            <th class="text-center" >Kredit</th>
                          </tr>
                          <?php $i = 1 ?>
                          @foreach($data as $item)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $item['nama_akun'] }}</td>
                            <td>
                              Rp. {{ number_format($item['debet'], 0, ',', '.') }},-
                            </td>
                            <td>
                              Rp. {{ number_format($item['kredit'], 0, ',', '.') }},-
                            </td>
                          </tr>
                        @endforeach
                        <tr>
                          <th colspan="2" class="text-center">Total</th>
                          <th class="text-center">Rp. {{ number_format($total_saldo_debet, 0, ',', '.') }},-</th>
                          <th class="text-center">Rp. {{ number_format($total_saldo_kredit, 0, ',', '.') }},-</th>
                        </tr>

                        <tr>
                          <th colspan="2" class="text-center">TERBILANG</th>
                          <th class="text-center"> <em> {{ ucwords(terbilang($total_saldo_debet)) }} Rupiah</em> </th>
                          <th class="text-center"> <em> {{ ucwords(terbilang($total_saldo_kredit)) }} Rupiah</em></th>
                        </tr>

                    </table>
        					</div>
                </div>
        			</div>
            </div>
          </div>
        </div>
       </section>
    </div>

@endsection