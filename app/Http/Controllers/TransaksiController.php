<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;
use DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {   
        if($request->has('_token')){
            $pemasukan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();
            $pengeluaran = Pengeluaran::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();
            $caption = 'Tanggal '.date('d F Y',strtotime($request->mulai)).' - '.date('d F Y',strtotime($request->akhir));
        }else{
            $pemasukan = Pemasukan::whereMonth('tanggal','=',date('m'))->get();
            $pengeluaran = Pengeluaran::whereMonth('tanggal','=',date('m'))->get();
            $caption = 'Bulan '.date('F');
        }
        $total_masuk = Pemasukan::sum('total_pemasukan');
        $total_keluar = Pengeluaran::sum('nominal');
        $saldo = $total_masuk - $total_keluar;

        $total_datapemasukan = $pemasukan->count();
        $total_datapengeluaran = $pengeluaran->count();

        $total_masukperbulan = $pemasukan->sum('total_pemasukan');

        //$total_masukperbulan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->sum('total_pemasukan');

        return view('benharian.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'total_datapemasukan'=>$total_datapemasukan,'total_datapengeluaran'=>$total_datapengeluaran,'total_masuk'=>$total_masuk,'total_masukperbulan'=>$total_masukperbulan]);
    }

    public function tambah()
    {
       // $pemasukan = \DB::table('pemasukan')->get();
       // $pengeluaran = \DB::table('pengeluaran')->get();

        return view('benharian.transaksi-tambahpemasukan');
    }

    public function store(Request $request){
        $this->validate($request,[
            'tanggal'=>'required',
            'jml_pengunjung'=>'required',
            'harga_tiket'=>'required',
            'total_pemasukan'=>'required',
            'keterangan'=>'required'
        ]);

        $tanggal = date('Y-m-d',strtotime($request->input('tanggal')));
        $jml_pengunjung = $request->jml_pengunjung;
        $harga_tiket = $request->harga_tiket;
        $total_pemasukan = $request->total_pemasukan;
        $keterangan = $request->keterangan;

        \DB::table('pemasukan')->insert([
            'id'=>\Uuid::generate(4),
            'tanggal'=>$tanggal,
            'jml_pengunjung'=>$jml_pengunjung,
            'harga_tiket'=>$harga_tiket,
            'total_pemasukan'=>$total_pemasukan,
            'keterangan'=>$keterangan
        ]);

        return redirect('transaksi');
    }

  //  public function store(Request $request)
  //  {
  //      $pemasukan = new pemasukan();
//
  //      $pemasukan->id=\Uuid::generate(4);
  //      $pemasukan->tanggal = date('Y-m-d',strtotime($request->input('tanggal')));
  //      $pemasukan->jml_pengunjung = $request->input('jml_pengunjung');
  //      $pemasukan->harga_tiket = $request->input('harga_tiket');
   //     $pemasukan->total_pemasukan = $request->input('total_pemasukan');
  //      $pemasukan->keterangan = $request->input('keterangan');

  //      $pemasukan->save();

 //       return redirect('transaksi')->with('transaksi',$pemasukan);
 //   }

 
     public function edit($id)
    {
        // mengambil data berdasarkan id yang dipilih
        $pemasukan = pemasukan::find($id);
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
    //public function update(Request $request, $id)
   // {
    //    $pemasukan = pemasukan::find($id);
    //    $pemasukan->update($request->all());
    //    return redirect ('/transaksi')->with('sukses','Data Berhasil diupdate'); 
    //}

    public function delete(Request $request,$id)
    {
        Pemasukan::where('id', $id)->delete();
        //dd(Pemasukan::find($id));
        return redirect ('/transaksi')->with('sukses','Data Berhasil dihapus');
    }

    public function showPemasukan(Request $request)
    {
        $total_masukperbulan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        return view('contents.transaksi.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'total_masukperbulan'=>$total_masukperbulan]);
    }
}
