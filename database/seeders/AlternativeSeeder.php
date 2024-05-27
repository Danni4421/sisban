<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alternative::updateOrCreate([
            'id_bansos' => 1,
            'no_kk' => '6816673839192525',
            'is_qualified' => 0,
        ]);
    }
}
