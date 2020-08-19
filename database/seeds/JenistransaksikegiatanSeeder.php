<?php

use Illuminate\Database\Seeder;

class JenistransaksikegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_transaksikegiatan')->insert([
            ['nama_jenis' => 'Outbond', 'deskripsi' => 'Pendapatan sewa paket outbond'], 
            ['nama_jenis' => 'Pendapatan Lainnya', 'deskripsi' => 'Pendapatan diluar paket outbond'],
            ['nama_jenis' => 'Crew', 'deskripsi' => 'Upah untuk crew tambahan'],
            ['nama_jenis' => 'Pengeluaran Lainnya', 'deskripsi' => 'Pengeluaran lainnya'],   
        ]);

    }
}
