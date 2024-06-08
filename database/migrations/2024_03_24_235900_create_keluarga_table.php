<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->char('no_kk', 16)->primary();
            $table->char('rt', 3);
            $table->enum('daya_listrik', ['none', 450, 900, 1300])->nullable();
            $table->double('biaya_listrik', 7)->default(0);
            $table->double('biaya_air', 7)->default(0);
            $table->double('pengeluaran', 8)->default(0);
            $table->boolean('is_kandidat')->default(false);
            $table->text('foto_kk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
