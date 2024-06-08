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
            $table->char('no_kk', 16)->index();
            $table->double('jumlah');
            $table->text('keterangan');
            $table->text('bukti_hutang')->nullable();
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga')
                ->cascadeOnDelete()->cascadeOnUpdate();
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
