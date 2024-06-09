<?php

namespace Database\Seeders;

use App\Models\User as UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserModel::updateOrCreate([
            'id_user' => 1,
            'username' => 'solikin',
            'email' => 'solikin@gmail.com',
            'password' => Hash::make('solikin123'),
            'level' => 'rt',
            'created_at' => date('Y-m-d')
        ]);

        UserModel::updateOrCreate([
            'id_user' => 2,
            'username' => 'bambang',
            'email' => 'bambang@gmail.com',
            'password' => Hash::make('bambang123'),
            'level' => 'rt',
            'created_at' => date('Y-m-d')
        ]);

        UserModel::updateOrCreate([
            'id_user' => 3,
            'username' => 'saipul',
            'email' => 'saipul@gmail.com',
            'password' => Hash::make('saipul123'),
            'level' => 'rt',
            'created_at' => date('Y-m-d')
        ]);

        UserModel::updateOrCreate([
            'id_user' => 4,
            'username' => 'eslimateng',
            'email' => 'pakteng@gmail.com',
            'password' => Hash::make('pakting12'),
            'level' => 'rw',
            'created_at' => date('Y-m-d')
        ]);

        UserModel::updateOrCreate([
            'id_user' => 5,
            'username' => 'admin',
            'email' => 'sisban07@gmail.com',
            'password' => Hash::make('sisban07hore'),
            'level' => 'admin',
            'created_at' => now()
        ]);

        UserModel::updateOrCreate([
            'id_user' => 6,
            'username' => 'arif',
            'email' => 'arif@gmail.com',
            'password' => Hash::make('sipalingkiller'),
            'level' => 'warga',
            'created_at' => now()
        ]);

        UserModel::updateOrCreate([
            'id_user' => 7,
            'username' => '1477759869647912',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('1477759869647912'),
            'level' => 'warga',
            'created_at' => now()
        ]);

        UserModel::updateOrCreate([
            'id_user' => 8,
            'username' => '5399152957256167',
            'email' => 'alicesmith@gmail.com',
            'password' => Hash::make('5399152957256167'),
            'level' => 'warga',
            'created_at' => now()
        ]);

        UserModel::updateOrCreate([
            'id_user' => 9,
            'username' => '6816673839192525',
            'email' => 'davidlee@gmail.com',
            'password' => Hash::make('6816673839192525'),
            'level' => 'warga',
            'created_at' => now()
        ]);
    }
}
