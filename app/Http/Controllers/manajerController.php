<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurnal;
use App\Akun;
use App\Profil;
use App\Pemasukan;
use App\Pengeluaran;

class manajerController extends Controller
{
    public function index()
    {
        $total_pemasukan = Pemasukan::sum('total_pemasukan');
        $total_pengeluaran = Pengeluaran::sum('nominal');
        $saldo = $total_pemasukan - $total_pengeluaran;
        return view('manajer',['title'=>'benharian','pemasukan'=>$total_pemasukan,'pengeluaran'=>$total_pengeluaran,'saldo'=>$saldo]);
    }

    public function pilihTahun(Request $req)
    {

        $total_pemasukan = Pemasukan::sum('total_pemasukan');
        $total_pengeluaran = Pengeluaran::sum('nominal');
        $saldo = $total_pemasukan - $total_pengeluaran;

        for ($bulan=1; $bulan <=12 ; $bulan++) { 
             $pemasukan_perbulan[] = DB::table('pemasukan')
                                    ->select(DB::raw('SUM(total_pemasukan) as total'))
                                    ->whereMonth('tanggal',$bulan)
                                    ->whereYear('tanggal',$req->tahun)
                                    ->first();

             $pengeluaran_perbulan[] = DB::table('pengeluaran')
                                    ->select(DB::raw('SUM(nominal) as total'))
                                    ->whereMonth('tanggal',$bulan)
                                    ->whereYear('tanggal',$req->tahun)
                                    ->first();

             $jml_pengunjung_perbulan[] = DB::table('pemasukan')
                                    ->select(DB::raw('SUM(jml_pengunjung) as total'))
                                    ->whereMonth('tanggal',$bulan)
                                    ->whereYear('tanggal',$req->tahun)
                                    ->first();
        }
       
        
        return view('benharian.benharian_search',['title'=>'benharian','pemasukan'=>$total_pemasukan,'pengeluaran'=>$total_pengeluaran,'saldo'=>$saldo,'pemasukan_perbulan'=>$pemasukan_perbulan,'pengeluaran_perbulan'=>$pengeluaran_perbulan,'jml_pengunjung_perbulan'=>$jml_pengunjung_perbulan,'tahun_pilihan'=>$req->tahun]);
    }

    // jurnal umum
    public function showJurnalUmum()
    {
        $daftar_jurnal = Jurnal::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_jurnal = $daftar_jurnal->count();
        
        return view('manajer.jurnal-umum',  compact('daftar_jurnal', 'total_jurnal'));
    }

    public function detailJurnalUmum(Request $request, $waktu)
    {
        if(empty($waktu)) return redirect('jurnal-umum');
        
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $daftar_jurnal = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->get();

        $total_debet = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');

        $total_kredit = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');
        
        $total_jurnal = $daftar_jurnal->count();

        return view('manajer.jurnal-umum-detail',  compact('daftar_jurnal', 'total_jurnal', 'periode', 'total_debet', 'total_kredit'));
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

        return view('manajer.jurnal-umum-detail',  compact('daftar_jurnal', 'total_jurnal', 'periode', 'total_debet', 'total_kredit'));
    }


    // buku besar
    public function showBukuBesar()
    {
        $daftar_akun = Akun::all();
        return view('manajer/buku-besar', compact('daftar_akun'));
    }

    public function akunBukuBesar($id)
    {
        $daftar_buku = Jurnal::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->where('id_akun', $id)->distinct()->get();
        
        $total_buku = $daftar_buku->count();
        $akun = Akun::findOrFail($id);
        
        return view('manajer/akun-buku-besar',  compact('daftar_buku', 'total_buku', 'akun'));
    }

    public function detailBukuBesar($id, $waktu)
    {
        if(empty($waktu) || empty($id)) return redirect('buku-besar');
        
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $daftar_buku = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $id)->get();

