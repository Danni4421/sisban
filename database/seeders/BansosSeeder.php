<?php

namespace Database\Seeders;

use App\Models\Bansos as BansosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BansosModel::insert([
            [
                'id_bansos' => 1,
                'nama_bansos' => 'Bantuan Pangan Non Tunai',
                'keterangan' => 'Memberikan bantuan pangan non tunai',
                'created_at' => date('Y-m-d')
            ],
            [
                'id_bansos' => 2,
                'nama_bansos' => 'Program Keluarga Harapan',
                'keterangan' => 'Program pemberian bantuan sosial bersyarat kepada Keluarga Miskin',
                'created_at' => date('Y-m-d')
            ]
        ]);
    }
}
