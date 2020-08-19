<?php

use Illuminate\Database\Seeder;

class ProfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('profil')->insert([
            'nama_perusahaan' => 'KETENGER ADVENTURE BATURRADEN', 'tanggal_berdiri' => '2018-03-21',
            'telepon' => '082293427693', 'alamat_perusahaan' => 'Jl. Sepanjang Jalan Kenangan',
            'email' => 'ketengeradventure@gmail.com'
        ]);

        $this->command->info('Berhasil Menambahkan 1 Profil Perusahaan');
    }
}
