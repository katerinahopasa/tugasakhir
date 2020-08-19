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
 <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				<div class="card-header">
              		<h6 class="text-center"><caption><b>DATA JENIS TRANSAKSI KEGIATAN</b></caption></h6>
				</div>
				<div class="card-body">
				   <div class="panel-body">
						<div class="col-md-6">
							<a href="{{ url('kelola-jenistransaksi/tambah') }}" class="btn btn btn-success btn-sm">Tambah Jenis Transaksi</a>
						</div>
						<div id="table_jt" style="max-width: 100%;"></div>
						<table id="example" class="table table-sm table-hover table-striped table-bordered mt-sm-2 text-center">
							<thead>
								<tr>
									<th>No</th>
									<th>Jenis Transaksi</th>
									<th>Deskripsi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_jenis_transaksikegiatan as $key => $jt)
								<tr id="jt_{{$jt->id}}">
									<td>{{++$key}}</td>
									<td style="max-width: 115px;word-wrap: break-word;">{{$jt->nama_jenis}}</td>
									<td style="max-width: 130px;word-wrap: break-word;">{{$jt->deskripsi}}</td>
									<td>
										<a class="btn btn-xs btn-primary" href="/kelola-jenistransaksi/edit/{{ $jt->id }}"><i class="fas fa-edit"></i></a>
										<a href="/kelola-jenistransaksi/{{$jt->id}}/delete" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
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