<?php

namespace Database\Seeders;

use App\Models\Bansos as BansosModel;
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
                'jumlah' => 2,
                'created_at' => now()
            ],
            [
                'id_bansos' => 2,
                'nama_bansos' => 'Program Keluarga Harapan',
                'keterangan' => 'Program pemberian bantuan sosial bersyarat kepada Keluarga Miskin',
                'jumlah' => 1,
                'created_at' => now()
            ]
        ]);
    }
}
