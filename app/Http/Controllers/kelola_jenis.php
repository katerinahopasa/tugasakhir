<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis_pendapatan as JP;
use App\Jenis_pengeluaran as JPR;

class kelola_jenis extends Controller
{
    public function index()
    {
        $list_jenis_pendapatan = JP::all();
        $list_jenis_pengeluaran = JPR::all();

        return view('benadventure.kelola-jenis',['list_jenis_pendapatan'=>$list_jenis_pendapatan, 'list_jenis_pengeluaran'=>$list_jenis_pengeluaran ]);
    }

    public function create()
    {
        //
    }

    
    public function show(Request $request, $id)
    {
        try{
            $request->validate([
                'tipe' => 'required'
            ]);
            if($request->tipe=='pendapatan'){
                $jenis = JP::find($id);
            }elseif($request->tipe=='pengeluaran'){
                $jenis = JPR::find($id);
            }else{
                $jenis = false;
            }
            return $jenis;
        }catch(\Exception $e){
            return false;
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'tipe' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required'
        ]);
        if($request->tipe=='pendapatan'){
            $store = new JP;
        }else{
            $store = new JPR;
        }

        $store->nama_jenis = $request->jenis;
        $store->deskripsi = $request->deskripsi;
        $store->save();
        return redirect('kelola-jenis');
    }
    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'tipe' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required'
        ]);
        try{
            if($request->tipe=='pendapatan'){
                $update = JP::find($id);
            }else{
                $update = JPR::find($id);
                
            }

            $update->nama_jenis = $request->jenis;
            $update->deskripsi = $request->deskripsi;
            $update->save();
            $alert = "Berhasil";
        }catch(\Exception $e){
            $alert = "Gagal";
        }        
        return redirect('kelola-jenis')->with('alert',$alert);
    }

    
    public function destroy(Request $request, $id)
    {
        $validation = $request->validate([
            'tipe'=>'required'
        ]);
        if($request->tipe=='pendapatan'){
            try{
                JP::destroy($id);
                $alert = 'Berhasil';
            }catch(\Exception $e){
                $alert = 'Gagal';
            }    
            return back()->with('alert',$alert);     
        }else{
            try{
                JPR::destroy($id);
                $alert = 'Berhasil';
            }catch(\Exception $e){
                $alert = 'Gagal';
            } 
            return back()->with('alert',$alert);           
        }
    }
}
