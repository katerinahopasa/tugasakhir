<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengeluaran;
use App\pemasukan;
use DB;
use Auth;
use Carbon\Carbon;

class Transaksi_pengeluaranController extends Controller
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
            $pemasukan = Pemasukan::whereMonth('tanggal','=',date('m'))->orderBy('tanggal', 'ASC')->get();
            $pengeluaran = Pengeluaran::whereMonth('tanggal','=',date('m'))->orderBy('tanggal', 'ASC')->get();
            $caption = 'Bulan '.date('F');
            //$datapemasukan = Pemasukan::whereMonth('tanggal','=',date('Y-m-01'))->get();
            $datapemasukan2 = Pemasukan::whereDate('tanggal','>=',date('Y-m-01'))->whereDate('tanggal','<=',date('Y-m-15'))->get();
        }
        $total_masuk = Pemasukan::sum('total_pemasukan');
        $total_keluar = Pengeluaran::sum('nominal');
        $saldo = $total_masuk - $total_keluar;

        $total_datapengeluaran = $pengeluaran->count();
        $total_datapemasukan = $pemasukan->count();
        
        $total_masukperbulan = $pemasukan->sum('total_pemasukan');
        $bulan = date('m');
        $tahun = date('Y');
        $transaksipemasukan = Pemasukan::all();
        $transaksipengeluaran = Pengeluaran::all();

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

        return view('benharian.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'total_datapengeluaran'=>$total_datapengeluaran,'total_datapemasukan'=>$total_datapemasukan,'total_masuk'=>$total_masuk,'total_masukperbulan'=>$total_masukperbulan,'setoran1'=>$setoran1,'setoran2'=>$setoran2,'datapemasukan2'=>$datapemasukan2,'transaksipemasukan'=>$transaksipemasukan,'transaksipengeluaran'=>$transaksipengeluaran]);
    }

    public function tambah()
    {
        return view('benharian.transaksi-tambahpengeluaran');
    }

    public function store(Request $request)
    {
       $pengeluaran = new pengeluaran();

       $pengeluaran->tanggal = date('Y-m-d',strtotime($request->input('tanggal')));
       $pengeluaran->nama_pengeluaran = $request->input('nama_pengeluaran');
       $pengeluaran->nominal = $request->input('nominal');

       if ($request->hasfile('bukti_pembayaran')) 
       {
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/pengeluaranharian/',$filename);
            $pengeluaran->bukti_pembayaran = $filename;

       } else {
            //return $request;
            $pengeluaran->bukti_pembayaran = '';
       }

       $pengeluaran->save();

       DB::table('notifications')->insert([
            'user_id' => Auth::user()->id,
            'tipe' => 'pengeluaran',
            'pesan' => 'telah menginputkan transaksi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

       return redirect('transaksi')->with('transaksi',$pengeluaran);
    }

    public function edit($id)
    {
        $pengeluaran = pengeluaran::find($id);

        return view('benharian.transaksi-editPengeluaran', compact('pengeluaran'));
    }

    public function update(Request $request, $id){

        $pengeluaran = pengeluaran::where('id', $id)->first();
        $pengeluaran->tanggal = date('Y-m-d',strtotime($request->input('tanggal')));
        $pengeluaran->nama_pengeluaran = $request->input('nama_pengeluaran');
        $pengeluaran->nominal = $request->input('nominal');
        $pengeluaran->keterangan = $request->input('keterangan');

        if($request->hasfile('bukti_pembayaran') == "")
        {
            $pengeluaran->bukti_pembayaran = $pengeluaran->bukti_pembayaran;
        } 
        else
        {
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/pengeluaranharian/',$filename);
            $pengeluaran->bukti_pembayaran = $filename;
        }

        $pengeluaran->update();

        return redirect('transaksi');
    }

    public function delete(Request $request,$id)
    {
        Pengeluaran::where('id', $id)->delete();
        //dd(Pemasukan::find($id));
        return redirect ('/transaksi')->with('sukses','Data Berhasil dihapus'); 
    }

    public function showPengeluaran(Request $request)
    {
        $total_masukperbulan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        return view('contents.transaksi.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'total_masukperbulan'=>$total_masukperbulan]);
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return view('benharian.transaksi-detail-pengeluaran',compact('pengeluaran'));
    }

}
