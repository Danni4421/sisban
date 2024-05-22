<?php

namespace Database\Seeders;

use App\Models\Keluarga as KeluargaModel;
use Illuminate\Database\Seeder;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KeluargaModel::insert([
            [
                'no_kk' => '1477759869647912',
                'rt' => '030',
                'daya_listrik' => '450',
                'biaya_listrik' => 35000,
                'biaya_air' => 12000,
                'pengeluaran' => 680000,
                'foto_kk' => 'none',
                'created_at' => date('Y-m-d'),
                'bukti_biaya_listrik' => null,
                'bukti_biaya_air' => null,
            ],
            [
                'no_kk' => '5399152957256167',
                'rt' => '031',
                'daya_listrik' => 'none',
                'biaya_listrk' => 40000,
                'biaya_air' => 14000,
                'pengeluaran' => 450000,
                'foto_kk' => 'none',
                'created_at' => date('Y-m-d'),
                'bukti_biaya_listrik' => null,
                'bukti_biaya_air' => null,
            ],
            [
                'no_kk' => '6816673839192525',
                'rt' => '030',
                'daya_listrik' => '450',
                'biaya_listrk' => 37500,
                'biaya_air' => 13000,
                'pengeluaran' => 900000,
                'foto_kk' => 'none',
                'created_at' => date('Y-m-d'),
                'bukti_biaya_listrik' => null,
                'bukti_biaya_air' => null,
            ]
        ]);
    }
}
