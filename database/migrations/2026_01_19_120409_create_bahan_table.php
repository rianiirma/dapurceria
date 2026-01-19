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
        Schema::create('bahan', function (Blueprint $table) {
            $table->id('id_bahan');
            $table->unsignedBigInteger('id_resep');
            $table->string('nama_bahan', 150);
            $table->string('takaran', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_resep')->references('id_resep')->on('resep')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan');
    }
};