        $total_debet = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $id)->sum('nominal');

        $total_kredit = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $id)->sum('nominal');
        
        $total_buku = $daftar_buku->count();

        $akun = Akun::findOrFail($id);

        return view('manajer/detail-buku-besar', compact('daftar_buku', 'total_buku', 'periode', 'total_debet', 'total_kredit', 'akun'));
    }

    public function cariBukuBesar($id, Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        $waktu = $tahun.'-'.$bulan.'-01';
        $periode = date('F Y', strtotime($waktu));
        
        if(empty($id) || empty($bulan) || empty($tahun)) return redirect('buku-besar');

        $daftar_buku = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $id)->get();

        $total_debet = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $id)->sum('nominal');

        $total_kredit = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $id)->sum('nominal');
        
        $total_buku = $daftar_buku->count();

        $akun = Akun::findOrFail($id);

        if(!($total_buku)) return redirect('manajer/buku-besar')->with('pesan', "Buku Besar dengan Periode $bulan-$tahun tidak ditemukan");

        return view('manajer/detail-buku-besar', compact('daftar_buku', 'total_buku', 'periode', 'total_debet', 'total_kredit', 'akun'));

    }

     // neraca saldo
    public function showNeracaSaldo()
    {
        $daftar_neraca = Jurnal::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_neraca = $daftar_neraca->count();
        
        return view('manajer/neraca-saldo',  compact('daftar_neraca', 'total_neraca'));
    }

    public function detailNeracaSaldo(Request $request, $waktu)
    {
        if(empty($waktu)) return redirect('neraca-saldo');
        
        $total_akun = Akun::all()->count();

        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));

        $total_saldo_debet = 0;
        $total_saldo_kredit = 0;

        for($i = 1; $i <= $total_akun; $i++){

            $daftar_buku[$i] = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->get();
            
            $total_debet[$i] = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $total_kredit[$i] = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $akun[$i] = Akun::findOrFail($i);
            
            if( substr($akun[$i]->kode_akun, 0, 1) === '1' ||  substr($akun[$i]->kode_akun, 0, 1) === '4'){
                $debet[$i] = $total_debet[$i] - $total_kredit[$i];
                $kredit[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '2' ||  substr($akun[$i]->kode_akun, 0, 1) === '3' || substr($akun[$i]->kode_akun, 0, 1) === '5'){
                $kredit[$i] = $total_kredit[$i] - $total_debet[$i];
                $debet[$i] = 0;
            }
            
            $data[$i] = [
                'nama_akun' => $akun[$i]->nama_akun,
                'debet' => $debet[$i],
                'kredit' => $kredit[$i],
            ];
            
            $total_saldo_debet += $data[$i]['debet']; 
            $total_saldo_kredit += $data[$i]['kredit']; 
        }

        return view('manajer/detail-neraca-saldo', compact('data', 'total_saldo_debet', 'total_saldo_kredit', 'periode'));
    }
    
    public function cariNeracaSaldo(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        $waktu = $tahun.'-'.$bulan.'-01';
        $periode = date('F Y', strtotime($waktu));
        
        if(empty($bulan) || empty($tahun)) return redirect('manajer/neraca-saldo');

        $total_akun = Akun::all()->count();

        $total_saldo_debet = 0;
        $total_saldo_kredit = 0;

        for($i = 1; $i <= $total_akun; $i++){

            $daftar_buku[$i] = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->get();
            
            $total_debet[$i] = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $total_kredit[$i] = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $akun[$i] = Akun::findOrFail($i);
            
            if( substr($akun[$i]->kode_akun, 0, 1) === '1' ||  substr($akun[$i]->kode_akun, 0, 1) === '4'){
                $debet[$i] = $total_debet[$i] - $total_kredit[$i];
                $kredit[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '2' ||  substr($akun[$i]->kode_akun, 0, 1) === '3' || substr($akun[$i]->kode_akun, 0, 1) === '5'){
                $kredit[$i] = $total_kredit[$i] - $total_debet[$i];
                $debet[$i] = 0;
            }
            
            $data[$i] = [
                'nama_akun' => $akun[$i]->nama_akun,
                'debet' => $debet[$i],
                'kredit' => $kredit[$i],
            ];
            
            $total_saldo_debet += $data[$i]['debet']; 
            $total_saldo_kredit += $data[$i]['kredit']; 
        }

        if($total_saldo_debet === 0 && $total_saldo_kredit === 0) return redirect('manajer/neraca-saldo')->with('pesan', "Neraca Saldo dengan Periode $bulan-$tahun tidak ditemukan");

        return view('manajer/detail-neraca-saldo', compact('data', 'total_saldo_debet', 'total_saldo_kredit', 'periode'));
    }


    public function showLaporan()
    {
        $daftar_jurnal = Jurnal::selectRaw("CONCAT(MONTH(waktu_transaksi), '-', YEAR(waktu_transaksi)) as waktu")->distinct()->get();
        
        $total_jurnal = $daftar_jurnal->count();
        
        return view('manajer/laporan',  compact('daftar_jurnal', 'total_jurnal'));
    }

    public function cetakLaporan($waktu)
    {
        if(empty($waktu)) return redirect('manajer/laporan');

        $pdf = app('Fpdf');

        $pdf->AddPage('L', 'A4');

        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));
        $periode = strtoupper($periode);

        $profil = Profil::findOrFail(1);

        // Header
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Telepon : ".$profil->telepon." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, "LAPORAN KEUANGAN $periode", 0, 2, 'C');
        
        // Jurnal Umum
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "JURNAL UMUM $periode", 0, 2, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(63, 10, "WAKTU", 1, 0, 'C');
        $pdf->Cell(63, 10, "AKUN", 1, 0, 'C');
        $pdf->Cell(63, 10, "DEBET", 1, 0, 'C');
        $pdf->Cell(63, 10, "KREDIT", 1, 0, 'C');
        $pdf->Ln();

        $daftar_jurnal = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->get();

        $total_debet = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');

        $total_kredit = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');

        $pdf->SetFont('Arial', '', 12);

        $i = 1;
        foreach($daftar_jurnal as $data)
        {
            $pdf->Cell(25, 10, $i++, 1, 0, 'C');
            $pdf->Cell(63, 10, $data->waktu_transaksi, 1, 0, 'C');
            $pdf->Cell(63, 10, $data->akun->nama_akun, 1, 0, 'C');
            if($data->tipe === 'd') $pdf->Cell(63, 10, 'Rp. '.number_format($data->nominal, 0, ',', '.').',-', 1, 0, 'C');
            else $pdf->Cell(63, 10, '-', 1, 0, 'C');
            if($data->tipe === 'k') $pdf->Cell(63, 10,'Rp. '.number_format($data->nominal, 0, ',', '.').',-', 1, 0, 'C');
            else $pdf->Cell(63, 10, '-', 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(151, 10, 'TOTAL', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(63, 10, 'Rp. '. number_format($total_debet, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Cell(63, 10, 'Rp. ' .number_format($total_kredit, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(121, 10, strtoupper(terbilang($total_debet)).' RUPIAH', 1, 0, 'C');
        $pdf->Cell(121, 10, strtoupper(terbilang($total_kredit)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

        // Footer
        $pdf->SetY(179);
        $pdf->SetX(175);
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
        ." WITA",0,0,'C');

        $pdf->AddPage('L', 'A4');

        // Buku Besar
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "DAFTAR BUKU BESAR $periode", 0, 2, 'C');

        $id = Akun::pluck('id');

        foreach($id as $i)
        {
            $daftar_buku[$i] = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->get();
            
            $data[$i] =
            [
                'akun' => Akun::findOrFail($i),
                'daftar_buku' => $daftar_buku[$i],
                'jumlah_debet' => $daftar_buku[$i]->where('tipe', 'd')->sum('nominal'),
                'jumlah_kredit' => $daftar_buku[$i]->where('tipe', 'k')->sum('nominal'),
            ];

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(92, 10, "AKUN : " . $data[$i]['akun']->nama_akun, 0, 0, 'L');
            $pdf->Cell(92, 10, "PERIODE : $periode", 0, 0, 'C');
            $pdf->Cell(92, 10, "KODE : " . $data[$i]['akun']->kode_akun, 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(138, 10, "TRANSAKSI", 1, 0, 'C');
            $pdf->Cell(138, 10, "SALDO", 1, 0, 'C');
            $pdf->Ln();

            $pdf->Cell(10, 10, "NO", 1, 0, 'C');
            $pdf->Cell(30, 10, "WAKTU", 1, 0, 'C');
            $pdf->Cell(125, 10, "KETERANGAN", 1, 0, 'C');
            $pdf->Cell(56, 10, "DEBET", 1, 0, 'C');
            $pdf->Cell(55, 10, "KREDIT", 1, 0, 'C');
            $pdf->Ln();

            $j = 1;
            foreach($data[$i]['daftar_buku'] as $item){
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(10, 10, $j, 1, 0, 'C');
                $pdf->Cell(30, 10, $item['waktu_transaksi'], 1, 0, 'C');
                $pdf->Cell(125, 10, $item['keterangan'], 1, 0, 'C');
                $pdf->Cell(56, 10, "Rp. ".number_format( ($item['tipe'] === 'd') ? $item['nominal'] : "0" , 0, ',', '.').",-", 1, 0, 'C');
                $pdf->Cell(55, 10, "Rp. " .number_format( ($item['tipe'] === 'k') ? $item['nominal'] : "0" , 0, ',', '.'). ",-", 1, 0, 'C');
                $pdf->Ln();
            $j++;
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(140, 10, "JUMLAH", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(68, 10, "Rp. ". number_format($data[$i]['jumlah_debet'], 0, ',', '.') .",-", 1, 0, 'C');
            $pdf->Cell(68, 10, "Rp. ". number_format($data[$i]['jumlah_kredit'], 0, ',', '.') .",-", 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(140, 10, "SALDO", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(136, 10, "Rp. ". number_format( (substr($data[$i]['akun']->kode_akun, 0, 1) === '1' ||  substr($data[$i]['akun']->kode_akun, 0, 1) === '4') ? $data[$i]['jumlah_debet'] - $data[$i]['jumlah_kredit'] : (((substr($data[$i]['akun']->kode_akun, 0, 1) === '2' || substr($data[$i]['akun']->kode_akun, 0, 1) === '3') || substr($data[$i]['akun']->kode_akun, 0, 1) === '5') ? $data[$i]['jumlah_kredit'] - $data[$i]['jumlah_debet'] : "0") 
                , 0, ',', '.') .",-", 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50, 10, "TERBILANG", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(226, 10, strtoupper( terbilang((substr($data[$i]['akun']->kode_akun, 0, 1) === '1' ||  substr($data[$i]['akun']->kode_akun, 0, 1) === '4') ? $data[$i]['jumlah_debet'] - $data[$i]['jumlah_kredit'] : (((substr($data[$i]['akun']->kode_akun, 0, 1) === '2' || substr($data[$i]['akun']->kode_akun, 0, 1) === '3') || substr($data[$i]['akun']->kode_akun, 0, 1) === '5') ? $data[$i]['jumlah_kredit'] - $data[$i]['jumlah_debet'] : "0"))) . "RUPIAH", 1, 0, 'C');
            $pdf->Ln();

            // Footer
            $pdf->SetY(179);
            $pdf->SetX(175);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")." WITA",0,0,'C');

            $pdf->AddPage('L', 'A4');
        }

        
        // Save
        Session::flash('sukses', 'Laporan Berhasil Diunduh');
        return $pdf->Output('D', "LAPORAN $periode.pdf"); 
        return redirect('manajer/laporan');
    }

    public function cetakNeracaSaldo($waktu)
    {
        $pdf = app('Fpdf');
        
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));
        $periode = strtoupper($periode);

        $profil = Profil::findOrFail(1);

        // $total_akun = Akun::all()->count();
        $id = Akun::pluck('id');

        $total_saldo_debet = 0;
        $total_saldo_kredit = 0;
        

        $pdf->AddPage('L', 'A4');
        
        // Header
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Telepon : ".$profil->telepon." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();

        // Neraca Saldo
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "NERACA SALDO $periode", 0, 2, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(25, 10, "NO", 1, 0, 'C');
        $pdf->Cell(84, 10, "AKUN", 1, 0, 'C');
        $pdf->Cell(84, 10, "DEBET", 1, 0, 'C');
        $pdf->Cell(84, 10, "KREDIT", 1, 0, 'C');
        $pdf->Ln();

        // for($i = 1; $i <= $total_akun; $i++){
        foreach($id as $i){

            $daftar_buku[$i] = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->get();
            
            $total_debet[$i] = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $total_kredit[$i] = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->where('id_akun', $i)->sum('nominal');
            
            $akun[$i] = Akun::findOrFail($i);
            
            if( substr($akun[$i]->kode_akun, 0, 1) === '1' ||  substr($akun[$i]->kode_akun, 0, 1) === '4'){
                $debet[$i] = $total_debet[$i] - $total_kredit[$i];
                $kredit[$i] = 0;
            }elseif( substr($akun[$i]->kode_akun, 0, 1) === '2' ||  substr($akun[$i]->kode_akun, 0, 1) === '3' || substr($akun[$i]->kode_akun, 0, 1) === '5'){
                $kredit[$i] = $total_kredit[$i] - $total_debet[$i];
                $debet[$i] = 0;
            }
            
            $data[$i] = [
                'nama_akun' => $akun[$i]->nama_akun,
                'debet' => $debet[$i],
                'kredit' => $kredit[$i],
            ];
            
            $total_saldo_debet += $data[$i]['debet']; 
            $total_saldo_kredit += $data[$i]['kredit'];
            
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(25, 10, $i, 1, 0, 'C');
            $pdf->Cell(84, 10, $data[$i]['nama_akun'], 1, 0, 'C');
            $pdf->Cell(84, 10, "Rp. ".number_format($data[$i]['debet'], 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Cell(84, 10, "Rp. ".number_format($data[$i]['kredit'], 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();
        }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(109, 10, "TOTAL", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(84, 10, "Rp. ".number_format($total_saldo_debet, 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Cell(84, 10, "Rp. ".number_format($total_saldo_kredit, 0, ',', '.').",-", 1, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(31, 10, "TERBILANG", 1, 0, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(123, 10, strtoupper(terbilang($total_saldo_debet)). "RUPIAH", 1, 0, 'C');
            $pdf->Cell(123, 10, strtoupper(terbilang($total_saldo_kredit)) . "RUPIAH", 1, 0, 'C');
            $pdf->Ln();

            // Footer
            $pdf->SetY(179);
            $pdf->SetX(175);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
            ." WITA", 0, 0, 'C');

            Session::flash('manajer/pesan', 'Laporan Neraca Berhasil Diunduh');
            return $pdf->Output('D', "LAPORAN NERACA $periode.pdf");

        }

        public function cariLaporan(Request $request)
        {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            
            $waktu = $tahun.'-'.$bulan.'-01';
            $periode = date('F Y', strtotime($waktu));

            if(empty($bulan) || empty($tahun)) return redirect('manajer/laporan');

            $daftar_jurnal = Jurnal::whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->get();

            $total_debet = Jurnal::where('tipe', 'd')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');

            $total_kredit = Jurnal::where('tipe', 'k')->whereMonth('waktu_transaksi', $bulan)->whereYear('waktu_transaksi', $tahun)->orderBy('waktu_transaksi', 'asc')->sum('nominal');
            
            $total_jurnal = $daftar_jurnal->count();
            $total_akun = Akun::all()->count();
            $total_saldo_debet = 0;
            $total_saldo_kredit = 0;

            for($i = 1; $i <= $total_akun; $i++){
                $akun[$i] = Akun::findOrFail($i);
                
                if( substr($akun[$i]->kode_akun, 0, 1) === '1' ||  substr($akun[$i]->kode_akun, 0, 1) === '4'){
                    $debet[$i] = $total_debet[$i] - $total_kredit[$i];
                    $kredit[$i] = 0;
                }elseif( substr($akun[$i]->kode_akun, 0, 1) === '2' ||  substr($akun[$i]->kode_akun, 0, 1) === '3' || substr($akun[$i]->kode_akun, 0, 1) === '5'){
                    $kredit[$i] = $total_kredit[$i] - $total_debet[$i];
                    $debet[$i] = 0;
                }
                
                $data[$i] = [
                    'nama_akun' => $akun[$i]->nama_akun,
                    'debet' => $debet[$i],
                    'kredit' => $kredit[$i],
                ];
                
                $total_saldo_debet += $data[$i]['debet']; 
                $total_saldo_kredit += $data[$i]['kredit']; 
            }

            if(!($total_jurnal)) return redirect('manajer/laporan')->with('pesan', "Laporan dengan Periode $bulan-$tahun tidak ditemukan");

            return view('manajer.laporan',  compact('daftar_jurnal', 'total_jurnal', 'periode', 'total_debet', 'total_kredit','data'));


        }


}
