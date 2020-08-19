<?php

use Illuminate\Database\Seeder;

class PengeluaranHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengeluaran')->insert([
            ['tanggal' => '2020-07-01', 'nama_pengeluaran' => 'logistik', 'nominal' => '57000', 'keterangan' => 'oke', 'bukti_pembayaran' => ''], 
            ['tanggal' => '2020-07-02', 'nama_pengeluaran' => 'logistik', 'nominal' => '50000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-03', 'nama_pengeluaran' => 'logistik', 'nominal' => '27000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-04', 'nama_pengeluaran' => 'logistik', 'nominal' => '40000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-05', 'nama_pengeluaran' => 'logistik', 'nominal' => '23000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-06', 'nama_pengeluaran' => 'logistik', 'nominal' => '35000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-07', 'nama_pengeluaran' => 'logistik', 'nominal' => '17000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-08', 'nama_pengeluaran' => 'logistik', 'nominal' => '42000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-09', 'nama_pengeluaran' => 'logistik', 'nominal' => '46000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-10', 'nama_pengeluaran' => 'logistik', 'nominal' => '24000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-11', 'nama_pengeluaran' => 'logistik', 'nominal' => '28000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-12', 'nama_pengeluaran' => 'logistik', 'nominal' => '29000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-13', 'nama_pengeluaran' => 'logistik', 'nominal' => '35000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-14', 'nama_pengeluaran' => 'logistik', 'nominal' => '25000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-15', 'nama_pengeluaran' => 'logistik', 'nominal' => '54000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-16', 'nama_pengeluaran' => 'logistik', 'nominal' => '73000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-17', 'nama_pengeluaran' => 'logistik', 'nominal' => '36000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-18', 'nama_pengeluaran' => 'logistik', 'nominal' => '46000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-19', 'nama_pengeluaran' => 'logistik', 'nominal' => '28000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-20', 'nama_pengeluaran' => 'logistik', 'nominal' => '30000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-20', 'nama_pengeluaran' => 'logistik', 'nominal' => '70000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-21', 'nama_pengeluaran' => 'logistik', 'nominal' => '22000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-22', 'nama_pengeluaran' => 'logistik', 'nominal' => '40000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-23', 'nama_pengeluaran' => 'logistik', 'nominal' => '37000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-24', 'nama_pengeluaran' => 'logistik', 'nominal' => '44000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-25', 'nama_pengeluaran' => 'logistik', 'nominal' => '41000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-26', 'nama_pengeluaran' => 'logistik', 'nominal' => '24000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-27', 'nama_pengeluaran' => 'logistik', 'nominal' => '40000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
            ['tanggal' => '2020-07-28', 'nama_pengeluaran' => 'logistik', 'nominal' => '22500', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],  
            ['tanggal' => '2020-07-29', 'nama_pengeluaran' => 'logistik', 'nominal' => '35000', 'keterangan' => 'ok', 'bukti_pembayaran' => ''],
        ]);
    }
}
