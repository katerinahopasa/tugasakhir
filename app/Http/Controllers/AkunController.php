<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AkunRequest;
use App\Akun;
use Session;

class AkunController extends Controller
{
    public function index()
    {
        $daftar_akun = Akun::all();
        $total_akun = $daftar_akun->count();
        return view('benadventure.akun.index', compact('daftar_akun', 'total_akun'));
    }

    public function create()
    {
        return view('benadventure.akun.form');
    }

    public function store(AkunRequest $request)
    {
        Akun::create($request->all());
        Session::flash('pesan', 'Rekening Berhasil Ditambahkan');
        return redirect('akun');
    }

    public function edit(Akun $akun)
    {
        return view('benadventure.akun.edit', compact('akun'));
    }

    public function update(AkunRequest $request, Akun $akun)
    {
        $akun->update($request->all());
        Session::flash('pesan', 'Rekening Berhasil Diupdate');
        return redirect('akun');
    }

    public function destroy(Akun $akun)
    {
        $akun->delete();
        Session::flash('pesan', 'Rekening Berhasil Dihapus');
        return redirect('akun');
    }
}
