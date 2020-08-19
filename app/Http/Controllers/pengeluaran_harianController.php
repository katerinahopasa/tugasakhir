<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengeluaran;
use App\pemasukan;
use DB;

class pengeluaran_harianController extends Controller
{

	public function index(Request $request)
    {   
        if($request->has('_token')){
            $pemasukan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();
            $pengeluaran = Pengeluaran::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();
            $caption = 'Tanggal '.date('d F Y',strtotime($request->mulai)).' - '.date('d F Y',strtotime($request->akhir));
        }else{
            $pemasukan = Pemasukan::whereMonth('tanggal','=',date('m'))->orderBy('tanggal', 'ASC')->get();
            $pengeluaran = Pengeluaran::whereMonth('tanggal','=',date('m'))->orderBy('tanggal', 'ASC')->get();
            $caption = 'Bulan '.date('F');
        }
        $total_masuk = Pemasukan::sum('total_pemasukan');
        $total_keluar = Pengeluaran::sum('nominal');
        $saldo = $total_masuk - $total_keluar;

        $total_datapengeluaran = $pengeluaran->count();
        $total_datapemasukan = $pemasukan->count();
        
        $total_masukperbulan = $pemasukan->sum('total_pemasukan');

        //$total_masukperbulan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->sum('total_pemasukan');

        return view('benharian.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'total_datapengeluaran'=>$total_datapengeluaran,'total_datapemasukan'=>$total_datapemasukan,'total_masuk'=>$total_masuk,'total_masukperbulan'=>$total_masukperbulan]);
    }

    public function tambah()
    {
        return view('benharian.transaksi-tambahpengeluaran');
    }

    public function store(Request $request)
    {
       $pengeluaran = new pengeluaran();

       $pengeluaran->id = \Uuid::generate(4);
       $pengeluaran->tanggal = date('Y-m-d',strtotime($request->input('tanggal')));
       $pengeluaran->nama_pengeluaran = $request->input('nama_pengeluaran');
       $pengeluaran->nominal = $request->input('nominal');
       $pengeluaran->keterangan = $request->input('keterangan');

       if ($request->hasfile('bukti_pembayaran')) 
       {
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/pengeluaranharian/',$filename);
            $pengeluaran->bukti_pembayaran = $filename;

       } else {
            return $request;
            $pengeluaran->bukti_pembayaran = '';
       }

       $pengeluaran->save();

       return redirect('transaksi')->with('transaksi',$pengeluaran);
    }

    public function edit($id)
    {
        // mengambil data books berdasarkan id yang dipilih
        $pengeluaran = pengeluaran::find($id);
        // passing data books yang didapat ke view edit.blade.php
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

       // $this->validate($request,[
       //     'tanggal'=>'required',
       //     'nama_pengeluaran'=>'required',
       //     'nominal'=>'required',
       //     'keterangan'=>'required'
      //  ]);

       // \DB::table('pengeluaran')->where('id',$id)->update([
       //     'tanggal'=>date('Y-m-d',strtotime($request->input('tanggal'))),
       //     'nama_pengeluaran'=>$request->nama_pengeluaran,
       //     'nominal'=>$request->nominal,
        //    'keterangan'=>$request->keterangan
      //  ]);

        return redirect('transaksi');
    }

    //public function update(Request $request,$id)
    //{
    //    $pengeluaran = pengeluaran::find($id);
    //    $pengeluaran->update($request->all());
    //    return redirect ('/transaksi')->with('sukses','Data Berhasil diupdate'); 
    //}

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

}