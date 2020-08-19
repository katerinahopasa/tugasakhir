<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class estimasiController extends Controller
{
	public function index(Request $request) 
	{
		$total_masukperbulan = Pemasukan::whereDate('tanggal','>=',$request->mulai)->whereDate('tanggal','<=',$request->akhir)->orderBy('tanggal', 'ASC')->get();

		return view('contents.transaksi.list_transaksi', compact('total_masukperbulan'));
	}
    
}
