<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;
use App\Estimasiakhirlaporan;
use App\Profil;
use Session;
use DB;
use Carbon\Carbon;
use Crabbly\FPDF\FPDF as FPDF;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class LaporanDivHarianController extends Controller
{
    public function index(Request $request)
    {   
        $mulai = date('Y-m-d',strtotime($request->mulai));
        $selesai = date('Y-m-d',strtotime($request->selesai));
        $pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $total_pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        $total_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');
        $total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;
        
        return view('benharian.laporan.laporan',  compact('pemasukan','pengeluaran','total_pemasukan','total_pengeluaran','total_pemasukan_bersih','estimasiakhirlaporan','mulai','selesai'));
    }

    public function cari(Request $request)
    {
    	$this->validate($request,[
    		'mulai'=>'required',
    		'selesai'=>'required'
    	]);

    	$mulai = date('Y-m-d',strtotime($request->mulai));
    	$selesai = date('Y-m-d',strtotime($request->selesai));

    	$pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

    	$pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

    	$total_pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

    	$total_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');

    	$total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;
        $estimasiakhirlaporan = Estimasiakhirlaporan::all();

    	return view('benharian.laporan.laporan', compact('pemasukan','pengeluaran','total_pemasukan','total_pengeluaran','total_pemasukan_bersih','estimasiakhirlaporan','mulai','selesai'));
    }

    public function laporan_excel(Request $request)
    {
        return Excel::download(new LaporanExport($request->mulai, $request->selesai), 'Laporan.xlsx');
    }

    public function laporan_cetak($mulai, $selesai)
    {
        $pdf = app('Fpdf');

        $pdf->AddPage('L', 'A4');

        //$mulai = date('Y-m-d',strtotime($request->mulai));
        //$selesai = date('Y-m-d',strtotime($request->selesai));

        $profil = Profil::findOrFail(1);
        $mulai2 = date('d M Y',strtotime($mulai));
        $selesai2 = date('d M Y',strtotime($selesai));
        $image = "assets/dist/img/logo.png";

        // Header
        $pdf->Image($image, 5, $pdf->GetX(), 23.78, 'T');

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "LAPORAN KEUANGAN", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Periode $mulai2 s/d $selesai2", 0, 2, 'C');
        
        // laporan data pemasukan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Data Transaksi Pemasukan", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 10, "No", 1, 0, 'C');
        $pdf->Cell(61, 10, "Tanggal", 1, 0, 'C');
        $pdf->Cell(61, 10, "Jumlah Pengunjung", 1, 0, 'C');
        $pdf->Cell(61, 10, "Keterangan", 1, 0, 'C');
        $pdf->Cell(71, 10, "Nominal Pemasukan", 1, 0, 'C');
        $pdf->Ln();

        $pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $total_pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        $total_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');

        $total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        foreach($pemasukan as $p)
        {
            $pdf->Cell(20, 10, $i++, 1, 0, 'C');
            $pdf->Cell(61, 10, date('d M Y',strtotime($p->tanggal)), 1, 0, 'C');
            $pdf->Cell(61, 10, $p->jml_pengunjung, 1, 0, 'C');
            $pdf->Cell(61, 10, $p->keterangan, 1, 0, 'C');
            $pdf->Cell(71, 10, 'Rp. '.number_format($p->total_pemasukan, 0, ',', '.').',-', 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(203, 10, 'TOTAL', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(71, 10, 'Rp. '. number_format($total_pemasukan, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(239, 10, strtoupper(terbilang($total_pemasukan)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

        // Footer
        $pdf->SetY(179);
        $pdf->SetX(175);
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
        ." WIB",0,0,'C');

        $pdf->AddPage('L', 'A4');


        // Header
        $pdf->Image($image, 5, $pdf->GetX(), 23.78, 'T');

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();

        // laporan data pengeluaran
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Data Transaksi Pengeluaran", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 10, "No", 1, 0, 'C');
        $pdf->Cell(61, 10, "Tanggal", 1, 0, 'C');
        $pdf->Cell(61, 10, "Nama Pengeluaran", 1, 0, 'C');
        $pdf->Cell(61, 10, "Keterangan", 1, 0, 'C');
        $pdf->Cell(71, 10, "Nominal Pengeluaran", 1, 0, 'C');
        $pdf->Ln();

        $pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $total_pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        $total_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');

        $total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        foreach($pengeluaran as $p)
        {
            $pdf->Cell(20, 10, $i++, 1, 0, 'C');
            $pdf->Cell(61, 10, date('d M Y',strtotime($p->tanggal)), 1, 0, 'C');
            $pdf->Cell(61, 10, $p->nama_pengeluaran, 1, 0, 'C');
            $pdf->Cell(61, 10, $p->keterangan, 1, 0, 'C');
            $pdf->Cell(71, 10, 'Rp. '.number_format($p->nominal, 0, ',', '.').',-', 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(203, 10, 'TOTAL', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(71, 10, 'Rp. '. number_format($total_pengeluaran, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(239, 10, strtoupper(terbilang($total_pengeluaran)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

            // Footer
            $pdf->SetY(179);
            $pdf->SetX(175);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")." WIB",0,0,'C');

            $pdf->AddPage('L', 'A4');


        // Header
        $pdf->Image($image, 5, $pdf->GetX(), 23.78, 'T');

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();
        
        // estimasi pembagian persentase
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Estimasi Pembagian Persentasi", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(83, 10, "Nama Pembagian", 1, 0, 'C');
        $pdf->Cell(40, 10, "Persentase", 1, 0, 'C');
        $pdf->Cell(63, 10, "Nominal", 1, 0, 'C');
        $pdf->Ln();

        $pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $total_pemasukan = \DB::table('pemasukan')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        $total_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');

        $total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;

        $pdf->SetFont('Arial', '', 11);

        $i = 1;

        $pdf->Cell(83, 10, "Upah Pengelola", 1, 0, 'C');
        $pdf->Cell(40, 10, "80%", 1, 0, 'C');
        $pdf->Cell(63, 10, 'Rp. '.number_format(80/100*$total_pemasukan_bersih, 0, ',', '.').',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(83, 10, "Lembaga Masyarakat Desa Hutan (LMDH)", 1, 0, 'C');
        $pdf->Cell(40, 10, "10%", 1, 0, 'C');
        $pdf->Cell(63, 10, 'Rp. '.number_format(10/100*$total_pemasukan_bersih, 0, ',', '.').',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(83, 10, "Sisa Hasil Usaha (SHU)", 1, 0, 'C');
        $pdf->Cell(40, 10, "10%", 1, 0, 'C');
        $pdf->Cell(63, 10, 'Rp. '.number_format(10/100*$total_pemasukan_bersih, 0, ',', '.').',-', 1, 0, 'C');
        $pdf->Ln();

            // Footer
            $pdf->SetY(179);
            $pdf->SetX(175);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")." WIB",0,0,'C');

            $pdf->AddPage('L', 'A4');
        
        // Save
        Session::flash('pesan', 'Laporan Berhasil Diunduh');
        return $pdf->Output('D', "LAPORAN Periode $mulai2 sampai $selesai2.pdf"); 
    }
}
