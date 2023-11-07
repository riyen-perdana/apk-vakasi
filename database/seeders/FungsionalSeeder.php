<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Fungsional;

class FungsionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fungsional::create(['jbtn_fungsional' => 'Assisten Ahli']);
        Fungsional::create(['jbtn_fungsional' => 'Lektor']);
        Fungsional::create(['jbtn_fungsional' => 'Lektor Kepala']);
        Fungsional::create(['jbtn_fungsional' => 'Profesor']);
    }
}
