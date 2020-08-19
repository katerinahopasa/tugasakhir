<?php

use Illuminate\Database\Seeder;

class Jurnaltambahan2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('jurnals')->insert([
            ['keterangan' => 'sewa tenda an. Elfa', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 132000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. Elfa', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 132000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'sewa tenda an. Eca', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 25000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. Eca', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 25000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'sewa tenda an. Tonho', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 375000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. Tonho', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 375000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'sewa tenda an. Hari', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 40000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. Hari', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 40000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'beli besi patok', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 32000, 'tipe' => 'd', 'id_akun' => 115],
            ['keterangan' => 'beli besi patok', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 32000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'beli busi mesin babat', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 30000, 'tipe' => 'd', 'id_akun' => 118],
            ['keterangan' => 'beli busi mesin babat', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 30000, 'tipe' => 'k', 'id_akun' => 1],
            
            ['keterangan' => 'sewa tenda an. Aji', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 30000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. Aji', 'waktu_transaksi' => '2019-01-01', 'jenis_jurnal' => 'u', 'nominal' => 30000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'beli frame', 'waktu_transaksi' => '2019-01-03', 'jenis_jurnal' => 'u', 'nominal' => 130000, 'tipe' => 'd', 'id_akun' => 115],
            ['keterangan' => 'beli frame', 'waktu_transaksi' => '2019-01-03', 'jenis_jurnal' => 'u', 'nominal' => 130000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'prepare kegiatan', 'waktu_transaksi' => '2019-01-03', 'jenis_jurnal' => 'u', 'nominal' => 323000, 'tipe' => 'd', 'id_akun' => 87],
            ['keterangan' => 'prepare kegiatan', 'waktu_transaksi' => '2019-01-03', 'jenis_jurnal' => 'u', 'nominal' => 323000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'outbond Setda Clp', 'waktu_transaksi' => '2019-01-04', 'jenis_jurnal' => 'u', 'nominal' => 629000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'outbond Setda Clp', 'waktu_transaksi' => '2019-01-04', 'jenis_jurnal' => 'u', 'nominal' => 629000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => 'outbond UPK Cilongok', 'waktu_transaksi' => '2019-01-05', 'jenis_jurnal' => 'u', 'nominal' => 1629000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'outbond UPK Cilongok', 'waktu_transaksi' => '2019-01-05', 'jenis_jurnal' => 'u', 'nominal' => 1629000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => 'sewa kasur ke Villa Bayan', 'waktu_transaksi' => '2019-01-05', 'jenis_jurnal' => 'u', 'nominal' => 175000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa kasur ke Villa Bayan', 'waktu_transaksi' => '2019-01-05', 'jenis_jurnal' => 'u', 'nominal' => 175000, 'tipe' => 'k', 'id_akun' => 67],

            ['keterangan' => 'beli notebook', 'waktu_transaksi' => '2019-01-07', 'jenis_jurnal' => 'u', 'nominal' => 5460000, 'tipe' => 'd', 'id_akun' => 30],
            ['keterangan' => 'transport', 'waktu_transaksi' => '2019-01-07', 'jenis_jurnal' => 'u', 'nominal' => 5460000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'biaya ganti resleting', 'waktu_transaksi' => '2019-01-09', 'jenis_jurnal' => 'u', 'nominal' => 15000, 'tipe' => 'd', 'id_akun' => 115],
            ['keterangan' => 'biaya ganti resleting', 'waktu_transaksi' => '2019-01-09', 'jenis_jurnal' => 'u', 'nominal' => 15000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'beli lakban', 'waktu_transaksi' => '2019-01-10', 'jenis_jurnal' => 'u', 'nominal' => 16000, 'tipe' => 'd', 'id_akun' => 108],
            ['keterangan' => 'beli lakban', 'waktu_transaksi' => '2019-01-10', 'jenis_jurnal' => 'u', 'nominal' => 16000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'sharing outbond Serang Adventure', 'waktu_transaksi' => '2019-01-13', 'jenis_jurnal' => 'u', 'nominal' => 450000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sharing outbond Serang Adventure 50', 'waktu_transaksi' => '2019-01-13', 'jenis_jurnal' => 'u', 'nominal' => 450000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => '', 'waktu_transaksi' => '2019-01-18', 'jenis_jurnal' => 'u', 'nominal' => 200000, 'tipe' => 'd', 'id_akun' => 17],
            ['keterangan' => '', 'waktu_transaksi' => '2019-01-18', 'jenis_jurnal' => 'u', 'nominal' => 200000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'prepare kegiatan', 'waktu_transaksi' => '2019-01-21', 'jenis_jurnal' => 'u', 'nominal' => 50000, 'tipe' => 'd', 'id_akun' => 87],
            ['keterangan' => 'prepare kegiatan 50', 'waktu_transaksi' => '2019-01-21', 'jenis_jurnal' => 'u', 'nominal' => 50000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'outbond SD IT HB', 'waktu_transaksi' => '2019-01-23', 'jenis_jurnal' => 'u', 'nominal' => 1760000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'outbond SD IT HB 50 (78)', 'waktu_transaksi' => '2019-01-23', 'jenis_jurnal' => 'u', 'nominal' => 1760000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => 'bensin mesin babat', 'waktu_transaksi' => '2019-01-26', 'jenis_jurnal' => 'u', 'nominal' => 20000, 'tipe' => 'd', 'id_akun' => 120],
            ['keterangan' => 'bensin mesin babat 50 (78)', 'waktu_transaksi' => '2019-01-26', 'jenis_jurnal' => 'u', 'nominal' => 20000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => '', 'waktu_transaksi' => '2019-01-27', 'jenis_jurnal' => 'u', 'nominal' => 50000, 'tipe' => 'd', 'id_akun' => 17],
            ['keterangan' => '', 'waktu_transaksi' => '2019-01-27', 'jenis_jurnal' => 'u', 'nominal' => 50000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'sewa tempat an. Smart Tegal', 'waktu_transaksi' => '2019-01-27', 'jenis_jurnal' => 'u', 'nominal' => 200000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tempat an. Smart Tegal', 'waktu_transaksi' => '2019-01-27', 'jenis_jurnal' => 'u', 'nominal' => 200000, 'tipe' => 'k', 'id_akun' => 69],

            ['keterangan' => 'lampu sekre', 'waktu_transaksi' => '2019-01-30', 'jenis_jurnal' => 'u', 'nominal' => 75000, 'tipe' => 'd', 'id_akun' => 106],
            ['keterangan' => 'lampu sekre', 'waktu_transaksi' => '2019-01-30', 'jenis_jurnal' => 'u', 'nominal' => 75000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => '', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 2550000, 'tipe' => 'd', 'id_akun' => 76],
            ['keterangan' => '', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 2550000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => '', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 400000, 'tipe' => 'd', 'id_akun' => 107],
            ['keterangan' => '', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 400000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'asuransi jasaraharja', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 192000, 'tipe' => 'd', 'id_akun' => 103],
            ['keterangan' => 'asuransi jasaraharja', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 192000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'BPJS TK (6 crew; 3 Dalam, 3 Luar)', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 220800, 'tipe' => 'd', 'id_akun' => 78],
            ['keterangan' => 'BPJS TK (6 crew; 3 Dalam, 3 Luar)', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 220800, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'servis printer', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 75000, 'tipe' => 'd', 'id_akun' => 117],
            ['keterangan' => 'servis printer', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 75000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'servis printer', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 250000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'servis printer', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'u', 'nominal' => 250000, 'tipe' => 'k', 'id_akun' => 17],

            ['keterangan' => 'penyusutan notebook', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'p', 'nominal' => 91000, 'tipe' => 'd', 'id_akun' => 101],
            ['keterangan' => 'penyusutan notebook', 'waktu_transaksi' => '2019-01-31', 'jenis_jurnal' => 'p', 'nominal' => 91000, 'tipe' => 'k', 'id_akun' => 37],

        ]);    
    }
}
