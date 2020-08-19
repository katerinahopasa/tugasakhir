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
               <a href="{{ url('jurnal') }}" class="nav-link active">
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
						<div class="card-header">
							Form Tambah Data Jurnal
							<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="card-body">
						 <div class="panel-body">
						@include('errors.form_error_list')
					
                        {!! Form::open(['url' => 'jurnal', 'class' => 'form-horizontal']) !!}
								<div class="form-group">
						{{ csrf_field() }}
									<label class="col-md-3 control-label" for="name">Waktu</label>
									<div class="col-md-9">
										{!! Form::date('waktu_transaksi', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
									</div>
								</div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Jenis Jurnal</label>
                      <div class="col-md-9">
                        <select name="jenis_jurnal" class="form-control">
                            <option>-- JENIS JURNAL --</option>
                            <option value="u">Jurnal Umum</option>
                            <option value="p">Jurnal Penyesuaian</option>
                        </select>
                       </div>
                   </div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Akun</label>
									<div class="col-md-9">
										{!! Form::select('id_akun', $daftar_akun, null, ['class' => 'form-control', 'placeholder' => '-- Daftar Akun --']) !!}
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nominal Rp.</label>
									<div class="col-md-9">
									{!! Form::number('nominal', null, ['class' => 'form-control']) !!}
									</div>
                                </div>
                                
                                <div class="form-group">
									<label class="col-md-3 control-label" for="name">Keterangan</label>
									<div class="col-md-9">
									{!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
									</div>
								</div>
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Tipe</label>
                      <div class="col-md-9">
                        <select name="tipe" class="form-control">
                            <option>-- TIPE --</option>
                            <option value="d">DEBET</option>
                            <option value="k">KREDIT</option>
                        </select>
                       </div>
                   </div>

								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
                    <a class="btn btn-default" href="/jurnal"><i class="fas fa-arrow-circle-left"></i></a>
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
	</section>
</div>

@endsection