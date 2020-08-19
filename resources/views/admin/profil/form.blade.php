@extends('layouts.app')

@section('content')

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
 <!-- Brand Logo -->
  <a href="{{ url('/admin') }}" class="brand-link">
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
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-id-card"></i>
                  <p>
                    Kelola Data User
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-user-tag"></i>
                  <p>
                    Kelola Jenis Role
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/profil" class="nav-link active">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>
                    Kelola Profil Pokdarwis
                  </p>
                </a>
              </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        </div>
        <!-- /.sidebar -->
      </aside>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="panel panel-default">
					<div class="card-header">
            <a class="btn btn-default" href="{{ route('profil.index') }}"><i class="fas fa-arrow-circle-left"></i></a>
						{{ $ketForm }} 
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="card-body">
						<div class="panel-body">
						{{ csrf_field() }}
						@if(isset($profil))
						    {!! Form::hidden('id', $profil->id) !!}
						@endif
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nama</label>
									<div class="col-md-9">
										{!! Form::text('nama_perusahaan', null, ['class' => 'form-control']) !!}
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Tanggal Berdiri</label>
									<div class="col-md-9">
										{!! Form::date('tanggal_berdiri', null, ['class' => 'form-control']) !!}
									</div>
								</div>
								
                                <div class="form-group">
									<label class="col-md-3 control-label" for="name">Telepon</label>
									<div class="col-md-9">
										{!! Form::number('telepon', null, ['class' => 'form-control']) !!}
									</div>
								</div>

                                <div class="form-group">
									<label class="col-md-3 control-label" for="name">Alamat</label>
									<div class="col-md-9">
									{!! Form::textarea('alamat_perusahaan', null, ['class' => 'form-control']) !!}
									</div>
								</div>

                                <div class="form-group">
									<label class="col-md-3 control-label" for="name">Email</label>
									<div class="col-md-9">
									{!! Form::text('email', null, ['class' => 'form-control']) !!}
									</div>
								</div>

								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										{!!Form::submit($submitButton, ['class' => 'btn btn-default pull-right'])!!}
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
