<?php

namespace Database\Seeders;

use App\Models\PenerimaBansos as PenerimaBansosModel;
use DateTime;
use Illuminate\Database\Seeder;

class PenerimaBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenerimaBansosModel::insert([
            [
                'nik' => '1234567890123456',
                'id_bansos' => 2,
                'tanggal_penerimaan' => date('Y-m-d'),
                'created_at' => date('Y-m-d')
            ]
        ]);
    }
}
