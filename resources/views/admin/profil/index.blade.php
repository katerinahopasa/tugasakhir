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

<div class="content-wrapper" style="min-height: 1196.05px;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="panel panel-default">
            @if(Session::has('pesan'))
            <div class="panel-heading text-center">
              <h4 class="btn btn-info btn-block">{{ Session::get('pesan') }}</h4>
            </div>
            @endif
    					<div class="card-header">Profil Perusahaan</div>
                <div class="col-lg-12 margin-tb">
                  <div class="pull-right">
                    <a class="btn btn-info btn-sm" href="{{ url('profil/'.$profil->id.'/edit') }}">Edit Profil</a>
                  </div>
                </div>
    					  <div class="card-body">
                  <div class="panel-body">
                    <h6 class="text-center"><strong>DATA INFORMASI POKDARWIS</strong></h6>
                  <table class="table table-bordered">
                        <tr>
                          <th class="text-center">Nama</th>
                          <th class="text-center">{{ $profil->nama_perusahaan }}</th>
                        </tr>

                        <tr>
                          <th class="text-center">Tanggal Berdiri</th>
                          <th class="text-center">{{ $profil->tanggal_berdiri }}</th>
                        </tr>

                        <tr>
                          <th class="text-center">Telepon</th>
                          <th class="text-center">{{ $profil->telepon }}</th>
                        </tr>

                        <tr>
                          <th class="text-center">Alamat</th>
                          <th class="text-center">{{ $profil->alamat_perusahaan }}</th>
                        </tr>
                          
                        <tr>
                          <th class="text-center">Email</th>
                          <th class="text-center">{{ $profil->email }}</th>
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