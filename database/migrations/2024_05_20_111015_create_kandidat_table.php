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
        Schema::create('kandidat', function (Blueprint $table) {
            $table->id('id_kandidat');
            $table->unsignedBigInteger('id_bansos')->index();
            $table->string('nik')->index();
            $table->timestamps();

            $table->foreign('id_bansos')->references('id_bansos')->on('bansos');
            $table->foreign('nik')->references('nik')->on('warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kandidat', function (Blueprint $table) {
            $table->dropForeign('kandidat_id_bansos_foreign');
            $table->dropForeign('kandidat_nik_foreign');
        });
        Schema::dropIfExists('kandidat');
    }
};
