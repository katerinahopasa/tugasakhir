<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;
use DB;

class benharianController extends Controller
{
    public function index()
    {
        $total_pemasukan = Pemasukan::sum('total_pemasukan');
        $total_pengeluaran = Pengeluaran::sum('nominal');
        $saldo = $total_pemasukan - $total_pengeluaran;
        return view('benharian.benharian',['title'=>'benharian','pemasukan'=>$total_pemasukan,'pengeluaran'=>$total_pengeluaran,'saldo'=>$saldo]);
    }
    
    public function pilihTahun(Request $req)
    {

        $total_pemasukan = Pemasukan::sum('total_pemasukan');
        $total_pengeluaran = Pengeluaran::sum('nominal');
        $saldo = $total_pemasukan - $total_pengeluaran;

        for ($bulan=1; $bulan <=12 ; $bulan++) { 
             $pemasukan_perbulan[] = DB::table('pemasukan')
                                    ->select(DB::raw('SUM(total_pemasukan) as total'))
                                    ->whereMonth('tanggal',$bulan)
                                    ->whereYear('tanggal',$req->tahun)
                                    ->first();

             $pengeluaran_perbulan[] = DB::table('pengeluaran')
                                    ->select(DB::raw('SUM(nominal) as total'))
                                    ->whereMonth('tanggal',$bulan)
                                    ->whereYear('tanggal',$req->tahun)
                                    ->first();

             $jml_pengunjung_perbulan[] = DB::table('pemasukan')
                                    ->select(DB::raw('SUM(jml_pengunjung) as total'))
                                    ->whereMonth('tanggal',$bulan)
                                    ->whereYear('tanggal',$req->tahun)
                                    ->first();
        }
       
    	
        return view('benharian.benharian_search',['title'=>'benharian','pemasukan'=>$total_pemasukan,'pengeluaran'=>$total_pengeluaran,'saldo'=>$saldo,'pemasukan_perbulan'=>$pemasukan_perbulan,'pengeluaran_perbulan'=>$pengeluaran_perbulan,'jml_pengunjung_perbulan'=>$jml_pengunjung_perbulan,'tahun_pilihan'=>$req->tahun]);
    }
}
