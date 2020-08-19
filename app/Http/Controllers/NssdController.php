<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akun;
use App\Jurnals;
use Session;
use DB;
use Carbon\Carbon;
use Crabbly\FPDF\FPDF as FPDF;

class NssdController extends Controller
{
    // neraca
    public function showNssd()
    {
        $daftar_neraca = Jurnals::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_neraca = $daftar_neraca->count();
        
        return view('benadventure.neraca-lajur.nssd',  compact('daftar_neraca', 'total_neraca'));
    }

    public function detailNssd(Request $request, $waktu)
    {
    	if(empty($waktu)) return redirect('neraca');
        
        $total_akun = Akun::all()->count();

        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $total_saldo_debet = 0;
        $total_saldo_kredit = 0;

        for($i = 1; $i <= $total_akun; $i++){

            $daftar_buku[$i] = Jurnals::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->get();
            
            $total_debetjurnal[$i] = Jurnals::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $total_kreditjurnal[$i] = Jurnals::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');

            $akun[$i] = Akun::findOrFail($i);
            
            if( substr($akun[$i]->kode_akun, 0, 1) === '1' ||  substr($akun[$i]->kode_akun, 0, 1) === '3' ||  substr($akun[$i]->kode_akun, 0, 1) === '5'){
                $debet[$i] = $total_debetjurnal[$i] - $total_kreditjurnal[$i];
                $kredit[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '2' ||  substr($akun[$i]->kode_akun, 0, 1) === '6' ||  substr($akun[$i]->kode_akun, 0, 1) === '4'){
                $kredit[$i] = $total_kreditjurnal[$i] - $total_debetjurnal[$i];
                $debet[$i] = 0;
            }
            
            $data[$i] = [
                'nama_akun' => $akun[$i]->nama_akun,
                'debet' => $debet[$i],
                'kredit' => $kredit[$i],
            ];
            // dd($debet);
            
            $total_saldo_debet += $data[$i]['debet']; 
            $total_saldo_kredit += $data[$i]['kredit']; 
        }

        return view('benadventure.neraca-lajur.nssd-detail', compact('data', 'total_saldo_debet', 'total_saldo_kredit', 'periode'));

	 }
}
