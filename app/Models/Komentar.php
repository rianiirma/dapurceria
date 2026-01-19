<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table      = 'komentar';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_resep',
        'id_user',
        'isi_komentar',
    ];

    // Relasi: komentar milik 1 resep
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }

    // Relasi: komentar milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
