<?php

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

Route::get('/', function () {
  return view('welcome');
    // $user = auth()->user();
   // $role = Role::find(4);

   // $role->givePermissionTo('transaksi-list','transaksi-detail', 'halaman-benharian');
   // $role->givePermissionTo('laporan-kegiatan-list','labarugi','neraca-laporan');
   //$role->revokePermissionTo('role-list');
   // $role->givePermissionTo(['users-list','users-edit','users-delete','users-create','role-list','role-edit','role-delete','role-create']);
   // $role->givePermissionTo(['labarugi','neraca-laporan']);
   // dd($role->hasAnyPermission(['role-edit','role-delete','role-create','users-list','users-edit','users-delete','users-create']));
   // dd($role->hasAnyPermission(['transaksi-list']));
	//$user->givePermissionTo('role-list')
   //dd($user->can('role-list','role-edit','role-delete','role-create'));
    // $user->assignRole('Admin');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('role:Admin')->group(function() {
	//home admin
	Route::get('admin','AdminController@index');

	//kelola role
	Route::resource('roles','RoleController');

	//kelola user
 	Route::resource('users','UserController');

 	//kelola profil organisasi
 	Route::resource('profil', 'ProfilController');
});

Route::middleware('role:Manajer')->group(function() {
	//home manajer
	Route::get('manajer','manajerController@index');

	//jurnal umum
	Route::get('manajer/jurnal-umum', 'manajerController@showJurnalUmum');
	Route::get('manajer/jurnal-umum/detail/{waktu}', 'manajerController@detailJurnalUmum');
	Route::post('manajer/jurnal-umum', 'manajerController@storeJurnalUmum');
	Route::get('manajer/jurnal-umum/cari', 'manajerController@cariJurnalUmum');

	// buku besar
	Route::get('manajer/buku-besar', 'manajerController@showBukuBesar');
	Route::get('manajer/buku-besar/{id}', 'manajerController@akunBukuBesar');
	Route::get('manajer/buku-besar/{id}/cari', 'manajerController@cariBukuBesar');
	Route::get('manajer/buku-besar/{id}/{waktu}', 'manajerController@detailBukuBesar');

	// neraca saldo
	Route::get('manajer/neraca-saldo', 'manajerController@showNeracaSaldo');
	Route::get('manajer/neraca-saldo/cari', 'manajerController@cariNeracaSaldo');
	Route::get('manajer/neraca-saldo/detail/{waktu}', 'manajerController@detailNeracaSaldo');

	//laporan
	Route::get('manajer/laporan', 'manajerController@showLaporan');
	Route::get('manajer/laporan/cetak/{waktu}', 'manajerController@cetakLaporan');
	Route::get('manajer/laporan/cari', 'manajerController@cariLaporan');
});

