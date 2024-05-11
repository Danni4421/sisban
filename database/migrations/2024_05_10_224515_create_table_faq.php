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
        Schema::create('faq', function (Blueprint $table) {
            $table->id('id_faq');
            $table->unsignedBigInteger('id_user')->index();
            $table->text('pertanyaan');
            $table->text('jawaban')->nullable();
            $table->boolean('is_solved')->default(false);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faq', function (Blueprint $table) {
            $table->dropForeign('faq_id_user_foreign');
        });
        Schema::dropIfExists('faq');
    }
};
