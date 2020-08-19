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
               <a href="{{ url('jurnal') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Jurnal</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="{{ url('buku-besar') }}" class="nav-link active">
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
 <section class="content">
   <div class="row">
     <div class="col-md-12">
       <div class="card">
				<div class="panel panel-default">
					<div class="card-header">
            <a class="btn btn-default" href="{{ url('buku-besar/'.$akun->id) }}"><i class="fas fa-arrow-circle-left"></i></a>
            Detail Buku Besar
            </div>
               <div class="card-body">
					       <div class="panel-body">
				    
                        <h6 class="pull-left">Nama Akun : <strong>{{ $akun->nama_akun }}</strong> </h6>
                        <h6 class="pull-right">Kode Akun : <strong>{{ $akun->kode_akun }}</strong> </h6>
                        <h6 class="text-center">Periode : <strong>{{ $periode }}</strong> </h6>
                        <table class="table table-hover table-bordered table-striped text-center">
                          <tr>
                            <th class="text-center table-success" colspan="3">Transaksi</th>
                            <th class="text-center table-success" colspan="2">Saldo</th>
                          </tr>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Waktu Transaksi</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Debet</th>
                            <th class="text-center">Kredit</th>
                          </tr>
                        <?php $i = 1 ?>
                        @foreach($daftar_buku as $data)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ date('d M Y',strtotime($data->waktu_transaksi)) }}</td>
                            <td class="text-center">{{ $data->keterangan }}</td>
                            <td>
                            @if($data->tipe === 'd')
                              Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
                            @else
                              -
                            @endif
                            </td>
                            <td>
                            @if($data->tipe === 'k')
                              Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
                            @else
                              -
                            @endif
                            </td>
                          </tr>
                        @endforeach

                        <tr>
                          <th colspan="3" class="text-center">Jumlah</th>
                          <th class="text-center">Rp. {{ number_format($total_debet, 0, ',', '.') }},-</th>
                            <th class="text-center">Rp. {{ number_format($total_kredit, 0, ',', '.') }},-</th>
                        </tr>

                        <tr>
                            <th colspan="3" class="text-center">Saldo</th>
                            <th colspan="2" class="text-center">
                            @if( substr($akun->kode_akun, 0, 1) === '1' ||  substr($akun->kode_akun, 0, 1) === '3' ||  substr($akun->kode_akun, 0, 1) === '5' )
                            
                            Rp. {{ number_format($total_debet - $total_kredit, 0, ',', '.') }},-
                            
                            @elseif( substr($akun->kode_akun, 0, 1) === '2' ||  substr($akun->kode_akun, 0, 1) === '6' || substr($akun->kode_akun, 0, 1)  === '4' )
                            
                            Rp. {{ number_format($total_kredit - $total_debet, 0, ',', '.') }},-
                            
                            @endif
                            </th>
                        </tr>

                        <tr>
                            <th colspan="3" class="text-center">Terbilang</th>
                            <th colspan="2" class="text-center">
                            <em>
                            @if( substr($akun->kode_akun, 0, 1) === '1' ||  substr($akun->kode_akun, 0, 1) === '3' ||  substr($akun->kode_akun, 0, 1) === '5')
                            {{ ucwords(terbilang($total_debet - $total_kredit)) }} Rupiah
                            @elseif( substr($akun->kode_akun, 0, 1) === '2' ||  substr($akun->kode_akun, 0, 1) === '6' || substr($akun->kode_akun, 0, 1) === '4')
                             {{ ucwords(terbilang($total_kredit - $total_debet)) }} Rupiah 
                            @endif
                            </em>
                            </th>
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