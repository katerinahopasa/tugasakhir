<?php
  
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Katerina', 
        	'email' => 'katerina@gmail.com',
        	'password' => bcrypt('123456')
        ]);
  
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'benharian']);
        $role = Role::create(['name' => 'benadventure']);
        $role = Role::create(['name' => 'Manajer']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);

        $benharian = User::create([
            'name' => 'Tin', 
            'email' => 'tin@gmail.com',
            'password' => bcrypt('tin')
        ]);

        $benharian->assignRole('benharian');

        $benadventure = User::create([
            'name' => 'Andi', 
            'email' => 'andi@gmail.com',
            'password' => bcrypt('andi')
        ]);

        $benadventure->assignRole('benadventure');

        $manajer = User::create([
            'name' => 'Ari', 
            'email' => 'ari@gmail.com',
            'password' => bcrypt('ari')
        ]);

        $manajer->assignRole('Manajer');

        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $admin->assignRole('Admin');
    }
}
