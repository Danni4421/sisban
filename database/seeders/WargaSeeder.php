<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warga as WargaModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
                'id_user' => 7,
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
                'id_user' => null,
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
                'id_user' => 8,
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
                'id_user' => null,
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
                'id_user' => null,
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
                'id_user' => 9,
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

        $json_data = File::get(database_path('seeders/data_rt.json'));
        $data = json_decode($json_data, true);

        $kepala_keluarga = array_filter($data['warga'], fn ($warga) => $warga['level'] == 'kepala_keluarga');
        $kepala_keluarga = array_values($kepala_keluarga);

        $anggotas = array_filter($data['warga'], fn ($user) => $user['level'] == "anggota");

        foreach ($data['users'] as $index => $user) {
            $user = User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'level' => $user['level'],
            ]);

            $data_kepala = $kepala_keluarga[$index];

            WargaModel::create([
                'nik' => $data_kepala['nik'],
                'no_kk' => $data_kepala['no_kk'],
                'id_user' => $user->id_user,
                'nama' => $data_kepala['nama'],
                'jenis_kelamin' => $data_kepala['jenis_kelamin'],
                'tempat_tanggal_lahir' => $data_kepala['tempat_tanggal_lahir'],
                'umur' => $data_kepala['umur'],
                'status' => $data_kepala['status'],
                'penghasilan' => $data_kepala['penghasilan'] ?? 0,
                'level' => $data_kepala['level']
            ]);
        }

        foreach ($anggotas as $anggota) {
            WargaModel::create([
                'nik' => $anggota['nik'],
                'no_kk' => $anggota['no_kk'],
                'id_user' => null,
                'nama' => $anggota['nama'],
                'jenis_kelamin' => $anggota['jenis_kelamin'],
                'tempat_tanggal_lahir' => $anggota['tempat_tanggal_lahir'],
                'umur' => $anggota['umur'],
                'status' => $anggota['status'],
                'penghasilan' => $anggota['penghasilan'],
                'level' => $anggota['level']
            ]);
        }
    }
}
