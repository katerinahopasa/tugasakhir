<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumen_laporan;
use DataTables;

class Dokumen_laporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $file = Dokumen_laporan::all();
        return view('benharian.dokumen-laporan.index', compact('file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('benharian.dokumen-laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Dokumen_laporan;
        if($request->file('file')){
            $file = $request->file;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $data->file = $filename;
        }
        $data->judul_dokumen=$request->judul_dokumen;
        $data->deskripsi=$request->deskripsi;
        $data->save();

        return redirect('dokumen-laporan')->with('sukses','Data Berhasil diupload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Dokumen_laporan::find($id);
        return view('benharian.dokumen-laporan.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function download($file) 
    {
        return response()->download('storage/'.$file);
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dokumen_laporan::where('id', $id)->delete();
        //dd(Pemasukan::find($id));
        return redirect ('/dokumen-laporan')->with('sukses','Data Berhasil dihapus');
    }
}
