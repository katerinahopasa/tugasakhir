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
	       <div class="row">
				  <div class="col-md-12">
					  <div class="panel panel-default">
						  <div class="card-header">
  							Tambah Data Akun
  							<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
      						<div class="card-body">
      							<div class="panel-body">
                      {!! Form::open(['url' => 'akun', 'class' => 'form-horizontal']) !!}
      							{{ csrf_field() }}

      								<div class="form-group">
      									<label class="col-md-3 control-label" for="name">No. Rekening</label>
      									<div class="col-md-9">
      										{!! Form::text('kode_akun', null, ['class' => 'form-control']) !!}
      									</div>
      								</div>
      								
      								<div class="form-group">
      									<label class="col-md-3 control-label" for="name">Nama Rekening/Akun</label>
      									<div class="col-md-9">
      										{!! Form::text('nama_akun', null, ['class' => 'form-control']) !!}
      									</div>
      								</div>

                      <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Jenis Akun</label>
                        <div class="col-md-9">
                          <select name="jenis_akun" class="form-control">
                            <option>-- JENIS AKUN --</option>
                            <option value="aktiva_lancar">Aktiva Lancar</option>
                            <option value="pendapatan">Pendapatan</option>
                            <option value="beban">Beban</option>
                            <option value="modal">Modal</option>
                            <option value="ikhtisar">Ikhtisar</option>
                            <option value="aktiva_tetap">Aktiva Tetap</option>
                            <option value="pasiva">Pasiva</option>
                            <option value="ekuitas">Ekuitas</option>
                          </select>
                        </div>
                      </div>
      								
      								<!-- Form actions -->
                    <div class="form-group">
                      <div class="col-md-12 widget-right">
                        <a class="btn btn-default" href="/akun"><i class="fas fa-arrow-circle-left"></i></a>
                        <button type="submit" class="btn btn-default btn-md pull-right">Tambah</button>
                      </div>
                    </div>
                    {!! Form::close() !!}
    							</div>
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


