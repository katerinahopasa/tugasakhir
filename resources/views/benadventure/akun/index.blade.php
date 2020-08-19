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
              <a href="{{ url('akun') }}" class="nav-link active">
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
				  <div class="panel panel-default">
          @if(Session::has('pesan'))
          <div class="panel-heading text-center">
          <h5 class="btn btn-info btn-block">{{ Session::get('pesan') }}</h5>
          </div>
          @endif
					 <div class="card-header">
             <h6 class="text-center"> <strong>DAFTAR CHART OF ACCOUNT</strong></h6>  
				    </div>
            <div class="card-body">
					   <div class="panel-body">
                <a href="{{ url('akun/create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                        <h6>Total Data : <strong>{{ $total_akun }}</strong> </h6>
                        <table id="example" class="table table-hover table-bordered table-striped text-center">
                        
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Rekening/Akun</th>
                            <th class="text-center">No. Rekening/Akun</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1 ?>
                        @foreach($daftar_akun as $data)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->nama_akun }}</td>
                            <td>{{ $data->kode_akun }}</td>
                            <td>
                              <a href="{{ url('akun/'.$data->id.'/edit') }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                              {!! Form::open(['url' => 'akun/'.$data->id, 'method' => 'delete', 'class' => 'form', 'style' => 'display:inline-block']) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  !!}
                              {!! Form::close() !!}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
					    </div>
				    </div>
          </div>
			  </div>
		  </div><!--/.row-->

	  </div>	<!--/.main-->

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

