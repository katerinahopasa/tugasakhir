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

class NeracalaporanExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
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

    public function dapatAktiva($value, $waktu)
     {
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));
        $coba        = DB::table("akun as a")
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

     public function dapatAktivaTetap($value, $waktu)
     {
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));
        $coba   = DB::table("akun as a")
                ->join("Jurnals as jun","a.id","=","jun.id_akun")
                ->where("a.jenis_akun",$value)
                ->whereMonth('waktu_transaksi', $bulan)
                ->whereYear('waktu_transaksi', $tahun)
                ->get();

        return $coba;

     }

     public function dapatPasiva($value, $waktu)
     {
        $bulan = date('m', strtotime($waktu));
        $tahun = date('Y', strtotime($waktu));
        $periode = date('F Y', strtotime($waktu));  
        $coba        = DB::table("akun as a")
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

            $aktiva_lancar = $this->dapatAktiva("aktiva_lancar", $waktu);
            // dd($aktiva_lancar);

            $aktiva_tetap = $this->dapatAktivaTetap("aktiva_tetap", $waktu);
            // dd($aktiva_tetap);
            $jumlah_aktiva_tetap = $this->dapatAktiva("aktiva_tetap", $waktu);
            // dd($aktiva_tetap);

            $pasiva = $this->dapatPasiva("pasiva", $waktu);
            // dd($pasiva);

            $ekuitas = $this->dapatPasiva("ekuitas", $waktu);

    	return view('benadventure.laporan.neraca-laporan_excel', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'periode' => $periode,
            'data_akunpendapatan' => $data_akunpendapatan,
            'data_akunbeban' => $data_akunbeban,
            'total_pendapatan' => $total_pendapatan,
            'total_beban' => $total_beban,
            'laba_bersih' => $laba_bersih,
            'aktiva_lancar' => $aktiva_lancar,
            'aktiva_tetap' => $aktiva_tetap,
            'jumlah_aktiva_tetap' => $jumlah_aktiva_tetap,
            'pasiva' => $pasiva,
            'ekuitas' => $ekuitas

        ]);
    }

}
