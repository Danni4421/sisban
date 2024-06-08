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
        Schema::create('alternative', function (Blueprint $table) {
            $table->id('id_alternative');
            $table->unsignedBigInteger('id_bansos')->index();
            $table->char('no_kk', 16)->index();
            $table->boolean('is_qualified')->default(false);
            $table->timestamps();

            $table->foreign('id_bansos')->references('id_bansos')->on('bansos');
            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alternative', function (Blueprint $table) {
            $table->dropForeign('alternative_id_bansos_foreign');
            $table->dropForeign('alternative_no_kk_foreign');
        });
        Schema::dropIfExists('alternative');
    }
};
