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
        Schema::create('aset', function (Blueprint $table) {
            $table->id('id_aset')->primary();
            $table->char('no_kk', 16)->index();
            $table->string('nama_aset', 50);
            $table->double('harga_jual', 9);
            $table->smallInteger('tahun_beli');
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->dropForeign('aset_no_kk_foreign');
        });
        Schema::dropIfExists('aset');
    }
};
