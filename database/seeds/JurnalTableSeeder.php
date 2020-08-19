<?php

use Illuminate\Database\Seeder;

class JurnalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('jurnal')->insert([
            ['keterangan' => 'Setoran Modal Saham', 'waktu_transaksi' => '2018-04-01', 'nominal' => 150000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pinjaman Bank', 'waktu_transaksi' => '2018-04-07', 'nominal' => 60000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pendapatan Jasa', 'waktu_transaksi' => '2018-04-12', 'nominal' => 9000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Gaji & Upah April 2018', 'waktu_transaksi' => '2018-04-25', 'nominal' => 3500000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Listrik, Minyak DLL', 'waktu_transaksi' => '2018-04-25', 'nominal' => 2300000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Bunga Bank April 2018', 'waktu_transaksi' => '2018-04-25', 'nominal' => 1200000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Pembayaran Utang', 'waktu_transaksi' => '2018-04-26', 'nominal' => 1000000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Penerimaan Piutang', 'waktu_transaksi' => '2018-04-28', 'nominal' => 1200000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pembagian Dividen', 'waktu_transaksi' => '2018-04-30', 'nominal' => 5000000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'PT. Jaya Makmur', 'waktu_transaksi' => '2018-04-12', 'nominal' => 20000000, 'tipe' => 'd', 'id_akun' => 2],
            ['keterangan' => 'Pembayaran Sebagian', 'waktu_transaksi' => '2018-04-28', 'nominal' => 12000000, 'tipe' => 'k', 'id_akun' => 2],

            ['keterangan' => 'Pembelian Peralatan', 'waktu_transaksi' => '2018-04-06', 'nominal' => 17000000, 'tipe' => 'd', 'id_akun' => 3],
            ['keterangan' => 'Tambahan Uang Alat', 'waktu_transaksi' => '2018-04-06', 'nominal' => 1800000, 'tipe' => 'd', 'id_akun' => 3],
            
            ['keterangan' => 'Setoran Modal', 'waktu_transaksi' => '2018-04-05', 'nominal' => 250000000, 'tipe' => 'd', 'id_akun' => 4],
            
            ['keterangan' => 'Setoran Modal', 'waktu_transaksi' => '2018-04-05', 'nominal' => 200000000, 'tipe' => 'd', 'id_akun' => 5],

            ['keterangan' => 'Pembelian Peralatan', 'waktu_transaksi' => '2018-04-06', 'nominal' => 17000000, 'tipe' => 'k', 'id_akun' => 6],
            ['keterangan' => 'Pembayaran Sebagian', 'waktu_transaksi' => '2018-04-10', 'nominal' => 10000000, 'tipe' => 'd', 'id_akun' => 6],

            ['keterangan' => 'Siti Bank', 'waktu_transaksi' => '2018-04-07', 'nominal' => 60000000, 'tipe' => 'k', 'id_akun' => 7],

            ['keterangan' => 'Setoran Tunai, Aldrin', 'waktu_transaksi' => '2018-04-01', 'nominal' => 150000000, 'tipe' => 'k', 'id_akun' => 8],
            ['keterangan' => 'Setoran Ruko, Aldrin', 'waktu_transaksi' => '2018-04-05', 'nominal' => 250000000, 'tipe' => 'k', 'id_akun' => 8],
            ['keterangan' => 'Setoran Tanah, Aldrin', 'waktu_transaksi' => '2018-04-05', 'nominal' => 200000000, 'tipe' => 'k', 'id_akun' => 8],

            ['keterangan' => 'PT. Duta Niaga', 'waktu_transaksi' => '2018-04-12', 'nominal' => 9000000, 'tipe' => 'k', 'id_akun' => 9],
            ['keterangan' => 'PT. Jaya Makmur', 'waktu_transaksi' => '2018-04-12', 'nominal' => 20000000, 'tipe' => 'k', 'id_akun' => 9],

            ['keterangan' => 'Gaji Bulan April 2018', 'waktu_transaksi' => '2018-04-25', 'nominal' => 3500000, 'tipe' => 'd', 'id_akun' => 10],

            ['keterangan' => 'Listrik, Minyak DLL', 'waktu_transaksi' => '2018-04-25', 'nominal' => 2300000, 'tipe' => 'd', 'id_akun' => 11],

            ['keterangan' => 'Bunga Bulan April 2018', 'waktu_transaksi' => '2018-04-25', 'nominal' => 1200000, 'tipe' => 'd', 'id_akun' => 12],

            ['keterangan' => 'Dividen Tunai', 'waktu_transaksi' => '2018-04-30', 'nominal' => 5000000, 'tipe' => 'd', 'id_akun' => 13],

            


            ['keterangan' => 'Setoran Modal Saham', 'waktu_transaksi' => '2018-05-01', 'nominal' => 100000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pinjaman Bank', 'waktu_transaksi' => '2018-05-07', 'nominal' => 75000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pendapatan Jasa', 'waktu_transaksi' => '2018-05-12', 'nominal' => 25000000, 'tipe' => 'd', 'id_akun' => 1],

            ['keterangan' => 'Gaji & Upah April 2018', 'waktu_transaksi' => '2018-05-25', 'nominal' => 3500000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Listrik, Minyak DLL', 'waktu_transaksi' => '2018-05-25', 'nominal' => 2300000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Bunga Bank April 2018', 'waktu_transaksi' => '2018-05-25', 'nominal' => 1200000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Pembayaran Utang', 'waktu_transaksi' => '2018-05-26', 'nominal' => 1000000, 'tipe' => 'k', 'id_akun' => 1],
            
            ['keterangan' => 'Penerimaan Piutang', 'waktu_transaksi' => '2018-05-28', 'nominal' => 1200000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pembagian Dividen', 'waktu_transaksi' => '2018-05-30', 'nominal' => 5000000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'PT. Jaya Makmur', 'waktu_transaksi' => '2018-05-12', 'nominal' => 20000000, 'tipe' => 'd', 'id_akun' => 2],
            ['keterangan' => 'Pembayaran Sebagian', 'waktu_transaksi' => '2018-05-28', 'nominal' => 12000000, 'tipe' => 'k', 'id_akun' => 2],

            ['keterangan' => 'Pembelian Peralatan', 'waktu_transaksi' => '2018-05-06', 'nominal' => 17000000, 'tipe' => 'd', 'id_akun' => 3],
            ['keterangan' => 'Jual Aset AC', 'waktu_transaksi' => '2018-05-06', 'nominal' => 20800000, 'tipe' => 'd', 'id_akun' => 3],
            
            ['keterangan' => 'Setoran Modal', 'waktu_transaksi' => '2018-05-05', 'nominal' => 250000000, 'tipe' => 'd', 'id_akun' => 4],
            
            ['keterangan' => 'Pembelian Peralatan', 'waktu_transaksi' => '2018-05-06', 'nominal' => 17000000, 'tipe' => 'k', 'id_akun' => 6],

            ['keterangan' => 'Setoran Tunai, Aldrin', 'waktu_transaksi' => '2018-05-01', 'nominal' => 150000000, 'tipe' => 'k', 'id_akun' => 8],
            ['keterangan' => 'Setoran Ruko, Aldrin', 'waktu_transaksi' => '2018-05-05', 'nominal' => 250000000, 'tipe' => 'k', 'id_akun' => 8],
            ['keterangan' => 'Setoran Tanah, Aldrin', 'waktu_transaksi' => '2018-05-05', 'nominal' => 200000000, 'tipe' => 'k', 'id_akun' => 8],

            ['keterangan' => 'PT. Duta Niaga', 'waktu_transaksi' => '2018-05-12', 'nominal' => 9000000, 'tipe' => 'k', 'id_akun' => 9],
            ['keterangan' => 'PT. Jaya Makmur', 'waktu_transaksi' => '2018-05-12', 'nominal' => 20000000, 'tipe' => 'k', 'id_akun' => 9],

            ['keterangan' => 'Gaji Bulan April 2018', 'waktu_transaksi' => '2018-05-25', 'nominal' => 3500000, 'tipe' => 'd', 'id_akun' => 10],

            ['keterangan' => 'Listrik, Minyak DLL', 'waktu_transaksi' => '2018-05-25', 'nominal' => 2300000, 'tipe' => 'd', 'id_akun' => 11],

            ['keterangan' => 'Bunga Bulan April 2018', 'waktu_transaksi' => '2018-05-25', 'nominal' => 1200000, 'tipe' => 'd', 'id_akun' => 12],

            ['keterangan' => 'Dividen Tunai', 'waktu_transaksi' => '2018-05-30', 'nominal' => 5000000, 'tipe' => 'd', 'id_akun' => 13],

            ['keterangan' => 'Modal tn sanjaya', 'waktu_transaksi' => '2020-06-01', 'nominal' => 45000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Modal tn sanjaya', 'waktu_transaksi' => '2020-06-01', 'nominal' => 45000000, 'tipe' => 'k', 'id_akun' => 50],
            ['keterangan' => 'Hutang Bank BCA', 'waktu_transaksi' => '2020-06-04', 'nominal' => 25000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Hutang Bank BCA', 'waktu_transaksi' => '2020-06-04', 'nominal' => 25000000, 'tipe' => 'k', 'id_akun' => 41],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-06', 'nominal' => 7000000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Perlenkapan', 'waktu_transaksi' => '2020-06-06', 'nominal' => 7000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'prive', 'waktu_transaksi' => '2020-06-01', 'nominal' => 5000000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'prive', 'waktu_transaksi' => '2020-06-01', 'nominal' => 5000000, 'tipe' => 'd', 'id_akun' => 57],
            ['keterangan' => 'perlengkapan', 'waktu_transaksi' => '2020-06-12', 'nominal' => 20000000, 'tipe' => 'd', 'id_akun' => 27],
            ['keterangan' => 'Hutang Usaha', 'waktu_transaksi' => '2020-06-12', 'nominal' => 20000000, 'tipe' => 'k', 'id_akun' => 41],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-15', 'nominal' => 15000000, 'tipe' => 'd', 'id_akun' => 1],
            ['keterangan' => 'Pendapatan Jasa', 'waktu_transaksi' => '2020-06-15',  'nominal' => 15000000, 'tipe' => 'k', 'id_akun' => 71],
            ['keterangan' => 'Hutang Usaha', 'waktu_transaksi' => '2020-06-17', 'nominal' => 9700000, 'tipe' => 'd', 'id_akun' => 41],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-17', 'nominal' => 9700000, 'tipe' => 'k', 'id_akun' => 1],

            ['keterangan' => 'Beban Gaji', 'waktu_transaksi' => '2020-06-25', 'nominal' => 6200000, 'tipe' => 'd', 'id_akun' => 76],
            ['keterangan' => 'Beban Gaji', 'waktu_transaksi' => '2020-06-25', 'nominal' => 6200000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Piutang Usaha', 'waktu_transaksi' => '2020-06-26', 'nominal' => 11000000, 'tipe' => 'd', 'id_akun' => 16],
            ['keterangan' => 'Piutang Usaha', 'waktu_transaksi' => '2020-06-26', 'nominal' => 11000000, 'tipe' => 'k', 'id_akun' => 73],
            ['keterangan' => 'Beban Perlengkapan', 'waktu_transaksi' => '2020-06-27', 'nominal' => 8000000, 'tipe' => 'd', 'id_akun' => 104],
            ['keterangan' => 'Beban Perlengkapan', 'waktu_transaksi' => '2020-06-27', 'nominal' => 8000000, 'tipe' => 'k', 'id_akun' => 26],
            ['keterangan' => 'Beban Listrik', 'waktu_transaksi' => '2020-06-29', 'nominal' => 600000, 'tipe' => 'd', 'id_akun' => 83],
            ['keterangan' => 'Beban Air', 'waktu_transaksi' => '2020-06-29', 'nominal' => 120000, 'tipe' => 'd', 'id_akun' => 84],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-29', 'nominal' => 720000, 'tipe' => 'k', 'id_akun' => 1],
            ['keterangan' => 'Sewa Dibayar dimuka', 'waktu_transaksi' => '2020-06-30', 'nominal' => 15000000, 'tipe' => 'd', 'id_akun' => 21],
            ['keterangan' => 'Kas', 'waktu_transaksi' => '2020-06-30', 'nominal' => 15000000, 'tipe' => 'k', 'id_akun' => 1],
        ]);

        $this->command->info('Berhasil Menambahkan Beberapa Jurnal Umum');
    }
}
