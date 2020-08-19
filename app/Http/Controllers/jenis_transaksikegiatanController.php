<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis_transaksikegiatan;

class jenis_transaksikegiatanController extends Controller
{
    public function index()
    {
        $list_jenis_transaksikegiatan = Jenis_transaksikegiatan::all();

        return view('benadventure..kelola-jenistransaksi.kelola-jenistransaksi',['list_jenis_transaksikegiatan'=>$list_jenis_transaksikegiatan]);
    }

    public function tambah()
    {
        return view('benadventure.kelola-jenistransaksi.kelola-jenistransaksi-tambah');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama_jenis'=>'required',
            'deskripsi'=>'required'
        ]);

        $nama_jenis = $request->nama_jenis;
        $deskripsi = $request->deskripsi;

        \DB::table('jenis_transaksikegiatan')->insert([
            'nama_jenis'=>$nama_jenis,
            'deskripsi'=>$deskripsi
        ]);

        return redirect('kelola-jenistransaksi');
    }

    public function edit($id)
    {
        // mengambil data berdasarkan id yang dipilih
        $jenis_transaksikegiatan = Jenis_transaksikegiatan::find($id);
        // passing data yang didapat ke view edit.blade.php
        return view('benadventure.kelola-jenistransaksi.kelola-jenistransaksi-edit', compact('jenis_transaksikegiatan'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nama_jenis'=>'required',
            'deskripsi'=>'required'
        ]);

        \DB::table('jenis_transaksikegiatan')->where('id',$id)->update([
            'nama_jenis'=>$request->nama_jenis,
            'deskripsi'=>$request->deskripsi
        ]);

        return redirect('kelola-jenistransaksi');
    }

    public function delete(Request $request,$id)
    {
        Jenis_transaksikegiatan::where('id', $id)->delete();
        return redirect ('/kelola-jenistransaksi')->with('sukses','Data Berhasil dihapus');
    }
}
