<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Pangkat;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pangkat::create(['pangkat' => 'Ia', 'golongan' => 'Juru Muda']);
        Pangkat::create(['pangkat' => 'Ib', 'golongan' => 'Juru Muda Tk.I']);
        Pangkat::create(['pangkat' => 'Ic', 'golongan' => 'Juru']);
        Pangkat::create(['pangkat' => 'Id', 'golongan' => 'Juru Tk.I']);

        Pangkat::create(['pangkat' => 'IIa', 'golongan' => 'Pengatur Muda']);
        Pangkat::create(['pangkat' => 'IIb', 'golongan' => 'Pengatur Muda Tk.I']);
        Pangkat::create(['pangkat' => 'IIc', 'golongan' => 'Pengatur']);
        Pangkat::create(['pangkat' => 'IId', 'golongan' => 'Pengatur Tk.I']);

        Pangkat::create(['pangkat' => 'IIIa', 'golongan' => 'Penata Muda']);
        Pangkat::create(['pangkat' => 'IIIb', 'golongan' => 'Penata Muda Tk.I']);
        Pangkat::create(['pangkat' => 'IIIc', 'golongan' => 'Penata']);
        Pangkat::create(['pangkat' => 'IIId', 'golongan' => 'Penata Tk.I']);

        Pangkat::create(['pangkat' => 'IVa', 'golongan' => 'Pembina']);
        Pangkat::create(['pangkat' => 'IVb', 'golongan' => 'Pembina Tk.I']);
        Pangkat::create(['pangkat' => 'IVc', 'golongan' => 'Pembina Muda']);
        Pangkat::create(['pangkat' => 'IVd', 'golongan' => 'Pembina Madya']);
        Pangkat::create(['pangkat' => 'IVa', 'golongan' => 'Pembina Utama']);

    }
}
