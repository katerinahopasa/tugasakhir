@extends('template')

@section('main')

@extends('auth')

@section('content')

<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Ketenger Adventure</span>
        </a>

        <!-- Sidebar -->
    <div class="container-fluid main">
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
                    Laporan Kegiatan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/kelola-jenis') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelola Jenis Transaksi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/laporan-kegiatan') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelola Laporan Kegiatan</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ url('akun') }}" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Chart of Account
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('jurnal-umum') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Jurnal Umum
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('jurnal-penyesuaian') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Jurnal Penyesuaian
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('buku-besar') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Buku Besar
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('neraca-saldo') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Neraca Saldo
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('neraca-lajur') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Neraca Lajur
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('laporan') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Laporan
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
						<div class="card-header">
							Form Data Laporan Kegiatan 
							<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="card-body">
						 <div class="panel-body">
						@include('errors.form_error_list')
                        {!! Form::open(['url' => 'laporan-kegiatan', 'class' => 'form-horizontal']) !!}
								<div class="form-group row">
						{{ csrf_field() }}
									<label class="col-sm-2 col-form-label" for="name">Waktu</label>
									<div class="col-md-3">
										{!! Form::date('tgl_kegiatan', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
									</div>
								</div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="name">Nama Pelanggan</label>
                  <div class="col-md-9">
                  {!! Form::text('nama_pelanggan', null, ['class' => 'form-control']) !!}
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="name">Nama Kegiatan</label>
                  <div class="col-md-9">
                  {!! Form::text('nama_kegiatan', null, ['class' => 'form-control']) !!}
                  </div>
                </div>
                <br>
                <div class="form-group row">
                  <label class="col-md-3 control-label" for="name">Realisasi Kuangan</label>
                </div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label" for="name">Pendapatan</label>
                  <div class="col-md-9">
                    <button type="button" class="btn btn-sm btn-primary mb-sm-2" data-toggle="modal" data-target="#exampleModal" ><i class=""></i>Tambah</button>
                    <div id="table_ptk" style="max-width: 100%;"></div>
                    @if($updateMode)
				        @include('livewire.update')
				    @else
				        @include('livewire.create')
				    @endif
                    <table class="table table-sm table-hover table-striped table-bordered mt-sm-2 text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis Pendapatan</th>
                        <th>Deskripsi</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pendapatan_kegiatan as $key => $ptk)
                      <tr id="ptk_{{$ptk->id}}">
                        <td>{{++$key}}</td>
                        <td style="max-width: 115px;word-wrap: break-word;">{{$ptk->jenis_pendapatan->nama_jenis}}</td>
                        <td style="max-width: 130px;word-wrap: break-word;">{{$ptk->deskripsi}}</td>
                        <td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($ptk->nominal,0,'.','.')}}</td>
                        <td width="100">
		                    <button wire:click="edit({{$ptk->id}})" class="btn btn-xs btn-warning">Edit</button>
		                    <button wire:click="destroy({{$ptk->id}})" class="btn btn-xs btn-danger">Hapus</button>
		                </td>
                        <td>
                          <form action="{{url('kelola-jenis/'.$ptk->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="tipe" value="pendapatan">
                            <button type="button" class="btn btn-sm btn-info bptk" value="{{$ptk->id}}">Edit</button>
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      <tr>
                        <th colspan="3" class="text-center">Total</th>
                        <th class="text-center">Rp. {{ number_format($total_pendapatan, 0, ',', '.') }},-</th>
                      </tr>
                    </tbody>
                  </table>
                  <div class="col-md-9">
                    {!! Form::select('id_jenispendapatan', $daftar_jenispendapatan, null, ['class' => 'form-control', 'placeholder' => '-- Daftar Jenis Pendapatan --']) !!}
                  </div>
                  </div>
								</div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pendapatan Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/cagarbergerak/create" method="POST">
                          {{csrf_field()}}
                          <div class="form-group">
                                <label class="col-md-6 control-label" for="name">Jenis Pendapatan</label>
                                  <div class="col-md-12">
                                    <select name="jenis" required title="Jenis Pendapatan" class="form-control">
                                      <option value="">Pilih Pendapatan</option>
                                      @foreach($jp as $kt)
                                      <option value="{{$kt->id}}">{{$kt->nama_jenis}}</option>
                                      @endforeach
                                    </select>
                                   </div>
                               </div>

                              <div class="form-group">
                                  <label for="name" class="col-md-3 control-label">Deskripsi</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="" required="">
                                  </div>
                              </div>
                   
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Nominal</label>
                                  <div class="col-sm-12">
                                      <input type="number" class="form-control" id="nominal" name="nominal" value="" required="">
                                  </div>
                              </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="name">Pengeluaran</label>
                  <div class="col-md-9">
                    <button type="button" class="btn btn-sm btn-primary mb-sm-2" data-toggle="modal" data-target="#exampleModal2" ><i class=""></i>Tambah</button>
                    <div id="table_prk" style="max-width: 100%;"></div>
                    <table class="table table-sm table-hover table-striped table-bordered mt-sm-2 text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis Pengeluaran</th>
                        <th>Deskripsi</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pengeluaran_kegiatan as $key => $prk)
                      <tr id="prk{{$prk->id}}">
                        <td>{{++$key}}</td>
                        <td style="max-width: 115px;word-wrap: break-word;">{{$prk->jenis_pengeluaran->nama_jenis}}</td>
                        <td style="max-width: 130px;word-wrap: break-word;">{{$prk->deskripsi}}</td>
                        <td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($prk->nominal,0,'.','.')}}</td>
                        <td>
                          <form action="{{url('kelola-jenis/'.$prk->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="tipe" value="pengeluaran">
                            <button type="button" class="btn btn-sm btn-info bprk" value="{{$prk->id}}">Edit</button>
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      <tr>
                        <th colspan="3" class="text-center">Total</th>
                        <th class="text-center">Rp. {{ number_format($total_pengeluaran, 0, ',', '.') }},-</th>
                      </tr>
                    </tbody>
                  </table>
                  <div class="col-md-9">
                    {!! Form::select('id_jenispengeluaran', $daftar_jenispengeluaran, null, ['class' => 'form-control', 'placeholder' => '-- Daftar Jenis Pengeluaran --']) !!}
                  </div>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/cagarbergerak/create" method="POST">
                          {{csrf_field()}}
                          <div class="form-group">
                                <label class="col-md-6 control-label" for="name">Jenis Pengeluaran</label>
                                  <div class="col-md-12">
                                    <select name="jenis" required title="Jenis Pendapatan" class="form-control">
                                      <option value="">Pilih Pengeluaran</option>
                                      @foreach($jpr as $kt)
                                      <option value="{{$kt->id}}">{{$kt->nama_jenis}}</option>
                                      @endforeach
                                    </select>
                                   </div>
                               </div>

                              <div class="form-group">
                                  <label for="name" class="col-md-3 control-label">Deskripsi</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="" required="">
                                  </div>
                              </div>
                   
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Nominal</label>
                                  <div class="col-sm-12">
                                      <input type="number" class="form-control" id="nominal" name="nominal" value="" required="">
                                  </div>
                              </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="name">Total Laba</label>
						<div class="col-md-9">
							{!! Form::number('nominal', null, ['class' => 'form-control']) !!}
						</div>
                </div>
                                
                <div class="form-group row">
					<label class="col-sm-2 col-form-label" for="name">Keterangan</label>
						<div class="col-md-9">
							{!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
						</div>
				</div>
					<!-- Form actions -->
				<div class="form-group row">
					<div class="col-md-12 widget-right">
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
@stop
