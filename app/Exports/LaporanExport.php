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

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class LaporanExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{

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
        $mulai = request()->all();
        $selesai = request()->all();

    

        $pemasukan = Pemasukan::whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $pengeluaran = Pengeluaran::whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->get();

        $total_pemasukan = Pemasukan::whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('total_pemasukan');

        $total_pengeluaran = Pengeluaran::whereBetween('tanggal',[$mulai,$selesai])->orderBy('tanggal', 'ASC')->sum('nominal');

        $total_pemasukan_bersih = $total_pemasukan - $total_pengeluaran;

    	return view('benharian.laporan.laporan_excel', [
            'mulai' => $mulai,
            'selesai' => $selesai,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'total_pemasukan_bersih' => $total_pemasukan_bersih

        ]);
    }
}
