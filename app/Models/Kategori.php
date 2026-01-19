<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table      = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    // 1 kategori bisa punya banyak resep
    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_kategori', 'id_kategori');
    }
}
