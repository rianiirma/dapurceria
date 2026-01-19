<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table      = 'bahan';
    protected $primaryKey = 'id_bahan';

    protected $fillable = [
        'id_resep',
        'nama_bahan',
        'jumlah',
        'satuan',
    ];

    // Relasi: banyak bahan milik 1 resep
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }
}
