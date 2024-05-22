<?php

namespace Database\Seeders;

use App\Models\Kandidat;
use Illuminate\Database\Seeder;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kandidat::updateOrCreate([
            'id_bansos' => 1,
            'nik' => '3564738909876789'
        ]);
    }
}
