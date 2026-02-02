<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $fillable = [
        'id_user', 'id_kategori', 'judul', 'deskripsi', 'bahan',
        'langkah_langkah', 'gambar', 'video_url', 'waktu_memasak',
        'porsi', 'tingkat_kesulitan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function sukas()
    {
        return $this->hasMany(Suka::class);
    }

    public function favorits()
    {
        return $this->hasMany(Favorit::class);
    }

    // Hitung rata-rata rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    // Total suka
    public function totalSuka()
    {
        return $this->sukas()->count();
    }
}
