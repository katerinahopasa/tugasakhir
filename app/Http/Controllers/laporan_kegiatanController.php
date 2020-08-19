<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LaporanKegiatanRequest;
use App\Laporan_kegiatan;
use App\Jenis_pendapatan  as JP;
use App\Jenis_pengeluaran as JPR;
use App\Pendapatan_kegiatan;
use App\Pengeluaran_kegiatan;
use App\Realisasi_kegiatan;
use Session;
use DB;
use Auth;
use Carbon\Carbon;


class laporan_kegiatanController extends Controller
{
    public function showLaporanKegiatan()
    {
        $realisasi_kegiatan = Realisasi_kegiatan::pluck('id');
        $laporan_kegiatan = \DB::table('laporan_kegiatan')->orderBy('tgl_kegiatan', 'ASC')->get();
        
        return view('benadventure.laporan-kegiatan.laporan-kegiatan',  compact('laporan_kegiatan'));
    }

    public function realisasiLaporanKegiatan(Request $request, $id)
    {
        // mengambil data berdasarkan id yang dipilih
        $laporan_kegiatan = laporan_kegiatan::find($id);

        $daftar_jenispendapatan = JP::pluck('nama_jenis', 'id');
        $daftar_jenispengeluaran = JPR::pluck('nama_jenis', 'id');

        $pendapatan_kegiatan = Pendapatan_kegiatan::all();
        $pengeluaran_kegiatan = Pengeluaran_kegiatan::all();
        $jp = JP::all();
        $jpr = JPR::all();

        $total_pendapatan = Pendapatan_kegiatan::sum('nominal');
        $total_pengeluaran = Pengeluaran_kegiatan::sum('nominal');

        $pendapatan = Pendapatan_kegiatan::orderBy('id','desc');

        return view('benadventure.laporan-kegiatan.laporan-kegiatan-realisasi',  compact('laporan_kegiatan','daftar_jenispendapatan','daftar_jenispengeluaran','pendapatan_kegiatan','pengeluaran_kegiatan','jp','jpr','pendapatan','total_pendapatan','total_pengeluaran'));
    }

    public function cariLaporanKegiatan(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        $waktu = $tahun.'-'.$bulan.'-01';
        $periode = date('d F Y', strtotime($waktu));

        if(empty($bulan) || empty($tahun)) return redirect('laporan-kegiatan');

        $daftar_laporan = Laporan_kegiatan::whereMonth('tgl_kegiatan', $bulan)->whereYear('tgl_kegiatan', $tahun)->orderBy('tgl_kegiatan', 'asc')->get();
        
        $total_laba = Laporan_kegiatan::where('tipe', 'd')->whereMonth('tgl_kegiatan', $bulan)->whereYear('tgl_kegiatan', $tahun)->orderBy('tgl_kegiatan', 'asc')->sum('nominal');
        
        $total_laporan = $daftar_laporan->count();
        
        if(!($total_laporan)) return redirect('laporan-kegiatan')->with('pesan', "Laporan Kegiatan dengan Periode $bulan-$tahun tidak ditemukan");

        return view('benadventure.laporan-kegiatan.laporan-kegiatan',  compact('daftar_laporan', 'total_laporan', 'periode', 'total_debet', 'total_kredit'));
    }

    public function formLaporanKegiatan()
    {
        $daftar_jenispendapatan = JP::pluck('nama_jenis', 'id');
        $daftar_jenispengeluaran = JPR::pluck('nama_jenis', 'id');

        $pendapatan_kegiatan = Pendapatan_kegiatan::all();
        $pengeluaran_kegiatan = Pengeluaran_kegiatan::all();
        $jp = JP::all();
        $jpr = JPR::all();

        $total_pendapatan = Pendapatan_kegiatan::sum('nominal');
        $total_pengeluaran = Pengeluaran_kegiatan::sum('nominal');

        $pendapatan = Pendapatan_kegiatan::orderBy('id','desc');

        return view('benadventure.laporan-kegiatan.laporan-kegiatan-tambah', compact('daftar_jenispendapatan','daftar_jenispengeluaran','pendapatan_kegiatan','pengeluaran_kegiatan','total_pendapatan','total_pengeluaran','jp','jpr','pendapatan'));
    }

    public function storeLaporanKegiatan(LaporanKegiatanRequest $request)
    {
        Laporan_kegiatan::create($request->all());
        DB::table('notifications')->insert([
            'user_id' => Auth::user()->id,
            'tipe' => 'laporan Kegiatan',
            'pesan' => 'telah menginputkan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Session::flash('pesan', 'Data Kegiatan Berhasil Disimpan');
        return redirect('laporan-kegiatan');
    }

    public function editLaporanKegiatan($id)
    {
        $laporan_kegiatan = Laporan_kegiatan::findOrFail($id);
        return view('benadventure.laporan-kegiatan.laporan-kegiatan-edit', compact('laporan_kegiatan'));   
    }

    public function updateLaporanKegiatan(LaporanKegiatanRequest $request, $id)
    {
        $laporan_kegiatan = Laporan_kegiatan::findOrFail($id);
        $laporan_kegiatan->update($request->all());
        Session::flash('pesan', 'Data Kegiatan Berhasil Diupdate');
        return redirect('laporan-kegiatan');
    }

    public function destroyLaporanKegiatan($id)
    {
        Laporan_kegiatan::destroy($id);
        Session::flash('pesan', 'Data Kegiatan Berhasil Dihapus');
        return redirect('laporan-kegiatan');   
    }
}