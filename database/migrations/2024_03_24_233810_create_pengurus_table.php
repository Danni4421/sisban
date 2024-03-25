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
        Schema::create('pengurus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengurus')->primary();
            $table->unsignedBigInteger('id_user')->index()->unique();
            $table->string('jabatan', 11);
            $table->string('nama', 100);
            $table->char('nomor_telepon', 13);
            $table->string('alamat', 100);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropForeign('pengurus_id_user_foreign');
        });
        Schema::dropIfExists('pengurus');
    }
};
