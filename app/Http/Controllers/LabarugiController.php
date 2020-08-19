<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akun;
use App\Jurnals;
use App\Profil;
use Session;
use DB;
use Carbon\Carbon;
use Crabbly\FPDF\FPDF as FPDF;

use App\Exports\LabarugiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class LabarugiController extends Controller
{
    // labarugi
    public function showLabarugi()
    {
        $daftar_labarugi = Jurnals::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_labarugi = $daftar_labarugi->count();
        
        return view('benadventure.laporan.labarugi',  compact('daftar_labarugi', 'total_labarugi'));
    }

    public function labarugi_excel($waktu)
    { 
      // dd($waktu);
        return Excel::download(new LabarugiExport($waktu), 'LabaRugi.xlsx');
    }

    public function detailLabarugi(Request $request, $waktu)
    {   
        //$total_akun = Akun::all()->count();

        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $data_akunpendapatan = DB::table('akun')
            ->join('jurnals', 'akun.id', '=', 'jurnals.id_akun')
            ->select('akun.*', 'jurnals.nominal', 'akun.jenis_akun')
            ->where('jenis_akun', 'pendapatan')
            ->whereMonth('waktu_transaksi', $bulan)
            ->whereYear('waktu_transaksi', $tahun)
            ->get();

        $data_akunbeban = DB::table('akun')
            ->join('jurnals', 'akun.id', '=', 'jurnals.id_akun')
            ->select('akun.*', 'jurnals.nominal', 'akun.jenis_akun')
            ->where('jenis_akun', 'beban')
            ->whereMonth('waktu_transaksi', $bulan)
            ->whereYear('waktu_transaksi', $tahun)
            ->get();
     
         $total_pendapatan = $data_akunpendapatan->sum('nominal');
         $total_beban = $data_akunbeban->sum('nominal');
         $laba_bersih = $total_pendapatan - $total_beban;

        return view('benadventure.laporan.labarugi-detail', compact('periode','data_akunpendapatan','data_akunbeban','total_pendapatan','total_beban','laba_bersih'));

	 }

     public function cetakLabaRugi($waktu)
    {
        $pdf = app('Fpdf');

        $pdf->AddPage('L', 'A4');

        //$mulai = date('Y-m-d',strtotime($request->mulai));
        //$selesai = date('Y-m-d',strtotime($request->selesai));
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));
        $periode = strtoupper($periode);

        $profil = Profil::findOrFail(1);
        $image = "assets/dist/img/logo.png";

        $id = Akun::pluck('id');

        // Header
        $pdf->Image($image, 5, $pdf->GetX(), 23.78, 'T');

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();

        // Laba Rugi
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "LAPORAN LABA RUGI $periode", 0, 2, 'C');

        // Akun Pendapatan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Pendapatan", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(84, 10, "JENIS AKUN", 1, 0, 'C');
        $pdf->Cell(84, 10, "NAMA AKUN", 1, 0, 'C');
        $pdf->Cell(84, 10, "NOMINAL", 1, 0, 'C');
        $pdf->Ln();

        $data_akunpendapatan = DB::table('akun')
                ->join('jurnals', 'akun.id', '=', 'jurnals.id_akun')
                ->select('akun.*', 'jurnals.nominal', 'akun.jenis_akun')
                ->where('jenis_akun', 'pendapatan')
                ->whereMonth('waktu_transaksi', $bulan)
                ->whereYear('waktu_transaksi', $tahun)
                ->get();

        $data_akunbeban = DB::table('akun')
                ->join('jurnals', 'akun.id', '=', 'jurnals.id_akun')
                ->select('akun.*', 'jurnals.nominal', 'akun.jenis_akun')
                ->where('jenis_akun', 'beban')
                ->whereMonth('waktu_transaksi', $bulan)
                ->whereYear('waktu_transaksi', $tahun)
                ->get();
         
        $total_pendapatan = $data_akunpendapatan->sum('nominal');
        $total_beban = $data_akunbeban->sum('nominal');
        $laba_bersih = $total_pendapatan - $total_beban;

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        foreach($data_akunpendapatan as $p)
        {
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(84, 10, $p->jenis_akun, 1, 0, 'C');
            $pdf->Cell(84, 10, $p->nama_akun, 1, 0, 'C');
            $pdf->Cell(84, 10, "Rp. ".number_format($p->nominal, 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();
            
        }
        // dd($jumlah_aktiva_lancar);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(109, 10, "Total Pendapatan", 1, 0, 'C');
        $pdf->Cell(168, 10, "Rp. ".number_format($total_pendapatan, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        // Akun Beban
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Beban - Beban", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(84, 10, "JENIS AKUN", 1, 0, 'C');
        $pdf->Cell(84, 10, "NAMA AKUN", 1, 0, 'C');
        $pdf->Cell(84, 10, "NOMINAL", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        foreach($data_akunbeban as $p)
        {
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(84, 10, $p->jenis_akun, 1, 0, 'C');
            $pdf->Cell(84, 10, $p->nama_akun, 1, 0, 'C');
            $pdf->Cell(84, 10, "Rp. ".number_format($p->nominal, 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();
            
        }
        // dd($jumlah_aktiva_lancar);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(109, 10, "Total Beban", 1, 0, 'C');
        $pdf->Cell(168, 10, "Rp. ".number_format($total_beban, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(109, 10, "Total Laba Bersih", 1, 0, 'C');
        $pdf->Cell(168, 10, "Rp. ".number_format($laba_bersih, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        //Footer
        $pdf->SetY(179);
        $pdf->SetX(175);
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
        ." WIB",0,0,'C');

        $pdf->Ln();
        // $pdf->AddPage('L', 'A4');
        
        // Save
        Session::flash('pesan', 'Realisasi Keuangan Kegiatan Berhasil Diunduh');
        return $pdf->Output('D', "Realisasi Keuangan Kegiatan.pdf"); 
    }
}
