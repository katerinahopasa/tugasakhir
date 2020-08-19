@extends('layouts.app')

@section('content')

<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{asset('assets/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
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
                <a href="{{ route('users.index') }}" class="nav-link active">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Kelola Data User
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Kelola Jenis Role
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
