<?php

namespace Database\Seeders;

use App\Models\Aset as AsetModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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
                'created_at' => date('Y-m-d'),
                'image' => null
            ]
        ]);

        $json_data = File::get(database_path('seeders/data_rt.json'));
        $data = json_decode($json_data, true);

        foreach ($data['aset'] as $aset) {
            AsetModel::insert([
                'no_kk' => $aset['no_kk'],
                'nama_aset' => $aset['nama_aset'],
                'harga_jual' => $aset['harga_jual'],
                'tahun_beli' => $aset['tahun_beli'],
                'created_at' => now()
            ]);
        }
    }
}
