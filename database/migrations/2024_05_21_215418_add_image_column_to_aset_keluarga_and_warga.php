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
        Schema::table('aset', function (Blueprint $table) {
            $table->addColumn('text', 'image')->nullable();
        });

        Schema::table('keluarga', function (Blueprint $table) {
            $table->addColumn('text', 'bukti_biaya_listrik')->nullable();
            $table->addColumn('text', 'bukti_biaya_air')->nullable();
        });

        Schema::table('warga', function (Blueprint $table) {
            $table->addColumn('text', 'slip_gaji')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropColumn('bukti_biaya_listrik');
            $table->dropColumn('bukti_biaya_air');
        });

        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn('slip_gaji');
        });
    }
};
