<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akun;

use App\Jurnals;

use Session;
use DB;
use Carbon\Carbon;
use Crabbly\FPDF\FPDF as FPDF;

class NeracaController extends Controller
{
    // neraca saldo
    public function showNeraca()
    {
        $daftar_neraca = Jurnals::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_neraca = $daftar_neraca->count();
        
        return view('benadventure.neraca-saldo.neracasaldo',  compact('daftar_neraca', 'total_neraca'));
    }

    public function detailNeraca(Request $request, $waktu)
    {
    	if(empty($waktu)) return redirect('neraca');
        
        $total_akun = Akun::all()->count();

        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $total_saldo_debet = 0;
        $total_saldo_kredit = 0;

        for($i = 1; $i <= $total_akun; $i++){

            $daftar_buku[$i] = Jurnals::where('jenis_jurnal', 'u')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->get();
            
            $total_debetjurnalumum[$i] = Jurnals::where('jenis_jurnal', 'u')->where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $total_kreditjurnalumum[$i] = Jurnals::where('jenis_jurnal', 'u')->where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            

            $akun[$i] = Akun::findOrFail($i);
            $x[$i] = Jurnals::join('akun','akun.id','jurnals.id_akun')
                      ->select('akun.*','jurnals.tipe AS tipe')
                      ->select('jurnals.*','akun.kode_akun AS kode_akun')
                      ->whereMonth('waktu_transaksi', $bulan)
                      ->whereYear('waktu_transaksi', $tahun)
                      ->first();
            // dd($x);
            
            if( substr($akun[$i]->kode_akun, 0, 1) === '3' ||  substr($akun[$i]->kode_akun, 0, 1) === '5'){
                $debet[$i] = $total_debetjurnalumum[$i] - $total_kreditjurnalumum[$i];
                $kredit[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '2' ||  substr($akun[$i]->kode_akun, 0, 1) === '6' ||  substr($akun[$i]->kode_akun, 0, 1) === '4'){
                $kredit[$i] = $total_kreditjurnalumum[$i] - $total_debetjurnalumum[$i];
                $debet[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '1' && $x[$i]->tipe === 'k'){
                $debet[$i] = $total_debetjurnalumum[$i] - $total_kreditjurnalumum[$i];
                $kredit[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '1' && $x[$i]->tipe === 'd'){
                $debet[$i] = $total_debetjurnalumum[$i] - $total_kreditjurnalumum[$i];
                $kredit[$i] = 0;
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

        return view('benadventure.neraca-saldo.neracasaldo-detail', compact('data', 'total_saldo_debet', 'total_saldo_kredit', 'periode'));

	 }
}
