<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //permission Dashboard Modul
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);

        //Permission Permission Modul
        Permission::create(['name' => 'permission.index', 'guard_name' => 'web']);

        //Permission Role Modul
        Permission::create(['name' => 'role.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.delete', 'guard_name' => 'web']);
        
        //Permission Role User
        Permission::create(['name' => 'user.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.delete', 'guard_name' => 'web']);

        //Permission Perangkat Modul
        Permission::create(['name' => 'perangkat.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'perangkat.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'perangkat.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'perangkat.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'perangkat.delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'perangkat.detail', 'guard_name' => 'web']);
        
        //Permission Pangkat Modul
        Permission::create(['name' => 'pangkat.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'pangkat.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'pangkat.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'pangkat.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'pangkat.delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'pangkat.detail', 'guard_name' => 'web']);
        
        //Permission Jabatan Modul
        Permission::create(['name' => 'jabatan.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'jabatan.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'jabatan.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'jabatan.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'jabatan.delete', 'guard_name' => 'web']);
        
        //Permission Dosen Modul
        Permission::create(['name' => 'dosen.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'dosen.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'dosen.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'dosen.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'dosen.delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'dosen.detail', 'guard_name' => 'web']);
        
        //Permission Semester Modul
        Permission::create(['name' => 'semester.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'semester.import', 'guard_name' => 'web']);
        Permission::create(['name' => 'semester.edit', 'guard_name' => 'web']);
        
        //Permission Setting Modul
        Permission::create(['name' => 'setting.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.delete', 'guard_name' => 'web']);
        
        //Permission Vakasi Modul
        Permission::create(['name' => 'vakasi.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi.proses', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi.detail', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi.view', 'guard_name' => 'web']);
        
        //Permission Vakasi Detail Modul
        Permission::create(['name' => 'vakasi-detail.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi-detail.amprah-print', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi-detail.soal-print', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi-detail.pengawas-print', 'guard_name' => 'web']);
        Permission::create(['name' => 'vakasi-detail.pemeriksa-print', 'guard_name' => 'web']);
    }
}
