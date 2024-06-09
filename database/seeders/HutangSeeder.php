<?php

namespace Database\Seeders;

use App\Models\Hutang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json_data = File::get(database_path('seeders/data_rt.json'));
        $data = json_decode($json_data, true);

        foreach ($data['hutang'] as $hutang) {
            Hutang::insert([
                'no_kk' => $hutang['no_kk'],
                'jumlah' => $hutang['jumlah'],
                'keterangan' => $hutang['keterangan'],
                'bukti_hutang' => $hutang['bukti_hutang'],
                'created_at' => now()
            ]);
        }
    }
}
