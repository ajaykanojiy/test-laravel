<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
            'name' => 'Ajay', 
            'lname' => 'kant', 
            'email' => 'ajaykantkanojiya@gmail.com',
            'password' => bcrypt('Password@123'),
            'mnumber' => '9303119152',
            'image' => '1631350748.jpg',
            'approved_by_Admin' => '1',
            
        ]);
        
        $role = Role::create(['name' => 'Admin User']);
               Role::create(['name' => 'Regular users']);
        $permissions = Permission::pluck('id','id')->all();
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
        // $role->syncPermissions(['9','10','11']);
        // $user->assignRole([$role->id,2]);

        // $user = User::create([
        //     'name' => 'Ajju', 
        //     'email' => 'ajju@gmail.com',
        //     'password' => bcrypt('Password@123')
        // ]);
    }

    
}
