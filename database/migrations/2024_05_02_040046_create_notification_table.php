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
        Schema::create('notification', function (Blueprint $table) {
            $table->char('no_kk', 16)->primary();
            $table->boolean('is_readed_rt')->default(false);
            $table->boolean('is_readed_rw')->default(false);
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('pengajuan')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notification', function (Blueprint $table) {
            $table->dropForeign('notification_no_kk_foreign');
        });
        Schema::dropIfExists('notification');
    }
};