Route::middleware('role:benharian')->group(function() {
	// //home benharian
	// Route::get('/benharian','benharianController@index');
	// Route::post('benharian/pilihTahun/','benharianController@pilihTahun')->name('pilih-tahun');

	//pemasukan 
	//Route::get('transaksi','Transaksi_pemasukanController@index');
	Route::get('transaksi/tambahPemasukan','Transaksi_pemasukanController@tambah');
    Route::post('transaksi/tambahPemasukan','Transaksi_pemasukanController@store')->name('tambahPemasukan');
    Route::get('/transaksi/editPemasukan/{id}','Transaksi_pemasukanController@edit');
    Route::put('/transaksi/updatePemasukan/{id}','Transaksi_pemasukanController@update');
    Route::get('/transaksi/{id}/deletePemasukan','Transaksi_pemasukanController@delete');

    //pengeluaran
    //Route::get('transaksi','Transaksi_pengeluaranController@index');
    Route::get('transaksi/tambahPengeluaran','Transaksi_pengeluaranController@tambah');
    Route::post('/transaksi','Transaksi_pengeluaranController@store')->name('tambahPengeluaran');
    Route::get('/transaksi/editPengeluaran/{id}','Transaksi_pengeluaranController@edit');
    Route::put('/transaksi/updatePengeluaran/{id}','Transaksi_pengeluaranController@update');
    Route::get('/transaksi/{id}/deletePengeluaran','Transaksi_pengeluaranController@delete');

    //Laporan div.harian (bulanan)
	Route::get('benharian/laporan','LaporanDivHarianController@index');

	Route::get('cari-laporan','LaporanDivHarianController@cari');

	Route::get('/laporan/excel', 'LaporanDivHarianController@laporan_excel')->name('laporan_excel');
	Route::get('laporan-cetak/{mulai}/{selesai}', 'LaporanDivHarianController@laporan_cetak');

	//Route::get('/dokumen-laporan/', 'Dokumen_laporanController@index');
	Route::get('/dokumen-laporan/create', 'Dokumen_laporanController@create');
	Route::post('/dokumen-laporan', 'Dokumen_laporanController@store');
	//Route::get('/dokumen-laporan/{id}', 'Dokumen_laporanController@show');
	//Route::get('/dokumen-laporan/download/{file}', 'Dokumen_laporanController@download');
	//Route::get('/dokumen-laporan/hapus/{id}','Dokumen_laporanController@destroy');

	Route::get('/test/', 'testController@index');

	//estimasi akhir
	Route::get('benharian/laporan', function () {
      $estimasiakhirlaporan = App\Estimasiakhirlaporan::all();
      return view('benharian.laporan.laporan')->with('estimasiakhirlaporan',$estimasiakhirlaporan);
    });
    Route::get('benharian/laporan/{estimasiakhirlaporan_id?}',function($estimasiakhirlaporan_id){
        $estimasiakhirlaporan = App\Estimasiakhirlaporan::find($estimasiakhirlaporan_id);
        return response()->json($estimasiakhirlaporan);
    });
    Route::post('benharian/laporan',function(Request $request){   
        $estimasiakhirlaporan = App\Estimasiakhirlaporan::create($request->input());
        return response()->json($estimasiakhirlaporan);
    });
    Route::put('benharian/laporan/{estimasiakhirlaporan_id?}',function(Request $request,$estimasiakhirlaporan_id){
        $estimasiakhirlaporan = App\Estimasiakhirlaporan::find($estimasiakhirlaporan_id);
        $estimasiakhirlaporan->nama_pembagian = $request->nama_pembagian;
        $estimasiakhirlaporan->persentase = $request->persentase;
        $estimasiakhirlaporan->nominal = $request->nominal;
        $estimasiakhirlaporan->save();
        return response()->json($estimasiakhirlaporan);
    });
    Route::delete('benharian/laporan/{estimasiakhirlaporan_id?}',function($estimasiakhirlaporan_id){
        $estimasiakhirlaporan = App\Estimasiakhirlaporan::destroy($estimasiakhirlaporan_id);
        return response()->json($estimasiakhirlaporan);
    });
});

