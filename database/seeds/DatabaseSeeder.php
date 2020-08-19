<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AkunTableSeeder::class);
        $this->call(JurnalTableSeeder::class);
        $this->call(ProfilTableSeeder::class);
        $this->call(JenistransaksikegiatanSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PemasukanHarianSeeder::class);
        $this->call(PengeluaranHarianSeeder::class);
    }
}
