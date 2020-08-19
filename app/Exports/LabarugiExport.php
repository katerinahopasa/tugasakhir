<?php

namespace App\Exports;

use App\Pemasukan;
use App\Pengeluaran;
use App\Estimasiakhirlaporan;
use DB;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class LabarugiExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    private $waktu;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function drawings()
    {
        $drawings = new Drawing();
        $drawings->setName('Logo');
        $drawings->setDescription('Logo Pokdarwis');
        $drawings->setPath(public_path('/logo.png'));
        $drawings->setHeight(90);
        $drawings->setCoordinates('A1');

        return $drawings;
    }

    public function __construct($waktu) 
    {
        $this->waktu = $waktu;
          
    }

   
    public function registerEvents(): array
    {
         $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FFFF0000'],
                ],
            ],
        ];

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }


    public function view(): View
    {
            $waktu = $this->waktu;
            // dd($waktu);
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

    	return view('benadventure.laporan.labarugi_excel', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'periode' => $periode,
            'data_akunpendapatan' => $data_akunpendapatan,
            'data_akunbeban' => $data_akunbeban,
            'total_pendapatan' => $total_pendapatan,
            'total_beban' => $total_beban,
            'laba_bersih' => $laba_bersih
        ]);
    }

}
