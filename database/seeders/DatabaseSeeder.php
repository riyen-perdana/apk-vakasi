<?php

use Database\Seeders\DosenLbSeeder;
use Database\Seeders\PangkatSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FungsionalSeeder;
use Database\Seeders\PerangkatSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PangkatSeeder::class);
        $this->call(FungsionalSeeder::class);
        $this->call(PerangkatSeeder::class);
        $this->call(DosenLbSeeder::class);
    }
}
