<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suka extends Model
{
    use HasFactory;

    protected $table = 'sukas';

    protected $fillable = [
        'id_user',
        'id_resep',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
}
