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
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->char('nik', 16)->index();
            $table->unsignedBigInteger('id_bansos')->index();
            $table->dateTime('tanggal_penerimaan');
            $table->timestamps();

            $table->primary(['nik', 'id_bansos']);

            $table->foreign('nik')->references('nik')->on('warga');
            $table->foreign('id_bansos')->references('id_bansos')->on('bansos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerima_bansos', function (Blueprint $table) {
            $table->dropForeign('penerima_bansos_nik_foreign');
            $table->dropForeign('penerima_bansos_id_bansos_foreign');
        });
        Schema::dropIfExists('penerima_bansos');
    }
};
