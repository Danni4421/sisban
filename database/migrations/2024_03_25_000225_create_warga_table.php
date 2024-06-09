<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->char('nik', 16)->primary();
            $table->unsignedBigInteger('id_user')->index()->nullable()->default(null);
            $table->char('no_kk', 16)->index();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['lk', 'pr'])->nullable();
            $table->string('tempat_tanggal_lahir', 100)->nullable();
            $table->smallInteger('umur')->nullable();
            $table->char('no_hp', 13)->unique()->nullable();
            $table->enum('status', ['bekerja', 'tidak_bekerja', 'sekolah'])->nullable();
            $table->double('penghasilan', 7)->default(0);
            $table->enum('level', ['kepala_keluarga', 'anggota']);
            $table->text('foto_ktp')->nullable();
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_user')->references('id_user')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropForeign('warga_no_kk_foreign');
        });
        Schema::dropIfExists('warga');
    }
};
