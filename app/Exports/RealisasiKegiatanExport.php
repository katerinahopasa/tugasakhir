<?php

namespace App\Exports;

use App\Jenis_pendapatan  as JP;
use App\Jenis_pengeluaran as JPR;
use App\Realisasi_kegiatan;
use App\Jenis_transaksikegiatan;
use App\Laporan_kegiatan;
use App\Profil;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class RealisasiKegiatanExport implements FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        $data = Laporan_kegiatan::findOrFail($id);

        $data_realisasi = Realisasi_kegiatan::where('id_laporankegiatan',$id)->get();
        $data_kegiatan = $data_realisasi;

        $realisasi_kegiatan = Realisasi_kegiatan::all();
        $jp = JP::all();
        $jpr = JPR::all();

        $total_pendapatan = Realisasi_kegiatan::where('id_laporankegiatan',$id)->where('tipe', 'm')->sum('nominal');

        $total_pengeluaran = Realisasi_kegiatan::where('id_laporankegiatan',$id)->where('tipe', 'k')->sum('nominal');

    	return view('benadventure.laporan-kegiatan.realisasi_excel', [
            'data' => $data,
            'data_realisasi' => $data_realisasi,
            'data_kegiatan' => $data_kegiatan,
            'realisasi_kegiatan' => $realisasi_kegiatan,
            'jp' => $jp,
            'jpr' => $jpr,
            'total_pendapatan' => $total_pendapatan,
            'total_pengeluaran' => $total_pengeluaran
        ]);
    }
}
