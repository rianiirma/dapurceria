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
        Schema::create('langkah', function (Blueprint $table) {
            $table->id('id_langkah');
            $table->unsignedBigInteger('id_resep');
            $table->integer('urutan');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('id_resep')->references('id_resep')->on('resep')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('langkah');
    }
};
