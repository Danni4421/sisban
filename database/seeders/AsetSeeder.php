<?php

namespace Database\Seeders;

use App\Models\Aset as AsetModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AsetModel::insert([
            [
                'id_aset' => 1,
                'no_kk' => '1477759869647912',
                'nama_aset' => 'Sepeda Motor',
                'harga_jual' => 2000000,
                'tahun_beli' => 2012,
                'created_at' => date('Y-m-d')
            ]
        ]);
    }
}
