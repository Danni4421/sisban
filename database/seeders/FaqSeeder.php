<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::updateOrCreate([
            'id_user' => 1,
            'pertanyaan' => 'Bagaimana cara memperbesar tulisan',
            'jawaban' => null,
        ]);

        Faq::updateOrCreate([
            'id_user' => 4,
            'pertanyaan' => 'Bagaimana cara memperbesar tampilan',
            'jawaban' => 'Anda klik atau masuk pada menu <strong>Setting</strong> setelah itu ubah ukuran pada bagian <strong>Ukuran Tampilan</strong>, Sesuaikan dengan ukuran yang Anda inginkan',
        ]);
    }
}
