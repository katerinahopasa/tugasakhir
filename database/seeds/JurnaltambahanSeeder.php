<?php

use Illuminate\Database\Seeder;

class JurnaltambahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurnals')->insert([
            ['keterangan' => 'sewa kasur an. Villa Bayan', 'waktu_transaksi' => '2019-12-08', 'jenis_jurnal' => 'u', 'nominal' => 150000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Modal tn sanjaya', 'waktu_transaksi' => '2019-12-08', 'jenis_jurnal' => 'u', 'nominal' => 150000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'sewa tenda an. Ari FPTI', 'waktu_transaksi' => '2019-12-19', 'jenis_jurnal' => 'u', 'nominal' => 180000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. Ari FPTI', 'waktu_transaksi' => '2019-12-19', 'jenis_jurnal' => 'u', 'nominal' => 180000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'sewa listrik (helda)', 'waktu_transaksi' => '2019-12-23', 'jenis_jurnal' => 'u', 'nominal' => 30000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'sewa listrik (helda)', 'waktu_transaksi' => '2019-12-23', 'jenis_jurnal' => 'u', 'nominal' => 30000, 'tipe' => 'd', 'id_akun' => 70],

            ['keterangan' => 'sewa tempat an. Jawapala ', 'waktu_transaksi' => '2019-12-23', 'jenis_jurnal' => 'u', 'nominal' => 50000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'sewa tempat an. Jawapala ', 'waktu_transaksi' => '2019-12-23', 'jenis_jurnal' => 'u', 'nominal' => 50000, 'tipe' => 'd', 'id_akun' => 69],

            ['keterangan' => 'sewa tenda dll an. Lugi setiawan', 'waktu_transaksi' => '2019-12-31', 'jenis_jurnal' => 'u', 'nominal' => 45000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda dll an. Lugi setiawan', 'waktu_transaksi' => '2019-12-31', 'jenis_jurnal' => 'u', 'nominal' => 45000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'sharing limpakuwus project', 'waktu_transaksi' => '2019-12-1', 'jenis_jurnal' => 'u', 'nominal' => 2500000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sharing limpakuwus project', 'waktu_transaksi' => '2019-12-1', 'jenis_jurnal' => 'u', 'nominal' => 2500000, 'tipe' => 'k', 'id_akun' => 73],

            ['keterangan' => 'outbond smk muh 1 kulonprogo', 'waktu_transaksi' => '2019-12-10', 'jenis_jurnal' => 'u', 'nominal' => 1130000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'outbond smk muh 1 kulonprogo', 'waktu_transaksi' => '2019-12-10', 'jenis_jurnal' => 'u', 'nominal' => 1130000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => 'outbond kebidanan poltekkes smg', 'waktu_transaksi' => '2019-12-21', 'jenis_jurnal' => 'u', 'nominal' => 1030000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'outbond kebidanan poltekkes smg', 'waktu_transaksi' => '2019-12-21', 'jenis_jurnal' => 'u', 'nominal' => 1030000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => 'sewa tenda an. FPTI', 'waktu_transaksi' => '2019-12-21', 'jenis_jurnal' => 'u', 'nominal' => 180000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tenda an. FPTI', 'waktu_transaksi' => '2019-12-21', 'jenis_jurnal' => 'u', 'nominal' => 180000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'outbond @ MORSE', 'waktu_transaksi' => '2019-12-25', 'jenis_jurnal' => 'u', 'nominal' => 410000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'outbond @ MORSE', 'waktu_transaksi' => '2019-12-25', 'jenis_jurnal' => 'u', 'nominal' => 410000, 'tipe' => 'k', 'id_akun' => 63],

            ['keterangan' => 'sewa tempat an. Yayasan Al Kahfi', 'waktu_transaksi' => '2019-12-28', 'jenis_jurnal' => 'u', 'nominal' => 300000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'sewa tempat an. Yayasan Al Kahfi', 'waktu_transaksi' => '2019-12-28', 'jenis_jurnal' => 'u', 'nominal' => 300000, 'tipe' => 'k', 'id_akun' => 68],

            ['keterangan' => 'beban gaji karyawan', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 2700000, 'tipe' => 'k', 'id_akun' => 76],
            ['keterangan' => 'beban gaji karyawan', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 2700000, 'tipe' => 'd', 'id_akun' => 1],

            ['keterangan' => 'beban gaji administrasi', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 400000, 'tipe' => 'k', 'id_akun' => 107],
            ['keterangan' => 'beban gaji administrasi', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 400000, 'tipe' => 'd', 'id_akun' => 1],

            ['keterangan' => 'BPJS TK (6 crew; 3 Dalam, 3 Luar)', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 220800, 'tipe' => 'k', 'id_akun' => 78],
            ['keterangan' => 'BPJS TK (6 crew; 3 Dalam, 3 Luar)', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 220800, 'tipe' => 'd', 'id_akun' => 1],

            ['keterangan' => 'asuransi jasaraharja', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 95000, 'tipe' => 'k', 'id_akun' => 103],
            ['keterangan' => 'asuransi jasaraharja', 'waktu_transaksi' => '2019-12-29', 'jenis_jurnal' => 'u', 'nominal' => 95000, 'tipe' => 'd', 'id_akun' => 1],
        ]);
    }
}
