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
            Detail Jurnal 
            <a href="{{ url('jurnal/create') }}" class="btn btn-primary pull-right">Tambah</a>
				  </div>
            <div class="card-body">
					     <div class="panel-body">
                        <h6 class="pull-left">Total Data : <strong>{{ $total_jurnals }}</strong> </h6>
                        <h6 class="pull-right">Periode : <strong>{{ $periode }}</strong> </h6>
                        <table class="table table-sm table-hover table-striped table-bordered mt-sm-2 text-center">
                          <tr>
                            <th class="text-center table-success">No</th>
                            <th class="text-center table-success">Waktu</th>
                            <th class="text-center table-success">Jenis Jurnal</th>
                            <th class="text-center table-success">Akun</th>
                            <th class="text-center table-success">Keterangan</th>
                            <th class="text-center table-success">Debet</th>
                            <th class="text-center table-success">Kredit</th>
                            <th class="text-center table-success">Action</th>
                          </tr>
                          <?php $i = 1 ?>
                          @foreach($daftar_jurnals as $data)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ date('d M Y',strtotime($data->waktu_transaksi)) }}</td>
                            <td>
                            @if($data->jenis_jurnal === 'u')
                              Jurnal Umum
                            @else
                              Jurnal Penyesuaian
                            @endif
                            </td>
                            <td>{{ $data->akun->nama_akun }}</td>
                            <td>{{ $data->keterangan }}</td>
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
                            <td>
                            <a href="{{ url('jurnal/'.$data->id.'/edit') }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                              {!! Form::open(['url' => 'jurnal/'.$data->id, 'method' => 'delete', 'class' => 'form', 'style' => 'display:inline-block']) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  !!}
                              {!! Form::close() !!}
                            </td>
                          </tr>
                        @endforeach

                        <tr>
                            <th colspan="5" class="text-center">TOTAL</th>
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
                            <th colspan="5" class="text-center">TERBILANG</th>
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