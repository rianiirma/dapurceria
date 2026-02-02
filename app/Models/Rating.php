<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['id_user', 'id_resep', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
}
