<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RealisasiKegiatanRequest;
use App\Jenis_pendapatan  as JP;
use App\Jenis_pengeluaran as JPR;
use App\Realisasi_kegiatan;
use App\Jenis_transaksikegiatan;
use App\Laporan_kegiatan;
use App\Profil;
use DB;
use Auth;
use Carbon\Carbon;
use Session;

use App\Exports\RealisasiKegiatanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class realisasi_kegiatanController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = Laporan_kegiatan::findOrFail($id);

        $data_realisasi = Realisasi_kegiatan::where('id_laporankegiatan',$id)->get();
        $data_kegiatan = $data_realisasi;

        $realisasi_kegiatan = Realisasi_kegiatan::all();
        $jp = JP::all();
        $jpr = JPR::all();

        $total_pendapatan = Realisasi_kegiatan::where('id_laporankegiatan',$id)->where('tipe', 'm')->sum('nominal');

        $total_pengeluaran = Realisasi_kegiatan::where('id_laporankegiatan',$id)->where('tipe', 'k')->sum('nominal');

        return view('benadventure.laporan-kegiatan.laporan-kegiatan-realisasi',  compact('realisasi_kegiatan','jp','jpr','total_pendapatan','total_pengeluaran','data_realisasi','data_kegiatan','data'));
    }

    public function create($id)
    {
        $data = Laporan_kegiatan::findOrFail($id);
        $jenis_transaksikegiatan = Jenis_transaksikegiatan::pluck('nama_jenis', 'id');
        $daftar_laporankegiatan = Laporan_kegiatan::pluck('nama_pelanggan', 'id');
        return view('benadventure.laporan-kegiatan.laporan-kegiatan-realisasi-tambah', compact('jenis_transaksikegiatan','daftar_laporankegiatan','data'));
    }

    public function store(RealisasiKegiatanRequest $request, $id)
    {
    	$data = Laporan_kegiatan::findOrFail($id);
        $coba = Realisasi_kegiatan::create($request->all());
        // dd($coba);
        DB::table('notifications')->insert([
            'user_id' => Auth::user()->id,
            'tipe' => 'realisasi kegiatan',
            'pesan' => 'telah menginputkan',
            'id_tambahan' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Session::flash('pesan', 'Data Berhasil Disimpan');
        //return redirect('laporan-kegiatan/realisasi');
        return redirect()->route('lapkeg.index',$data->id);
    }

    public function edit($id)
    {
        $daftar_laporankegiatan = Laporan_kegiatan::pluck('nama_pelanggan', 'id');
        $jenis_transaksikegiatan = Jenis_transaksikegiatan::pluck('nama_jenis', 'id');
        $realisasi_kegiatan = Realisasi_kegiatan::findOrFail($id);
        return view('benadventure.laporan-kegiatan.laporan-kegiatan-realisasi-edit', compact('jenis_transaksikegiatan', 'realisasi_kegiatan','daftar_laporankegiatan')); 
    }

     public function update(RealisasiKegiatanRequest $request, $id)
    {
        $realisasi_kegiatan = Realisasi_kegiatan::findOrFail($id);
        $realisasi_kegiatan->update($request->all());
        $data = Laporan_kegiatan::pluck('id');
        //$data = Laporan_kegiatan::findOrFail($id);
        Session::flash('pesan', 'Data Berhasil Diupdate');
        return redirect('laporan-kegiatan');
        //return redirect()->route('lapkeg.index',$data->id);
    }

    public function destroy($id)
    {
        Realisasi_kegiatan::destroy($id);
        //$data = Laporan_kegiatan::findOrFail($id);
        Session::flash('pesan', 'Data Berhasil Dihapus');
        return redirect('laporan-kegiatan');
    }

    public function realisasi_kegiatanExcel(Request $request, $id)
    {
        return Excel::download(new RealisasiKegiatanExport($id), 'Realisasi.xlsx');
    }

    public function realisasi_kegiatanCetak($id)
    {
        $pdf = app('Fpdf');

        $pdf->AddPage('L', 'A4');

        //$mulai = date('Y-m-d',strtotime($request->mulai));
        //$selesai = date('Y-m-d',strtotime($request->selesai));

        $profil = Profil::findOrFail(1);
        $data = Laporan_kegiatan::findOrFail($id);
        $image = "assets/dist/img/logo.png";

        // Header
        $pdf->Image($image, 5, $pdf->GetX(), 23.78, 'T');

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $profil->nama_perusahaan, 0, 2, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Alamat : ".$profil->alamat_perusahaan." | Email : ".$profil->email, 'B', 2, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "REALISASI KEUANGAN KEGIATAN", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Nama Pelanggan  : ".$data->nama_pelanggan, 0, 2, 'L');
        $pdf->Cell(0, 10, "Nama Kegiatan  : ".$data->nama_kegiatan, 0, 2, 'L');
        
        // laporan realisasi keuangan kegiatan
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 10, "No", 1, 0, 'C');
        $pdf->Cell(61, 10, "Jenis Transaksi", 1, 0, 'C');
        $pdf->Cell(61, 10, "Keterangan", 1, 0, 'C');
        $pdf->Cell(63, 10, "Uang Masuk", 1, 0, 'C');
        $pdf->Cell(63, 10, "Uang Keluar", 1, 0, 'C');
        $pdf->Ln();

        $data_realisasi = Realisasi_kegiatan::where('id_laporankegiatan',$id)->get();
        $data_kegiatan = $data_realisasi;
        $realisasi_kegiatan = Realisasi_kegiatan::all();
        $jp = JP::all();
        $jpr = JPR::all();

        $total_pendapatan = Realisasi_kegiatan::where('id_laporankegiatan',$id)->where('tipe', 'm')->sum('nominal');

        $total_pengeluaran = Realisasi_kegiatan::where('id_laporankegiatan',$id)->where('tipe', 'k')->sum('nominal');

        $total_laba = $total_pendapatan - $total_pengeluaran;

        $pdf->SetFont('Arial', '', 11);

        $i = 1;
        foreach($data_kegiatan as $p)
        {
            $pdf->Cell(20, 10, $i++, 1, 0, 'C');
            $pdf->Cell(61, 10, $p->jenis_transaksikegiatan->nama_jenis, 1, 0, 'C');
            $pdf->Cell(61, 10, $p->keterangan, 1, 0, 'C');
            if($p->tipe === 'm') $pdf->Cell(63, 10, 'Rp. '.number_format($p->nominal, 0, ',', '.').',-', 1, 0, 'C');
            else $pdf->Cell(63, 10, '-', 1, 0, 'C');
            if($p->tipe === 'k') $pdf->Cell(63, 10,'Rp. '.number_format($p->nominal, 0, ',', '.').',-', 1, 0, 'C');
            else $pdf->Cell(63, 10, '-', 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(142, 10, 'Total', 1, 0, 'C');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(63, 10, 'Rp. '. number_format($total_pendapatan, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Cell(63, 10, 'Rp. '. number_format($total_pengeluaran, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(205, 10, 'TOTAL LABA', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(63, 10, 'Rp. '. number_format($total_laba, 0, ',', '.') . ',-', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(35, 10, 'TERBILANG', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(233, 10, strtoupper(terbilang($total_laba)).' RUPIAH', 1, 0, 'C');
        $pdf->Ln();

        // Footer
        $pdf->SetY(179);
        $pdf->SetX(175);
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,"Dicetak Oleh Akuntan : ". $profil->nama_perusahaan ." Pada ".date("d-m-Y H:i:s")
        ." WIB",0,0,'C');

        
        // Save
        Session::flash('pesan', 'Realisasi Keuangan Kegiatan Berhasil Diunduh');
        return $pdf->Output('D', "Realisasi Keuangan Kegiatan".$data->nama_pelanggan. ".pdf"); 
    }
}
