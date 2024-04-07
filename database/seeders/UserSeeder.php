<?php

namespace Database\Seeders;

use App\Models\User as UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
