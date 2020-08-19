<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_pemasukan = Pemasukan::sum('total_pemasukan');
        $total_pengeluaran = Pengeluaran::sum('nominal');
        $saldo = $total_pemasukan - $total_pengeluaran;
        return view('benharian',['title'=>'benharian','pemasukan'=>$total_pemasukan,'pengeluaran'=>$total_pengeluaran,'saldo'=>$saldo]);
    }
}
