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
        Schema::create('resep', function (Blueprint $table) {
            $table->id('id_resep');
            $table->unsignedBigInteger('id_kategori');
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->string('waktu_masak', 50)->nullable();
            $table->enum('tingkat_kesulitan', ['mudah', 'sedang', 'sulit'])->nullable();
            $table->string('video_url')->nullable(); // link YouTube
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
