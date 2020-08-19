<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan_kegiatan;
use App\Jenis_pendapatan  as JP;
use App\Jenis_pengeluaran as JPR;
use App\Pendapatan_kegiatan;
use App\Pengeluaran_kegiatan;

class tambahKegiatanController extends Controller
{
    public function index(Request $request)
    {   
        $pendapatan = Pendapatan_kegiatan::orderBy('id','desc')->pagination(8);

        return view('laporan-kegiatan.laporan-kegiatan-tambah',$pendapatan);
    }

    public function store(Request $request)
    {
        $pendapatanID = $request->post->pendapatan_id;
        $pendapatan = Pendapatan_kegiatan::updateOrCreate(
        	['id' => $pendapatanID],
        	['id_jenis' => $request->id_jenis],
        	['nominal' => $request->nominal],
        	['deskripsi' => $request->deskripsi]
    	);

    	return Response::json($pendapatan);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $pendapatan = Pendapatan_kegiatan::where($where)->first();

    	return Response::json($pendapatan);
    }

    public function destroy(Request $request, $id)
    {
        $pendapatan = Pendapatan_kegiatan::where('id',$id)->delete();

        return Response::json($pendapatan);
    }
}
