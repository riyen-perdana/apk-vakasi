<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Dosenlb;

class DosenLbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosenlb::create([
            'nup_nidn' => '9920112946',
            'glr_dpn' => NULL,
            'glr_blk' => 'M.Pd',
            'name' => 'Solheri',
            'npwp' => '75.379.040.1-221.000',
            'no_rek' => '1039994921',
            'name_no_rek' => 'Solheri',
            'pangkat' => 'c3ecfd3c-6add-498b-9647-5c50dcf5fd27',
            'fungsional' => '13be4c80-a6f0-499f-b7c3-db4bd4e0ba32'
        ]);
        Dosenlb::create([
            'nup_nidn' => '9920113040',
            'glr_dpn' => NULL,
            'glr_blk' => 'S.Ag., M.S',
            'name' => 'Nofri Riawani',
            'npwp' => '15.819.539.6-216.000',
            'no_rek' => '1035475849',
            'name_no_rek' => 'Nofri Riawani',
            'pangkat' => 'c3ecfd3c-6add-498b-9647-5c50dcf5fd27',
            'fungsional' => '13be4c80-a6f0-499f-b7c3-db4bd4e0ba32'
        ]);
        Dosenlb::create([
            'nup_nidn' => '2109038701',
            'glr_dpn' => NULL,
            'glr_blk' => 'S.Sos.I., M.Pd.I',
            'name' => 'Syamsul Rizal',
            'npwp' => '80.536.990.7-216.000',
            'no_rek' => '1039499521',
            'name_no_rek' => 'Syamsul Rizal',
            'pangkat' => '0ed6cdfa-e22c-406e-86b3-4a00133f4b7c',
            'fungsional' => 'fc8f0fa4-ac91-40dd-8012-d6a4a4694253'
        ]);
    }
}
