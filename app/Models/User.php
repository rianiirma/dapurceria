<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'foto_profil',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships
    public function reseps()
    {
        return $this->hasMany(Resep::class);
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

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
