<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JurnalsRequest;
use App\Jurnals;
use App\Akun;
use Session;
use DB;
use Auth;
use Carbon\Carbon;
use Crabbly\FPDF\FPDF as FPDF;

class JurnalController extends Controller
{
     // jurnal umum
    public function showJurnal()
    {
        $daftar_jurnals = Jurnals::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_jurnals = $daftar_jurnals->count();
        
        return view('benadventure.jurnal.jurnal',  compact('daftar_jurnals', 'total_jurnals'));
    }

    public function detailJurnal(Request $request, $waktu)
    {
        if(empty($waktu)) return redirect('jurnal');
        
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $daftar_jurnals = Jurnals::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->get();

        $total_debet = Jurnals::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');

        $total_kredit = Jurnals::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');
        
        $total_jurnals = $daftar_jurnals->count();

        return view('benadventure.jurnal.jurnal-detail',  compact('daftar_jurnals', 'total_jurnals', 'periode', 'total_debet', 'total_kredit'));
    }
    
    public function cariJurnalUmum(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        $waktu = $tahun.'-'.$bulan.'-01';
        $periode = date('F Y', strtotime($waktu));

        if(empty($bulan) || empty($tahun)) return redirect('jurnal-umum');

        $daftar_jurnal = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->get();
        
        $total_debet = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');
        
        $total_kredit = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');
        
        $total_jurnal = $daftar_jurnal->count();
        
        if(!($total_jurnal)) return redirect('jurnal-umum')->with('pesan', "Jurnal Umum dengan Periode $bulan-$tahun tidak ditemukan");

        return view('benadventure.jurnal-umum.jurnal-umum-detail',  compact('daftar_jurnal', 'total_jurnal', 'periode', 'total_debet', 'total_kredit'));
    }

    public function formJurnal()
    {
        $daftar_akun = Akun::pluck('nama_akun', 'id');
        return view('benadventure.jurnal.form-jurnal', compact('daftar_akun'));
    }

    public function storeJurnal(JurnalsRequest $request)
    {
        Jurnals::create($request->all());
        DB::table('notifications')->insert([
            'user_id' => Auth::user()->id,
            'tipe' => 'jurnal',
            'pesan' => 'telah menginputkan transaksi',
            'id_tambahan' =>0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Session::flash('pesan', 'Transaksi Berhasil Disimpan');
        return redirect('jurnal');
    }

    public function editJurnal($id)
    {
        $daftar_akun = Akun::pluck('nama_akun', 'id');
        $jurnal = Jurnals::findOrFail($id);
        return view('benadventure.jurnal.edit-jurnal', compact('jurnal', 'daftar_akun'));   
    }

    public function updateJurnal(JurnalsRequest $request, $id)
    {
        $jurnal = Jurnals::findOrFail($id);
        $jurnal->update($request->all());
        Session::flash('pesan', 'Transaksi Berhasil Diupdate');
        return redirect('jurnal');
    }

    public function destroyJurnal($id)
    {
        Jurnals::destroy($id);
        Session::flash('pesan', 'Transaksi Berhasil Dihapus');
        return redirect('jurnal');   
    }
}
