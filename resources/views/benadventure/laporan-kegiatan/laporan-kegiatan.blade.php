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
        <div class="card-header">
            <h6 class="text-center"><caption><b>DATA LAPORAN KEGIATAN DIVISI ADVENTURE</b></caption></h6>
        </div>
          @if(Session::has('pesan'))
          <div class="panel-heading text-center">
            <h6 class="alert alert-success">{{ Session::get('pesan') }}</h6>
          </div>
          @endif
          @role('benadventure')
         <div class="col-md-6">
           <a href="{{ url('laporan-kegiatan/create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
         </div>
         @endrole
          <div class="card-body">
           <div class="panel-body">
            <table id="example" class="table table-sm table-hover table-striped table-bordered mt-sm-2 text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Waktu</th>
                  <th>Nama Kegiatan</th>
                  <th>Nama Pelanggan</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                 @foreach($laporan_kegiatan as $data)
                 <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ date('d M Y',strtotime($data->tgl_kegiatan)) }}</td>
                  <td>{{ $data->nama_kegiatan }}</td>
                  <td>{{ $data->nama_pelanggan }}</td>
                  <td>
                    @if($data->status === 's')
                       <span class="badge badge-success">Sudah Dilaksanakan</span>
                    @elseif($data->status === 'm')
                       <span class="badge badge-warning">Menunggu</span>
                    @else
                       <span class="badge badge-danger">Batal</span>
                    @endif
                  </td>
                  <td>
                    @role('benadventure')
                    <a href="{{ url('laporan-kegiatan/'.$data->id.'/edit') }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                    {!! Form::open(['url' => 'laporan-kegiatan/'.$data->id, 'method' => 'delete', 'class' => 'form', 'style' => 'display:inline-block']) !!}
                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  !!}
                    {!! Form::close() !!}
                    @endrole
                    <a href="{{ url('laporan-kegiatan/realisasi/'.$data->id) }}" class="btn btn-info btn-sm">
                     Realisasi Keuangan
                    </a>
                   </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
         </div>
       </div>
          
      </div>
    </div>
  </div>
 </section>
</div>



@endsection

@section('script')
<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    $(function () {
$("#example").DataTable();
});
    </script>

@endsection