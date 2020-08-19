<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estimasiakhirlaporan;

class testController extends Controller
{
    public function index(Request $request)
    {
    	$mulai = date('Y-m-d',strtotime($request->mulai));
        $selesai = date('Y-m-d',strtotime($request->selesai));
        $pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $total_pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        $total_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');
        $total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;

        // mempersiapkan data untuk jexcel
        $items = Estimasiakhirlaporan::all(['nama_pembagian', 'persentase','nominal']);

        return view('benharian.laporan.test', compact('items','pemasukan','pengeluaran','total_pemasukan','total_pengeluaran','total_pemasukan_bersih','mulai','selesai'));
    }
}
