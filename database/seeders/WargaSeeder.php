<?php

namespace Database\Seeders;

use App\Models\Warga as WargaModel;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WargaModel::insert([
            [
                'nik' => '1234567890123456',
                "no_kk" => '1477759869647912',
                'nama' => 'John Doe',
                'jenis_kelamin' => 'lk',
                'tempat_tanggal_lahir' => 'Malang, 01-01-1990',
                'umur' => 34,
                'no_hp' => '081234567890',
                'penghasilan' => 1000000,
                'status' => 'tidak_bekerja',
                'level' => 'kepala_keluarga',
                'foto_ktp' => 'img/person/kepala_keluarga_1.jpg',
                'created_at' => date('Y-m-d'),
                'slip_gaji' => null,
            ],
            [
                'nik' => '2345678901234567',
                'no_kk' => '1477759869647912',
                'nama' => 'Jane Doe',
                'jenis_kelamin' => 'pr',
                'tempat_tanggal_lahir' => 'Malang, 15-05-1992',
                'umur' => 31,
                'no_hp' => '087654321098',
                'penghasilan' => 0,
                'status' => 'tidak_bekerja',
                'level' => 'anggota',
                'foto_ktp' => 'none',
                'created_at' => date('Y-m-d'),
                'slip_gaji' => null,
            ],
            [
                'nik' => '3456789012345678',
                'no_kk' => '5399152957256167',
                'nama' => 'Alice Smith',
                'jenis_kelamin' => 'pr',
                'tempat_tanggal_lahir' => 'Malang, 10-10-1985',
                'umur' => 39,
                'no_hp' => '082345678901',
                'penghasilan' => 0,
                'status' => 'tidak_bekerja',
                'level' => 'anggota',
                'foto_ktp' => 'none',
                'created_at' => date('Y-m-d'),
                'slip_gaji' => null,
            ],
            [
                'nik' => '4567890123456789',
                'no_kk' => '5399152957256167',
                'nama' => 'Michael Johnson',
                'jenis_kelamin' => 'lk',
                'tempat_tanggal_lahir' => 'Malang, 20-12-1988',
                'umur' => 36,
                'no_hp' => '085678901234',
                'penghasilan' => 1200000,
                'status' => 'bekerja',
                'level' => 'kepala_keluarga',
                'foto_ktp' => 'img/person/kepala_keluarga_2.jpg',
                'created_at' => date('Y-m-d'),
                'slip_gaji' => null,
            ],
            [
                'nik' => '5678901234567890',
                'no_kk' => '6816673839192525',
                'nama' => 'Emily Brown',
                'jenis_kelamin' => 'pr',
                'tempat_tanggal_lahir' => 'Malang, 05-06-1995',
                'umur' => 29,
                'no_hp' => '089012345678',
                'penghasilan' => 0,
                'status' => 'sekolah',
                'level' => 'anggota',
                'foto_ktp' => 'none',
                'created_at' => date('Y-m-d'),
                'slip_gaji' => null,
            ],
            [
                'nik' => '6789012345678901',
                'no_kk' => '6816673839192525',
                'nama' => 'David Lee',
                'jenis_kelamin' => 'lk',
                'tempat_tanggal_lahir' => 'Malang, 25-03-1991',
                'umur' => 33,
                'no_hp' => '086789012345',
                'penghasilan' => 1300000,
                'status' => 'bekerja',
                'level' => 'kepala_keluarga',
                'foto_ktp' => 'img/person/kepala_keluarga_3.jpg',
                'created_at' => date('Y-m-d'),
                'slip_gaji' => null,
            ]
        ]);
    }
}
