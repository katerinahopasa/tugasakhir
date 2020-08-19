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

use App\Exports\NeracalaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class NeracaLaporanController extends Controller
{
    // Neraca Lapporan
    public function showNeracaLaporan()
    {
        $daftar_neracalaporan = Jurnals::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_neracalaporan = $daftar_neracalaporan->count();
        
        return view('benadventure.laporan.neraca-laporan',  compact('daftar_neracalaporan', 'total_neracalaporan'));
    }

    public function neraca_laporan_excel($waktu)
    { 
      // dd($waktu);
        return Excel::download(new NeracalaporanExport($waktu), 'NeracaLaporan.xlsx');
    }

    public function detailNeracaLaporan(Request $request, $waktu)
    {   
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

    	  	$aktiva_lancar = $this->dapatAktiva("aktiva_lancar", $waktu);

       		$aktiva_tetap = $this->dapatAktivaTetap("aktiva_tetap", $waktu);
       		$jumlah_aktiva_tetap = $this->dapatAktiva("aktiva_tetap", $waktu);
       		// dd($aktiva_tetap);

       		$pasiva = $this->dapatPasiva("pasiva", $waktu);

       		$ekuitas = $this->dapatPasiva("ekuitas", $waktu);

        return view('benadventure.laporan.neraca-laporan-detail', compact('aktiva_lancar','aktiva_tetap','pasiva','ekuitas','jumlah_aktiva_tetap','laba_bersih','periode'));

	 }

	 public function dapatAktiva($value, $waktu)
	 {
    $bulan   = date('m', strtotime($waktu)); 
    $tahun   = date('Y', strtotime($waktu));
    $periode = date('F Y', strtotime($waktu));

	 	$coba		 = DB::table("akun as a")
            				->join("Jurnals as jun","a.id","=","jun.id_akun")
            				->where("a.jenis_akun",$value)
                    ->whereMonth('waktu_transaksi', $bulan)
                    ->whereYear('waktu_transaksi', $tahun)
            				->get();
            //kelompokan id akun
           // dd($coba);

           	$kode_akun=0;
           	$arrayKosong = [];
           	$int =1;
           	$arrayBaru = [];

           	$kotakDebit=[];
           	$kotakKredit=[];
           	$debit=0;
           	$kredit=0;

           	foreach ($coba as $key => $value) {
       			$kode_akun = $value->kode_akun;

       			if ($kode_akun == $value->kode_akun) {
       				$arrayKosong[$kode_akun][$int]=$value;	
       					$int++;
       			}
       		
       		}

       		///debit
       		foreach ($arrayKosong as $key => $value) {
       			foreach ($value as $key2 => $value2) {
       				// dd($value2);
       				if ($value2->tipe == "d") {
       					if ($value2->kode_akun == $key) {
	       						$debit += $value2->nominal;
       					}
       				}

       			}

       			$kotakDebit[$key]=$debit;
       			$debit=0;

       		}
       		//kredit

       		foreach ($arrayKosong as $key => $value) {
       			foreach ($value as $key2 => $value2) {
       				// dd($value2);
       				if ($value2->tipe == "k") {
       					if ($value2->kode_akun == $key) {
	       						$kredit += $value2->nominal;
       					}
       				}

       			}

       			$kotakKredit[$key]=$kredit;
       			$kredit=0;

       		}

       		// dd($kotakKredit);
       		$total=[];
       		$subtotal =0;
       		//total = debit -kredit
       		foreach ($kotakKredit as $key => $value) {
       			$subtotal= $kotakDebit[$key] - $value;
       			$total[$key]=$subtotal;
       			$subtotal=0;
       		}

       		$arrayJadi =[];
       		$i=1;
       		foreach ($total as $key => $value) {
       			$dapatNama = DB::table('akun')->where('kode_akun',$key)->first();
       			// dd($dapatNama);
       			$arrayBelumJadi['nama']=$dapatNama->nama_akun;
       			$arrayBelumJadi['value']=$value;

       			$arrayJadi[$i] =$arrayBelumJadi; 
       			$i++;
       		}

       		return $arrayJadi;
	 }

	 public function dapatPasiva($value, $waktu)
	 {
    $bulan = date('m', strtotime($waktu));
    $tahun = date('Y', strtotime($waktu));
    $periode = date('F Y', strtotime($waktu));
	 	
	 	$coba		 = DB::table("akun as a")
            				->join("Jurnals as jun","a.id","=","jun.id_akun")
            				->where("a.jenis_akun",$value)
                    ->whereMonth('waktu_transaksi', $bulan)
                    ->whereYear('waktu_transaksi', $tahun)
            				->get();
            //kelompokan id akun
           // dd($coba);

           	$kode_akun=0;
           	$arrayKosong = [];
           	$int =1;
           	$arrayBaru = [];

           	$kotakDebit=[];
           	$kotakKredit=[];
           	$debit=0;
           	$kredit=0;

           	foreach ($coba as $key => $value) {
       			$kode_akun = $value->kode_akun;

       			if ($kode_akun == $value->kode_akun) {
       				$arrayKosong[$kode_akun][$int]=$value;	
       					$int++;
       			}
       		
       		}


       		///debit
       		foreach ($arrayKosong as $key => $value) {
       			foreach ($value as $key2 => $value2) {
       				// dd($value2);
       				if ($value2->tipe == "d") {
       					if ($value2->kode_akun == $key) {
	       						$debit += $value2->nominal;
       					}
       				}

       				
       			}
       			$kotakDebit[$key]=$debit;
       			$debit=0;

       		}
       		//kredit

       		foreach ($arrayKosong as $key => $value) {
       			foreach ($value as $key2 => $value2) {
       				// dd($value2);
       				if ($value2->tipe == "k") {
       					if ($value2->kode_akun == $key) {
	       						$kredit += $value2->nominal;
       					}
       				}

       				
       			}
       			$kotakKredit[$key]=$kredit;
       			$kredit=0;

       		}



       		// dd($kotakKredit);
       		$total=[];
       		$subtotal =0;
       		//total = debit -kredit
       		foreach ($kotakKredit as $key => $value) {
       			$subtotal= $value-$kotakDebit[$key];
       			$total[$key]=$subtotal;
       			$subtotal=0;
       		}

       		$arrayJadi =[];
       		$i=1;
       		foreach ($total as $key => $value) {
       			$dapatNama = DB::table('akun')->where('kode_akun',$key)->first();
       			// dd($dapatNama);
       			$arrayBelumJadi['nama']=$dapatNama->nama_akun;
       			$arrayBelumJadi['value']=$value;

       			$arrayJadi[$i] =$arrayBelumJadi; 
       			$i++;
       		}


       		return $arrayJadi;
	 }
	
	public function dapatAktivaTetap($value, $waktu)
	 {
    $bulan = date('m', strtotime($waktu));
    $tahun = date('Y', strtotime($waktu));
    $periode = date('F Y', strtotime($waktu));

	 	$coba	= DB::table("akun as a")
				->join("Jurnals as jun","a.id","=","jun.id_akun")
				->where("a.jenis_akun",$value)
        ->whereMonth('waktu_transaksi', $bulan)
        ->whereYear('waktu_transaksi', $tahun)
				->get();

		return $coba;

	 }

    public function cetakNeracaLaporan($waktu)
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

        // Neraca Laporan
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "NERACA LAPORAN $periode", 0, 2, 'C');

        // aktiva lancar
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Aktiva Lancar", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(126, 10, "NAMA AKUN", 1, 0, 'C');
        $pdf->Cell(126, 10, "NOMINAL", 1, 0, 'C');
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

    	$aktiva_lancar = $this->dapatAktiva("aktiva_lancar", $waktu);
    	

       	$aktiva_tetap = $this->dapatAktivaTetap("aktiva_tetap", $waktu);
       	$jumlah_aktiva_tetap = $this->dapatAktiva("aktiva_tetap", $waktu);
       	
       	// dd($aktiva_tetap);

       	$pasiva = $this->dapatPasiva("pasiva", $waktu);

       	$ekuitas = $this->dapatPasiva("ekuitas", $waktu);

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        $jumlah_aktiva_lancar = 0;
        foreach($aktiva_lancar as $p)
        {
        	// dd($p['value']);
        	$jumlah_aktiva_lancar += $p['value'];
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(126, 10, $p['nama'], 1, 0, 'C');
            $pdf->Cell(126, 10, "Rp. ".number_format($p['value'], 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();
            
            
        }
        // dd($jumlah_aktiva_lancar);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "Jumlah Aktiva Lancar", 1, 0, 'C');
        $pdf->Cell(126, 10, "Rp. ".number_format($jumlah_aktiva_lancar, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        // aktiva tetap
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Aktiva Tetap", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(126, 10, "NAMA AKUN", 1, 0, 'C');
        $pdf->Cell(63, 10, "DEBIT", 1, 0, 'C');
        $pdf->Cell(63, 10, "KREDIT", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        $jumlah_aktivatetap = 0;
        $jumlahdebit =0;
        $jumlahkredit =0;
        foreach($aktiva_tetap as $p)
        {
        	if($p->tipe =='d'){
        		$jumlahdebit += $p->nominal;
        	}else{
        		$jumlahkredit += $p->nominal;
        	}	
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(126, 10, $p->nama_akun, 1, 0, 'C');
            if($p->tipe === 'd') $pdf->Cell(63, 10, 'Rp. '.number_format($p->nominal, 0, ',', '.').',-', 1, 0, 'C');
            else $pdf->Cell(63, 10, '-', 1, 0, 'C');
            if($p->tipe === 'k') $pdf->Cell(63, 10,'Rp. '.number_format($p->nominal, 0, ',', '.').',-', 1, 0, 'C');
            else $pdf->Cell(63, 10, '-', 1, 0, 'C');
            $pdf->Ln();
        }
        $jumlah_aktivatetap = $jumlahdebit-$jumlahkredit;
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "Jumlah Aktiva Tetap", 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(126, 10, "Rp. ".number_format($jumlah_aktivatetap, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        $jumlah_aktiva_lancartetap = $jumlah_aktiva_lancar+$jumlah_aktivatetap;
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "JUMLAH AKTIVA TETAP DAN AKTIVA LANCAR", 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(126, 10, "Rp. ".number_format($jumlah_aktiva_lancartetap, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(233, 10, strtoupper(terbilang($jumlah_aktiva_lancartetap)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

        // Footer
        // $pdf->SetY(179);
        // $pdf->SetX(175);
        // $pdf->SetFont('Arial','I',8);
        // $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
        // ." WIB",0,0,'C');

        $pdf->Ln();
        // $pdf->AddPage('L', 'A4');
         // pasiva
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Pasiva", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(126, 10, "NAMA AKUN", 1, 0, 'C');
        $pdf->Cell(126, 10, "NOMINAL", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        $jumlah_pasiva = 0;
        foreach($pasiva as $p)
        {	
        	$jumlah_pasiva += $p['value'];
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(126, 10, $p['nama'], 1, 0, 'C');
            $pdf->Cell(126, 10, "Rp. ".number_format($p['value'], 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "Jumlah Pasiva", 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(126, 10, "Rp. ".number_format($jumlah_pasiva, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

         // ekuitas
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Ekuitas", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(126, 10, "NAMA AKUN", 1, 0, 'C');
        $pdf->Cell(126, 10, "NOMINAL", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        $jumlah_ekuitas = 0;
        foreach($ekuitas as $p)
        {	
        	$jumlah_ekuitas += $p['value'];
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(126, 10, $p['nama'], 1, 0, 'C');
            $pdf->Cell(126, 10, "Rp. ".number_format($p['value'], 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "Jumlah Ekuitas", 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(126, 10, "Rp. ".number_format($jumlah_ekuitas, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();


        $jumlah_pasiva_ekuitas = $jumlah_pasiva+$jumlah_ekuitas;
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "JUMLAH PASIVA DAN EKUITAS", 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(126, 10, "Rp. ".number_format($jumlah_pasiva_ekuitas, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(242, 10, strtoupper(terbilang($jumlah_pasiva_ekuitas)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

        // Laba Rugi
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Laba Rugi", 0, 2, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(151, 10, "LABA BERSIH", 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(126, 10, "Rp. ".number_format($laba_bersih, 0, ',', '.').",-", 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(242, 10, strtoupper(terbilang($laba_bersih)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

        // Footer
        $pdf->SetY(179);
        $pdf->SetX(175);
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
        ." WIB",0,0,'C');
        
        // Save
        Session::flash('pesan', 'Neraca Laporan Berhasil Diunduh');
        return $pdf->Output('D', "Neraca Laporan $periode.pdf"); 
    }

}