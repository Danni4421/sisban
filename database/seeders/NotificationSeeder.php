<?php

namespace Database\Seeders;

use App\Models\Notification as NotificationModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotificationModel::insert([
            [
                'no_kk' => '3564787598748567',
                'is_readed_rt' => '0',
                'is_readed_rw'=> '0'
            ]
        ]);
    }
}
