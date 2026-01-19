<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langkah extends Model
{
    use HasFactory;

    protected $table      = 'langkah';
    protected $primaryKey = 'id_langkah';

    protected $fillable = [
        'id_resep',
        'urutan',
        'deskripsi',
    ];

    // Relasi: banyak langkah milik 1 resep
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }
}
