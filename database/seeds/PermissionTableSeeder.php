<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'users-list',
           'users-create',
           'users-edit',
           'users-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'transaksi-list',
           'transaksi-detail',
           'laporan-kegiatan-list',
           'halaman-benharian',
           'labarugi',
           'neraca-laporan',
        ];
   
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
