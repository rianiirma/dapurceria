<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_kategori',
        'judul',
        'deskripsi',
        'bahan',
        'langkah_langkah',
        'gambar',
        'video_url',
        'waktu_memasak',
        'porsi',
        'tingkat_kesulitan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_resep');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_resep');
    }

    public function sukas()
    {
        return $this->hasMany(Suka::class, 'id_resep');
    }

    public function favorits()
    {
        return $this->hasMany(Favorit::class, 'id_resep');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function totalSuka()
    {
        return $this->sukas()->count();
    }

    public function totalKomentar()
    {
        return $this->komentars()->count();
    }

    public function isSukaBy($userId)
    {
        return $this->sukas()->where('id_user', $userId)->exists();
    }

    public function isFavoritBy($userId)
    {
        return $this->favorits()->where('id_user', $userId)->exists();
    }
}
