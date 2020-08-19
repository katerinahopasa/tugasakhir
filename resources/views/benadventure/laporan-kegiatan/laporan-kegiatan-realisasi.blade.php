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
              <a href="{{ url('/laporan-kegiatan') }}" class="nav-link active">
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
   <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="panel panel-default">
          <div class="card-header">
            <a class="btn btn-default" href="/laporan-kegiatan"><i class="fas fa-arrow-circle-left"></i></a> 
            @role('benadventure')
            <a href="{{ url('laporan-kegiatan/realisasi/'.$data->id.'/create') }}" class="btn btn-primary pull-right">Tambah</a>
            @endrole
          </div>
          <div class="card-body">
           <div class="panel-body">
            <!-- <a target="_BLANK" href="{{ route('realisasi_kegiatanExcel',[$data->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-file-excel"></i> &nbsp; CETAK EXCEL</a> -->
            <a target="_BLANK" href="{{ url('realisasi-cetak/'.$data->id) }}" class="btn btn-outline-secondary"><i class="fa fa-print "></i> &nbsp; CETAK PDF</a>
            <br>
            <br>
            <table style="width: 50%">
              <tr>
                 <th width="25%">NAMA PELANGGAN</th>
                 <th width="3%" class="text-center">:</th>
                  <td>{{$data->nama_pelanggan}}</td>
                 </tr>
               <tr>
                 <th width="25%">NAMA KEGIATAN</th>
                 <th width="3%" class="text-center">:</th>
                  <td>{{$data->nama_kegiatan}}</td>
               </tr>
               <tr>
                 <th width="25%">WAKTU KEGIATAN</th>
                 <th width="3%" class="text-center">:</th>
                  <td>{{ date('d M Y',strtotime($data->tgl_kegiatan)) }}</td>
               </tr>
                </table>
             <table class="table table-sm table-hover table-striped table-bordered mt-sm-2 text-center">
               <h6 class="text-center"> <strong>DATA REALISASI KEUANGAN KEGIATAN</strong></h6>
                <tr>
                  <th class="text-center table-success">No</th>
                  <th class="text-center table-success">Jenis Transaksi</th>
                  <th class="text-center table-success">Keterangan</th>
                  <th class="text-center table-success">Uang Masuk</th>
                  <th class="text-center table-success">Uang Keluar</th>
                  <th class="text-center table-success">Action</th>
                </tr>
                <?php $i = 1 ?>
                @foreach($data_kegiatan as $data)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $data->jenis_transaksikegiatan->nama_jenis }}</td>
                  <td>{{ $data->keterangan }}</td>
                  <td>
                  @if($data->tipe === 'm')
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
                  <td>
                    <a href="{{ url('laporan-kegiatan/realisasi/'.$data->id.'/edit') }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                     {!! Form::open(['url' => 'laporan-kegiatan/realisasi/'.$data->id, 'method' => 'delete', 'class' => 'form', 'style' => 'display:inline-block']) !!}
                     {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  !!}
                     {!! Form::close() !!}
                  </td>
                    </tr>
                     @endforeach
                <tr>
                  <th colspan="3" class="text-center">Total</th>
                  <th class="text-center">Rp. {{ number_format($total_pendapatan, 0, ',', '.') }},-</th>
                  <th class="text-center">Rp. {{ number_format($total_pengeluaran, 0, ',', '.') }},-</th>
                  <th></th>
                </tr>
                <tr>
                  <th colspan="3" class="text-center">TOTAL LABA KEGIATAN</th>
                  <th colspan="2" class="text-center">
                    Rp. {{ number_format($total_pendapatan - $total_pengeluaran, 0, ',', '.') }},-
                  </th>
                  <th></th>
                </tr>
               </table>
             </div>
          </div>
         </div>
       </div>
     </div>
   </div>
  </div>

@endsection