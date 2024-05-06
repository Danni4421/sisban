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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->char('no_kk', 16)->primary();
            $table->enum('status_pengajuan', ['diterima', 'ditolak', 'proses'])->default('proses');
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropForeign('pengajuan_no_kk_foreign');
        });
        Schema::dropIfExists('pengajuan');
    }
};
