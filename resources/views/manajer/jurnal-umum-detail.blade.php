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
                    <a href="{{ url('manajer/jurnal-umum') }}" class="nav-link active">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                        Jurnal Umum
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manajer/buku-besar') }}" class="nav-link">
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
				<div class="panel panel-default">
					<div class="card-header">
                        Detail Jurnal Umum 
				    </div>
                <div class="card-body">
                    <div class="panel-body">
                        <h6 class="pull-left">Total Data : <strong>{{ $total_jurnal }}</strong> </h6>
                        <h6 class="pull-right">Periode : <strong>{{ $periode }}</strong> </h6>
                        <table class="table table-hover table-bordered table-striped text-center">
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Akun</th>
                            <th class="text-center">Debet</th>
                            <th class="text-center">Kredit</th>
                          </tr>
                          <?php $i = 1 ?>
                          @foreach($daftar_jurnal as $data)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->waktu_transaksi }}</td>
                            <td>{{ $data->akun->nama_akun }}</td>
                            <td>
                            @if($data->tipe === 'd')
                              Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
                            @else
                              -
                            @endif
                            </td>
                            <td>
                            @if($data->tipe === 'k')
                              Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
                            @else
                              -
                            @endif
                            </td>
                          </tr>
                        @endforeach

                        <tr>
                            <th colspan="3" class="text-center">TOTAL</th>
                            <th class="text-center">Rp. {{ number_format($total_debet, 0, ',', '.') }},-</th>
                            <th class="text-center">Rp. {{ number_format($total_kredit, 0, ',', '.') }},-</th>

                            @if($total_debet === $total_kredit)
                            <th class="text-center alert alert-success"> 
                                BALANCE
                            </th>
                            @else
                            <th class="text-center alert alert-danger"> 
                                NOT BALANCE
                            </th>
                            @endif
                        </tr>

                        <tr>
                            <th colspan="3" class="text-center">TERBILANG</th>
                            <th class="text-center"> <em> {{ ucwords(terbilang($total_debet)) }} Rupiah</em></th>
                            <th class="text-center"> <em> {{ ucwords(terbilang($total_kredit)) }} Rupiah</em></th>
                        </tr>

                    </table>

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
@stop