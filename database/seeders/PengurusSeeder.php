<?php

namespace Database\Seeders;

use App\Models\Pengurus as PengurusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengurusModel::insert([
            [
                'id_pengurus' => 1,
                'id_user' => 1,
                'jabatan' => 'RT030',
                'nama' => 'Ahmad Solihin',
                'nomor_telepon' => '081234567890',
                'alamat' => 'Dusun Ketangi RW007/RT030 Tegalgondo, Karangploso, Malang',
                'created_at' => date('Y-m-d')
            ],
            [
                'id_pengurus' => 2,
                'id_user' => 2,
                'jabatan' => 'RT031',
                'nama' => 'Bambang Sakti Mandraguno',
                'nomor_telepon' => '081324567890',
                'alamat' => 'Dusun Ketangi RW007/RT031 Tegalgondo, Karangploso, Malang',
                'created_at' => date('Y-m-d')
            ],
            [
                'id_pengurus' => 3,
                'id_user' => 3,
                'jabatan' => 'RT032',
                'nama' => 'Saiful Mubarok',
                'nomor_telepon' => '089234356789',
                'alamat' => 'Dusun Ketangi RW007/RT032 Tegalgondo, Karangploso, Malang',
                'created_at' => date('Y-m-d')
            ],
            [
                'id_pengurus' => 4,
                'id_user' => 4,
                'jabatan' => 'RW007',
                'nama' => 'Sisyanto',
                'nomor_telepon' => '082334348847',
                'alamat' => 'Dusun Ketangi RW007/RT031 Tegalgondo, Karangploso, Malang',
                'created_at' => date('Y-m-d')
            ]
        ]);
    }
}
