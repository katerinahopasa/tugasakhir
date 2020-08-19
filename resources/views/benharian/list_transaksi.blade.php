@extends('layouts.app')
@section('title',$title)

@section('content')
<h6 class="text-center"><b>Daftar Transaksi {{$caption}}</b></h6>
<hr>
@if(session('alert'))
<div class="alert alert-info">
	{{session('alert')}}
</div>
@endif

 <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
 <!-- Brand Logo -->
  <a href="/benharian" class="brand-link">
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
 <section class="content">
 	<div class="card">
 	 <div class="container main">
		<div class="row">
			<div class="col-md-9">
				<form action="{{url('transaksi')}}" method="GET" class="form-inline">
					@csrf
					<label class="mr-sm-5"><strong>Filter :</strong></label>
					<label class="mr-sm-2">Mulai :</label>
					<input type="date" name="mulai" required="" class="form-control mr-sm-2 mb-2">
					<label class="mr-sm-2">Selesai :</label>
					<input type="date" name="akhir" required="" class="form-control mr-sm-2 mb-2">
					<button type="submit" class="btn btn-sm btn-default">Filter</button>
				</form>
			</div>
			<div class="col-md-3">
				<h4 class="text-info">Saldo : Rp {{number_format($saldo,0,'.','.')}}</h4>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h6><b>Pemasukan</b></h6>
				@role('benharian')
				<a href="{{ url('transaksi/tambahPemasukan') }}" class="btn btn btn-success btn-sm">Tambah Pemasukan</a>
				@endrole
				<div id="table_lpm" style="max-width: 100%;"></div>
				<br>
				<h6 class="pull-left">Total Data : <strong>{{ $total_datapemasukan }}</strong> </h6>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
						  <th>No</th>
	                      <th>Tanggal</th>
	                      <th>Jml Pengunjung</th>
	                      <th>Pemasukan</th>
	                      <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pemasukan as $key => $p)
						<tr id="lpm_{{$p->id}}">
						  <td>{{++$key}}</td>
		                  <td style="max-width: 115px;word-wrap: break-word;">{{ date('d M Y',strtotime($p->tanggal)) }}</td>
		                  <td style="max-width: 115px;word-wrap: break-word;">{{ $p->jml_pengunjung }}</td>
		                  <td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($p->total_pemasukan,0,'.','.')}}</td>
						  <td>
						  	<a href="/transaksi/detailPemasukan/{{ $p->id }}" class="btn btn-xs btn-success"><i class="fas fa-eye"></i></a>
						  	@role('benharian')
							<a href="/transaksi/editPemasukan/{{ $p->id }}" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
							<a href="/transaksi/{{$p->id}}/deletePemasukan" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
							@endrole
						  </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				<h6><b>Pengeluaran</b></h6>
				@role('benharian')
				<a href="{{ url('transaksi/tambahPengeluaran') }}" class="btn btn btn-primary btn-sm">Tambah Pengeluaran</a>
				@endrole
				<div id="table_lpr" style="max-width: 100%;"></div>
				<br>
				<h6 class="pull-left">Total Data : <strong>{{ $total_datapengeluaran }}</strong> </h6>
				<table id="example2" class="table table-bordered table-hover">
					<thead>
						<tr>
						  <th>No</th>
	                      <th>Tanggal</th>
	                      <th>Nama Pengeluaran</th>
	                      <th>Nominal</th>
	                      <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pengeluaran as $key => $p)
						<tr id="lpr_{{$p->id}}">
						  <td>{{++$key}}</td>
	                      <td style="max-width: 115px;word-wrap: break-word;">{{ date('d M Y',strtotime($p->tanggal)) }}</td>
	                      <td style="max-width: 115px;word-wrap: break-word;">{{ $p->nama_pengeluaran }}</td>
	                      <td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($p->nominal,0,'.','.')}}</td>
						  <td>
						  	<a href="/transaksi/detailPengeluaran/{{ $p->id }}" class="btn btn-xs btn-success"><i class="fas fa-eye"></i></a>
						  	@role('benharian')
							<a class="btn btn-xs btn-primary" href="/transaksi/editPengeluaran/{{ $p->id }}"><i class="fas fa-edit"></i></a>
							<a href="/transaksi/{{$p->id}}/deletePengeluaran" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
							@endrole
						  </td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br>
			
			@role('benharian')
				<h6>Total Pemasukan {{$caption}} : Rp {{number_format($total_masukperbulan,0,'.','.')}}</h6>
				@if (count($pemasukan) == 10)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 15)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 16)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 17)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 18)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 19)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 20)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 21)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 22)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 23)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 24)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan  <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 25)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 26)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 27)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) == 28)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>

				@elseif (count($pemasukan) ==29)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>
				<h6>Setoran Kedua   : 40% x Total Pemasukan dari <strong>tanggal 16 sampai 31</strong> = <strong><i>Rp {{number_format($setoran2,0,'.','.')}}</i></strong></h6>
				
				@elseif (count($pemasukan) >= 30)
				<h6> <strong>Estimasi Setoran ke Perhutani {{$caption}}</strong></h6>
				<h6>Setoran Pertama : 40% x Total Pemasukan dari <strong>tanggal 1 sampai 15</strong> = <strong><i>Rp {{number_format($setoran1,0,'.','.')}}</i></strong></h6>
				<h6>Setoran Kedua   : 40% x Total Pemasukan dari <strong>tanggal 16 sampai 31</strong> = <strong><i>Rp {{number_format($setoran2,0,'.','.')}}</i></strong></h6>
				@else 
				   
				@endif
			@endrole
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
$("#example1, #example2").DataTable();
});
    </script>

@endsection