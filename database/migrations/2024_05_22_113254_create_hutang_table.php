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
        Schema::create('hutang', function (Blueprint $table) {
            $table->id('id_hutang');
            $table->string('no_kk')->index();
            $table->double('jumlah');
            $table->text('keterangan');
            $table->string('bukti_hutang')->nullable();
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hutang', function (Blueprint $table) {
            $table->dropForeign('hutang_no_kk_foreign');
        });
        Schema::dropIfExists('hutang');
    }
};
