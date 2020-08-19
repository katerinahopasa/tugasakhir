<?php

use Illuminate\Database\Seeder;

class JurnalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('jurnals')->insert([
            ['keterangan' => 'Modal tn sanjaya', 'waktu_transaksi' => '2020-06-01', 'jenis_jurnal' => 'u', 'nominal' => 45000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Modal tn sanjaya', 'waktu_transaksi' => '2020-06-01', 'jenis_jurnal' => 'u', 'nominal' => 45000000, 'tipe' => 'k', 'id_akun' => 50],
            ['keterangan' => 'Hutang Bank BCA', 'waktu_transaksi' => '2020-06-04', 'jenis_jurnal' => 'u', 'nominal' => 25000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Hutang Bank BCA', 'waktu_transaksi' => '2020-06-04', 'jenis_jurnal' => 'u', 'nominal' => 25000000, 'tipe' => 'k', 'id_akun' => 41],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-06', 'jenis_jurnal' => 'u', 'nominal' => 7000000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Perlenkapan', 'waktu_transaksi' => '2020-06-06', 'jenis_jurnal' => 'u', 'nominal' => 7000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'prive', 'waktu_transaksi' => '2020-06-01', 'jenis_jurnal' => 'u', 'nominal' => 5000000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'prive', 'waktu_transaksi' => '2020-06-01', 'jenis_jurnal' => 'u', 'nominal' => 5000000, 'tipe' => 'd', 'id_akun' => 57],
            ['keterangan' => 'perlengkapan', 'waktu_transaksi' => '2020-06-12', 'jenis_jurnal' => 'u', 'nominal' => 20000000, 'tipe' => 'd', 'id_akun' => 27],
            ['keterangan' => 'Hutang Usaha', 'waktu_transaksi' => '2020-06-12', 'jenis_jurnal' => 'u', 'nominal' => 20000000, 'tipe' => 'k', 'id_akun' => 41],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-15', 'jenis_jurnal' => 'u', 'nominal' => 15000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pendapatan Jasa', 'waktu_transaksi' => '2020-06-15', 'jenis_jurnal' => 'u', 'nominal' => 15000000, 'tipe' => 'k', 'id_akun' => 71],
            ['keterangan' => 'Hutang Usaha', 'waktu_transaksi' => '2020-06-17', 'jenis_jurnal' => 'u', 'nominal' => 9700000, 'tipe' => 'd', 'id_akun' => 41],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-17', 'jenis_jurnal' => 'u', 'nominal' => 9700000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'Beban Gaji', 'waktu_transaksi' => '2020-06-25', 'jenis_jurnal' => 'u', 'nominal' => 6200000, 'tipe' => 'd', 'id_akun' => 76],
            ['keterangan' => 'Beban Gaji', 'waktu_transaksi' => '2020-06-25', 'jenis_jurnal' => 'u', 'nominal' => 6200000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Piutang Usaha', 'waktu_transaksi' => '2020-06-26', 'jenis_jurnal' => 'u', 'nominal' => 11000000, 'tipe' => 'd', 'id_akun' => 16],
            ['keterangan' => 'Piutang Usaha', 'waktu_transaksi' => '2020-06-26', 'jenis_jurnal' => 'u', 'nominal' => 11000000, 'tipe' => 'k', 'id_akun' => 73],
            ['keterangan' => 'Beban Perlengkapan', 'waktu_transaksi' => '2020-06-27', 'jenis_jurnal' => 'p', 'nominal' => 8000000, 'tipe' => 'd', 'id_akun' => 104],
            ['keterangan' => 'Beban Perlengkapan', 'waktu_transaksi' => '2020-06-27', 'jenis_jurnal' => 'p', 'nominal' => 8000000, 'tipe' => 'k', 'id_akun' => 26],
            ['keterangan' => 'Beban Listrik', 'waktu_transaksi' => '2020-06-29', 'jenis_jurnal' => 'u', 'nominal' => 600000, 'tipe' => 'd', 'id_akun' => 83],
            ['keterangan' => 'Beban Air', 'waktu_transaksi' => '2020-06-29', 'jenis_jurnal' => 'u', 'nominal' => 120000, 'tipe' => 'd', 'id_akun' => 84],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-29', 'jenis_jurnal' => 'u', 'nominal' => 720000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Sewa Dibayar dimuka', 'waktu_transaksi' => '2020-06-30', 'jenis_jurnal' => 'u', 'nominal' => 15000000, 'tipe' => 'd', 'id_akun' => 21],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-30', 'jenis_jurnal' => 'u', 'nominal' => 15000000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'beban sewa lainnya', 'waktu_transaksi' => '2020-06-30', 'jenis_jurnal' => 'p', 'nominal' => 7500000, 'tipe' => 'd', 'id_akun' => 95],
            ['keterangan' => 'Sewa Dibayar dimuka', 'waktu_transaksi' => '2020-06-30', 'jenis_jurnal' => 'p', 'nominal' => 7500000, 'tipe' => 'k', 'id_akun' => 21],
        ]);
    }
}
