<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table      = 'resep';
    protected $primaryKey = 'id_resep';

    protected $fillable = [
        'id_kategori',
        'judul',
        'deskripsi',
        'waktu_masak',
        'tingkat_kesulitan',
        'video_url',
        'gambar',
    ];

    // 1 resep milik 1 kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // 1 resep punya banyak bahan
    public function bahan()
    {
        return $this->hasMany(Bahan::class, 'id_resep', 'id_resep');
    }

    // 1 resep punya banyak langkah
    public function langkah()
    {
        return $this->hasMany(Langkah::class, 'id_resep', 'id_resep');
    }

    // 1 resep punya banyak komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_resep', 'id_resep');
    }

    // 1 resep bisa difavorit banyak user
    public function favorit()
    {
        return $this->hasMany(Favorit::class, 'id_resep', 'id_resep');
    }
}