Route::middleware('role:benadventure')->group(function() {
	// halaman home adventure
	Route::get('/benadventure', 'AkuntansiController@index');

	// akun rekening
	Route::resource('akun', 'AkunController');

	//kelola jenis transaski kegiatan
	Route::get('kelola-jenistransaksi','jenis_transaksikegiatanController@index');
	Route::get('kelola-jenistransaksi/tambah','jenis_transaksikegiatanController@tambah');
	Route::post('kelola-jenistransaksi/tambah','jenis_transaksikegiatanController@store')->name('tambahJenisTransaksi');
	Route::get('/kelola-jenistransaksi/edit/{id}','jenis_transaksikegiatanController@edit');
	Route::put('/kelola-jenistransaksi/update/{id}','jenis_transaksikegiatanController@update');
	Route::get('/kelola-jenistransaksi/{id}/delete','jenis_transaksikegiatanController@delete');

	// laporan kegiatan
	// Route::get('laporan-kegiatan', 'laporan_kegiatanController@showLaporanKegiatan');
	Route::get('laporan-kegiatan/create', 'laporan_kegiatanController@formLaporanKegiatan');
	Route::post('laporan-kegiatan', 'laporan_kegiatanController@storeLaporanKegiatan');
	Route::get('laporan-kegiatan/{id}/edit', 'laporan_kegiatanController@editLaporanKegiatan');
	Route::post('laporan-kegiatan/{id}', 'laporan_kegiatanController@updateLaporanKegiatan');
	Route::delete('laporan-kegiatan/{id}', 'laporan_kegiatanController@destroyLaporanKegiatan');
	Route::post('laporan-kegiatan/detail/{id}', 'laporan_kegiatanController@detailLaporanKegiatan');

	//Route::resource('laporan-kegiatan/realisasi', 'realisasikegiatanController')->except(['show']);
	// Route::get('laporan-kegiatan/realisasi/{id}', 'realisasi_kegiatanController@index')->name('lapkeg.index');
	Route::get('laporan-kegiatan/realisasi/{id}/create', 'realisasi_kegiatanController@create');
	Route::post('laporan-kegiatan/realisasi/{id}', 'realisasi_kegiatanController@store')->name('lapkeg.store');
	Route::get('laporan-kegiatan/realisasi/{id}/edit', 'realisasi_kegiatanController@edit');
	Route::patch('laporan-kegiatan/realisasi/{id}', 'realisasi_kegiatanController@update');
	Route::delete('laporan-kegiatan/realisasi/{id}', 'realisasi_kegiatanController@destroy')->name('lapkeg.delete');

	// //cetak realisasi
	// Route::get('realisasi-cetak/{id}', 'realisasi_kegiatanController@realisasi_kegiatanCetak');
	// Route::get('/realisasi-cetak/excel', 'realisasi_kegiatanController@realisasi_kegiatanExcel')->name('realisasi_kegiatanExcel');


	// jurnal digabung
	Route::get('jurnal', 'JurnalController@showJurnal');
	Route::get('jurnal/create', 'JurnalController@formJurnal');
	Route::get('jurnal/detail/{waktu}', 'JurnalController@detailJurnal');
	Route::post('jurnal', 'JurnalController@storeJurnal');
	Route::get('jurnal/{id}/edit', 'JurnalController@editJurnal');
	Route::patch('jurnal/{id}', 'JurnalController@updateJurnal');
	Route::delete('jurnal/{id}', 'JurnalController@destroyJurnal');
	Route::get('jurnal/cari', 'JurnalController@cariJurnal');

	// buku besar
	Route::get('buku-besar', 'AkuntansiController@showBukuBesar');
	Route::get('buku-besar/{id}', 'AkuntansiController@akunBukuBesar');
	Route::get('buku-besar/{id}/cari', 'AkuntansiController@cariBukuBesar');
	Route::get('buku-besar/{id}/{waktu}', 'AkuntansiController@detailBukuBesar');

	// // neraca saldo
	// Route::get('neraca-saldo', 'AkuntansiController@showNeracaSaldo');
	// Route::get('neraca-saldo/cari', 'AkuntansiController@cariNeracaSaldo');
	// Route::get('neraca-saldo/detail/{waktu}', 'AkuntansiController@detailNeracaSaldo');

	// // neraca lajur
	// Route::get('neraca-lajur', 'AkuntansiController@showNeracaLajur');
	// Route::get('neraca-lajur/cari', 'AkuntansiController@cariNeracaLajur');
	// Route::get('neraca-lajur/detail/{waktu}', 'AkuntansiController@detailNeracaLajur');

	// nssd
	Route::get('nssd', 'NssdController@showNssd');
	//Route::get('neraca/cari', 'NeracaController@cariNeraca');
	Route::get('nssd/detail/{waktu}', 'NssdController@detailNssd');

	// neraca saldo 2
	Route::get('neraca', 'NeracaController@showNeraca');
	//Route::get('neraca/cari', 'NeracaController@cariNeraca');
	Route::get('neraca/detail/{waktu}', 'NeracaController@detailNeraca');

	// // laba rugi
	// Route::get('labarugi', 'LabarugiController@showLabarugi');
	// //Route::get('neraca/cari', 'NeracaController@cariNeraca');
	// Route::get('labarugi/detail/{waktu}', 'LabarugiController@detailLabarugi');
	// Route::get('cetak-labarugi/{waktu}', 'LabarugiController@cetakLabaRugi');
	// Route::get('cetak-labarugi/excel/{waktu}', 'LabarugiController@labarugi_excel');


	// // neraca laporan
	// Route::get('neraca-laporan', 'NeracaLaporanController@showNeracaLaporan');
	// //Route::get('neraca/cari', 'NeracaController@cariNeraca');
	// Route::get('neraca-laporan/detail/{waktu}', 'NeracaLaporanController@detailNeracaLaporan');
	// Route::get('cetak-neraca-laporan/{waktu}', 'NeracaLaporanController@cetakNeracaLaporan');
	// Route::get('cetak-neraca-laporan/excel/{waktu}', 'NeracaLaporanController@neraca_laporan_excel');

	//laporan
	Route::get('laporan', 'AkuntansiController@showLaporan');
	Route::get('laporan/cetak/{waktu}', 'AkuntansiController@cetakLaporan');

	Route::get('tes', 'AkuntansiController@tes');

	Route::get('cetak-neraca/{waktu}', 'AkuntansiController@cetakNeracaSaldo');

	
});

Route::group(['middleware' => ['permission:transaksi-list|transaksi-detail']], function() {

	//index transaksi pemasukan dan pengeluaran
	Route::get('transaksi','Transaksi_pemasukanController@index');
	Route::get('transaksi','Transaksi_pengeluaranController@index');

	Route::get('/transaksi/detailPemasukan/{id}','Transaksi_pemasukanController@show');
	Route::get('/transaksi/detailPengeluaran/{id}','Transaksi_pengeluaranController@show');

	//dokumen laporan 
	Route::get('/dokumen-laporan/', 'Dokumen_laporanController@index');
	Route::get('/dokumen-laporan/{id}', 'Dokumen_laporanController@show');
	Route::get('/dokumen-laporan/download/{file}', 'Dokumen_laporanController@download');
	Route::get('/dokumen-laporan/hapus/{id}','Dokumen_laporanController@destroy');
});

//laporan kegiatan
Route::group(['middleware' => ['permission:laporan-kegiatan-list']], function() {
	Route::get('laporan-kegiatan', 'laporan_kegiatanController@showLaporanKegiatan');
	Route::get('laporan-kegiatan/realisasi/{id}', 'realisasi_kegiatanController@index')->name('lapkeg.index');
	//cetak realisasi
	Route::get('realisasi-cetak/{id}', 'realisasi_kegiatanController@realisasi_kegiatanCetak');
	Route::get('/realisasi-cetak/excel', 'realisasi_kegiatanController@realisasi_kegiatanExcel')->name('realisasi_kegiatanExcel');

});

//Halaman menu utama benharian dan manajer
Route::group(['middleware' => ['permission:halaman-benharian']], function() {

	Route::get('/benharian','benharianController@index');
	Route::post('benharian/pilihTahun/','benharianController@pilihTahun')->name('pilih-tahun');
	
});

//Halaman labarugi dan neraca-laporan
Route::group(['middleware' => ['permission:labarugi|neraca-laporan']], function() {
	// laba rugi
	Route::get('labarugi', 'LabarugiController@showLabarugi');
	//Route::get('neraca/cari', 'NeracaController@cariNeraca');
	Route::get('labarugi/detail/{waktu}', 'LabarugiController@detailLabarugi');
	Route::get('cetak-labarugi/{waktu}', 'LabarugiController@cetakLabaRugi');
	Route::get('cetak-labarugi/excel/{waktu}', 'LabarugiController@labarugi_excel');

	// // neraca laporan
	Route::get('neraca-laporan', 'NeracaLaporanController@showNeracaLaporan');
	//Route::get('neraca/cari', 'NeracaController@cariNeraca');
	Route::get('neraca-laporan/detail/{waktu}', 'NeracaLaporanController@detailNeracaLaporan');
	Route::get('cetak-neraca-laporan/{waktu}', 'NeracaLaporanController@cetakNeracaLaporan');
	Route::get('cetak-neraca-laporan/excel/{waktu}', 'NeracaLaporanController@neraca_laporan_excel');
});

	//laporan
	Route::get('laporan', 'AkuntansiController@showLaporan');
	Route::get('laporan/cetak/{waktu}', 'AkuntansiController@cetakLaporan');

	Route::get('tes', 'AkuntansiController@tes');

	Route::get('cetak-neraca/{waktu}', 'AkuntansiController@cetakNeracaSaldo');


Route::view('/home', 'home')->middleware('auth');



