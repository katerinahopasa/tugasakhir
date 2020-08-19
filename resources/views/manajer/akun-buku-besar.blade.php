@extends('templatemanajer')

@section('main')

@extends('manajer.auth')

@section('content')

<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">Alexander Pierce</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Keuangan Harian
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/lapharian2') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelola Transaksi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./index2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Laporan Keuangan</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Keuangan Adventure
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('manajer/jurnal-umum') }}" class="nav-link">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                        Jurnal Umum
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manajer/buku-besar') }}" class="nav-link active">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                        Buku Besar
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manajer/neraca-saldo') }}" class="nav-link">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                        Neraca Saldo
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manajer/laporan') }}" class="nav-link">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                        Laporan
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

<div class="content-wrapper" style="min-height: 1196.05px;">
 <section class="content">
   <div class="row">
     <div class="col-md-12">
       <div class="card">
      	<div class="container main">
      				<div class="panel panel-default">
      					<div class="card-header">
                    Buku Besar {{ $akun->nama_akun }} 
      				    </div>
                <div class="card-body">
      					 <div class="panel-body">

{!! Form::open(['url' => 'manajer/buku-besar/'.$akun->id.'/cari', 'method' => 'get', 'class' => 'form-inline text-center']) !!}
                  <div class="form-group">
                    <label for="name">Bulan</label>
                    {!! Form::selectMonth('bulan', null, ['class' => 'form-control', 'placeholder' => '-- Bulan --']) !!}
                  </div>
                  <div class="form-group">
                    <label for="name">Tahun</label>
                    {!! Form::selectRange('tahun', 2018, 2050, null, ['class' => 'form-control', 'placeholder' => '-- Tahun --']) !!}
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-md">Cari</button>
                    </div>
                  </div>
{!! Form::close() !!}
                    <br>

                        <h4>Total Data : <strong>{{ $total_buku }}</strong> </h4>
                        <table class="table table-hover table-bordered table-striped text-center">
                        <caption class="text-center"> <strong>Daftar Buku Besar {{ $akun->nama_akun }}</strong></caption>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Action</th>
                          </tr>
                          <?php $i = 1 ?>
                          @foreach($daftar_buku as $data)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ date('F Y', strtotime('1-'.$data->waktu)) }}</td>
                            <td>
                              <a href="{{ url('manajer/buku-besar/'.$akun->id.'/'.date('Y-m-d', strtotime('1-'.$data->waktu))) }}" class="btn btn-info">
                                Detail
                              </a>
                            </td>
                          </tr>
                        @endforeach
                    </table>

					     </div>
             </div>
				    </div>

	      </div>	<!--/.main-->
     </div>
   </div>
  </div>
 </section>
</div>

@endsection
@stop