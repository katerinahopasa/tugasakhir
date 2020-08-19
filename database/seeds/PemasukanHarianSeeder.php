<?php

use Illuminate\Database\Seeder;

class PemasukanHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pemasukan')->insert([
            ['tanggal' => '2020-07-01', 'jml_pengunjung' => '150', 'harga_tiket' => '5000', 'total_pemasukan' => '750000', 'keterangan' => 'ok'], 
            ['tanggal' => '2020-07-02', 'jml_pengunjung' => '199', 'harga_tiket' => '5000', 'total_pemasukan' => '995000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-03', 'jml_pengunjung' => '43', 'harga_tiket' => '5000', 'total_pemasukan' => '215000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-04', 'jml_pengunjung' => '16', 'harga_tiket' => '5000', 'total_pemasukan' => '80000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-05', 'jml_pengunjung' => '49', 'harga_tiket' => '5000', 'total_pemasukan' => '245000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-06', 'jml_pengunjung' => '53', 'harga_tiket' => '5000', 'total_pemasukan' => '265000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-07', 'jml_pengunjung' => '35', 'harga_tiket' => '5000', 'total_pemasukan' => '175000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-08', 'jml_pengunjung' => '204', 'harga_tiket' => '5000', 'total_pemasukan' => '1020000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-09', 'jml_pengunjung' => '299', 'harga_tiket' => '5000', 'total_pemasukan' => '1495000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-10', 'jml_pengunjung' => '46', 'harga_tiket' => '5000', 'total_pemasukan' => '230000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-11', 'jml_pengunjung' => '63', 'harga_tiket' => '5000', 'total_pemasukan' => '315000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-12', 'jml_pengunjung' => '52', 'harga_tiket' => '5000', 'total_pemasukan' => '260000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-13', 'jml_pengunjung' => '7', 'harga_tiket' => '5000', 'total_pemasukan' => '35000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-14', 'jml_pengunjung' => '24', 'harga_tiket' => '5000', 'total_pemasukan' => '120000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-15', 'jml_pengunjung' => '130', 'harga_tiket' => '5000', 'total_pemasukan' => '650000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-16', 'jml_pengunjung' => '219', 'harga_tiket' => '5000', 'total_pemasukan' => '1095000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-17', 'jml_pengunjung' => '28', 'harga_tiket' => '5000', 'total_pemasukan' => '140000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-18', 'jml_pengunjung' => '19', 'harga_tiket' => '5000', 'total_pemasukan' => '95000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-19', 'jml_pengunjung' => '54', 'harga_tiket' => '5000', 'total_pemasukan' => '270000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-20', 'jml_pengunjung' => '40', 'harga_tiket' => '5000', 'total_pemasukan' => '200000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-21', 'jml_pengunjung' => '53', 'harga_tiket' => '5000', 'total_pemasukan' => '265000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-22', 'jml_pengunjung' => '154', 'harga_tiket' => '5000', 'total_pemasukan' => '770000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-23', 'jml_pengunjung' => '280', 'harga_tiket' => '5000', 'total_pemasukan' => '1400000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-24', 'jml_pengunjung' => '43', 'harga_tiket' => '5000', 'total_pemasukan' => '215000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-25', 'jml_pengunjung' => '46', 'harga_tiket' => '5000', 'total_pemasukan' => '230000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-26', 'jml_pengunjung' => '22', 'harga_tiket' => '5000', 'total_pemasukan' => '110000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-27', 'jml_pengunjung' => '109', 'harga_tiket' => '5000', 'total_pemasukan' => '545000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-28', 'jml_pengunjung' => '38', 'harga_tiket' => '5000', 'total_pemasukan' => '190000', 'keterangan' => 'ok'],
            ['tanggal' => '2020-07-29', 'jml_pengunjung' => '123', 'harga_tiket' => '5000', 'total_pemasukan' => '615000', 'keterangan' => 'ok'],  
        ]);

    }
}
