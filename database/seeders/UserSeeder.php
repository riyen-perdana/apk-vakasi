<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nip' => '198111162011011010',
            'name' => 'Riyen Perdana',
            'glr_blk' => 'ST',
            'email' => 'riyen_perdana@uin-suska.ac.id',
            'password' => Hash::make('password'),
            'is_aktif' => 'Y'
        ]);

        //get all permissions
        $permissions = Permission::all();

        //get role admin
        $role = Role::find(1);

        //assign permission to role
        $role->syncPermissions($permissions);

        //assign role to user
        $user->assignRole($role);
        
    }
}
