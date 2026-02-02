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
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('id_kategori')
                ->constrained('kategoris')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi');
            $table->text('bahan');
            $table->text('langkah_langkah');
            $table->string('gambar')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('waktu_memasak');
            $table->integer('porsi');
            $table->enum('tingkat_kesulitan', ['mudah', 'sedang', 'sulit'])->default('sedang');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
