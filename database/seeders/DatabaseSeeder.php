<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PengurusSeeder::class);
        $this->call(BansosSeeder::class);
        $this->call(KeluargaSeeder::class);
        $this->call(WargaSeeder::class);
        $this->call(AsetSeeder::class);
        $this->call(PenerimaBansosSeeder::class);
        $this->call(PengajuanSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(AlternativeSeeder::class);
    }
}
