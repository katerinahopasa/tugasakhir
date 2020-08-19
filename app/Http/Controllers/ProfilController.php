<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfilRequest;
use App\Profil;
use Session;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::findOrFail(1);
        return view('admin.profil.index', compact('profil'));
    }

    public function create()
    {
        return view('admin.profil.create');
    }

    public function store(ProfilRequest $request)
    {
        Profil::create($request->all());
        Session::flash('pesan', 'Profil Berhasil Disimpan');
        return redirect('profil');
    }

    public function edit(Profil $profil)
    {
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(ProfilRequest $request, Profil $profil)
    {
        $profil->update($request->all());
        Session::flash('pesan', 'Profil Berhasil Diupdate');
        return redirect('profil');
    }

    public function destroy(Profil $profil)
    {
        $profil->delete();
        Session::flash('pesan', 'Profil Berhasil Dihapus');
        return redirect('profil');
    }

}
