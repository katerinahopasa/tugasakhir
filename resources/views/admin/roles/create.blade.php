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
                <a href="{{ route('roles.index') }}" class="nav-link active">
                  <i class="nav-icon fas fa-user-tag"></i>
                  <p>
                    Kelola Jenis Role
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/profil" class="nav-link">
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
            <div class="pull-left">
               <div class="card-header">
                <a class="btn btn-default" href="{{ route('roles.index') }}"><i class="fas fa-arrow-circle-left"></i></a>
                Tambah Role Baru
               </div>
            </div>
            <div class="col-lg-12 margin-tb">
              <div class="pull-right">
              </div>
            </div>


              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                  </div>
              @endif

          <div class="card-body">
            <div class="panel-body">
              {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Name:</strong>
                          {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Permission:</strong>
                          <br/>
                          @foreach($permission as $value)
                              <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                              {{ $value->name }}</label>
                          <br/>
                          @endforeach
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </div>
          </div>
              {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection