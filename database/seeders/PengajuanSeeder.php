<?php

namespace Database\Seeders;

use App\Models\Keluarga;
use App\Models\Pengajuan;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keluarga::updateOrCreate([
            'no_kk' => '3564787598748567',
            'rt' => '031',
            'daya_listrik' => '450',
            'biaya_listrik' => 33000,
            'biaya_air' => 5000,
            'hutang' => 800000,
            'pengeluaran' => 780000,
            'foto_kk' => 'none',
            'created_at' => date('Y-m-d')
        ]);

        Warga::updateOrCreate([
            'nik' => '3564738909876789',
            'no_kk' => '3564787598748567',
            'nama' => 'Arif',
            'jenis_kelamin' => 'lk',
            'tempat_tanggal_lahir' => 'Malang, 03-02-1980',
            'umur' => 44,
            'no_hp' => '081234127890',
            'penghasilan' => 800000,
            'level' => 'kepala_keluarga',
            'foto_ktp' => 'none',
            'created_at' => date('Y-m-d')
        ]);

        Warga::updateOrCreate([
            'nik' => '3564738956456789',
            'no_kk' => '3564787598748567',
            'nama' => 'Siti',
            'jenis_kelamin' => 'pr',
            'tempat_tanggal_lahir' => 'Malang, 07-03-1985',
            'umur' => 39,
            'no_hp' => '081534567765',
            'penghasilan' => 0,
            'level' => 'anggota',
            'foto_ktp' => 'none',
            'created_at' => date('Y-m-d')
        ]);

        Pengajuan::updateOrCreate([
            'no_kk' => '3564787598748567',
        ]);
    }
}
