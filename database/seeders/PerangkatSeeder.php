<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Perangkat;
use App\Enums\JabatanStatus;

class PerangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perangkat::create([
            'nip' =>'198111182009011006',
            'nama' =>'Imron Rosidi',
            'glr_dpn' => 'Prof. Dr',
            'glr_blk' => 'S.Pd, MA',
            'is_jabatan' => JabatanStatus::Dekan,
            'is_plt' => 'N',
            'is_aktif' => 'Y',
            'awal_jabatan' => '2023-01-01',
            'akhir_jabatan' => '2027-01-01'
        ]);
        Perangkat::create([
            'nip' =>'198105072009012011',
            'nama' =>'Umi Salamah',
            'glr_blk' => 'S.Pd.I',
            'is_jabatan' => JabatanStatus::BPP_RUPIAH_MURNI,
            'is_plt' => 'N',
            'is_aktif' => 'Y',
            'awal_jabatan' => '2023-01-01',
            'akhir_jabatan' => '2027-01-01'
        ]);
        Perangkat::create([
            'nip' =>'198311072006041002',
            'nama' =>'Suparjono',
            'glr_blk' => 'SE.,M.Si',
            'is_jabatan' => JabatanStatus::Bendahara_Pengeluaran,
            'is_plt' => 'N',
            'is_aktif' => 'Y',
            'awal_jabatan' => '2023-01-01',
            'akhir_jabatan' => '2027-01-01'
        ]);
        Perangkat::create([
            'nip' =>'197702152009012004',
            'nama' =>'Febriati',
            'glr_blk' => 'S.T.,MM',
            'is_jabatan' => JabatanStatus::PPK_RM,
            'is_plt' => 'N',
            'is_aktif' => 'Y',
            'awal_jabatan' => '2023-01-01',
            'akhir_jabatan' => '2027-01-01'
        ]);
        Perangkat::create([
            'nip' =>'197807172007011019',
            'nama' =>'Yusrizal',
            'glr_blk' => 'SE',
            'is_jabatan' => JabatanStatus::PPK,
            'is_plt' => 'N',
            'is_aktif' => 'Y',
            'awal_jabatan' => '2023-01-01',
            'akhir_jabatan' => '2027-01-01'
        ]);
    }
}
