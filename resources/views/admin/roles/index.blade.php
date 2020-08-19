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
             <div class="card-header">Kelola Jenis Role</div>
           </div>
           <div class="col-lg-12 margin-tb">
            <div class="pull-right">
              @can('role-create')
                <a class="btn btn-info btn-sm" href="{{ route('roles.create') }}"> Tambah Role</a>
              @endcan
            </div>
           </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
        <div class="card-body">
          <div class="panel-body">
            <div class="col-md-6">
            <table class="table table-bordered">
              <tr>
                 <th class="table-success">No</th>
                 <th class="table-success">Nama</th>
                 <th class="table-success" width="280px">Action</th>
              </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                        @can('role-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
          </div>
          </div>
        </div>

    {!! $roles->render() !!}

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection