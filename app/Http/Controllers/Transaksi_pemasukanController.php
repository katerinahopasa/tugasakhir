<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use Carbon\Carbon;

class Transaksi_pemasukanController extends Controller
{
    public function index(Request $request)
    {   
        if($request->has('_token')){
             $awal = explode('-', $request->mulai);
             $akhir= explode('-', $request->akhir);

             $stringawal = $awal[0].'-'.$awal[1].'-'.'1';
             $stringakhir = $akhir[0].'-'.$akhir[1].'-'.'15';


            $pemasukan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();
            $pengeluaran = Pengeluaran::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();
            $caption = 'Tanggal '.date('d F Y',strtotime($request->mulai)).' - '.date('d F Y',strtotime($request->akhir));
            //$datapemasukan = Pemasukan::whereMonth('tanggal','=',date('Y-m-01'))->get();
            $datapemasukan2 = Pemasukan::whereDate('tanggal','>=',$stringawal)->whereDate('tanggal','<=',$stringakhir)->get();
        }else{
            $pemasukan = Pemasukan::whereMonth('tanggal','=',date('m'))->get();
            $pengeluaran = Pengeluaran::whereMonth('tanggal','=',date('m'))->get();
            $caption = 'Bulan '.date('F');
            //$datapemasukan = Pemasukan::whereMonth('tanggal','=',date('Y-m-01'))->get();
            $datapemasukan2 = Pemasukan::whereDate('tanggal','>=',date('Y-m-01'))->whereDate('tanggal','<=',date('Y-m-15'))->get();
        }
        $total_masuk = Pemasukan::sum('total_pemasukan');
        $total_keluar = Pengeluaran::sum('nominal');
        $saldo = $total_masuk - $total_keluar;

        $total_datapemasukan = $pemasukan->count();
        $total_datapengeluaran = $pengeluaran->count();

        $total_masukperbulan = $pemasukan->sum('total_pemasukan');
        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');
        $transaksipemasukan = Pemasukan::all();
        $transaksipengeluaran = Pengeluaran::all();

        //$from = $datapemasukan;
        //$to = $datapemasukan2;

        //$from = date('Y-m-01');
        //$to = date('Y-m-15');

        //$data = Pemasukan::whereBetween('tanggal', [$from, $to])->sum('total_pemasukan');

        $data = $datapemasukan2->sum('total_pemasukan');
        
        $g = '40';
        $h = '100';
        $i = $g/$h;
        $setoran1 = $data*$i;

        $a = '80';
        $b = '100';
        $c = $a/$b;
        $d = '2';
        $e = $c*$total_masukperbulan;
        $f = $e/$d;
        $setoran2 = $f-$setoran1;

        return view('benharian.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'total_datapemasukan'=>$total_datapemasukan,'total_datapengeluaran'=>$total_datapengeluaran,'total_masuk'=>$total_masuk,'total_masukperbulan'=>$total_masukperbulan,'setoran1'=>$setoran1,'setoran2'=>$setoran2,'datapemasukan2'=>$datapemasukan2,'transaksipemasukan'=>$transaksipemasukan,'transaksipengeluaran'=>$transaksipengeluaran]);
    }

    public function tambah()
    {
        return view('benharian.transaksi-tambahpemasukan');
    }

    public function store(Request $request){
        $this->validate($request,[
            'tanggal'=>'required',
            'jml_pengunjung'=>'required',
            'harga_tiket'=>'required',
            'total_pemasukan'=>'required'
        ]);

        $tanggal = date('Y-m-d',strtotime($request->input('tanggal')));
        $jml_pengunjung = $request->jml_pengunjung;
        $harga_tiket = $request->harga_tiket;
        $total_pemasukan = $request->total_pemasukan;
        $keterangan = $request->keterangan;

        \DB::table('pemasukan')->insert([
            'tanggal'=>$tanggal,
            'jml_pengunjung'=>$jml_pengunjung,
            'harga_tiket'=>$harga_tiket,
            'total_pemasukan'=>$total_pemasukan,
            'keterangan'=>$keterangan
        ]);

        DB::table('notifications')->insert([
            'user_id' => Auth::user()->id,
            'tipe' => 'pemasukan',
            'pesan' => 'telah menginputkan transaksi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('transaksi');
    }
 
    public function edit($id)
    {
        // mengambil data berdasarkan id yang dipilih
        $pemasukan = Pemasukan::find($id);
       // $permission = Permission::get();
        // passing data yang didapat ke view edit.blade.php
        return view('benharian.transaksi-editPemasukan', compact('pemasukan'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'tanggal'=>'required',
            'jml_pengunjung'=>'required',
            'harga_tiket'=>'required',
            'total_pemasukan'=>'required',
            'keterangan'=>'required'
        ]);

        \DB::table('pemasukan')->where('id',$id)->update([
            'tanggal'=>date('Y-m-d',strtotime($request->input('tanggal'))),
            'jml_pengunjung'=>$request->jml_pengunjung,
            'harga_tiket'=>$request->harga_tiket,
            'total_pemasukan'=>$request->total_pemasukan,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect('transaksi');
    }

    public function delete(Request $request,$id)
    {
        Pemasukan::where('id', $id)->delete();
        //dd(Pemasukan::find($id));
        return redirect ('/transaksi')->with('sukses','Data Berhasil dihapus');
    }

    public function show($id)
    {
        $pemasukan = Pemasukan::find($id);
        return view('benharian.transaksi-detail-pemasukan',compact('pemasukan'));
    }
}
