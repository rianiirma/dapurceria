<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class, 'id_user');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_user');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_user');
    }

    public function sukas()
    {
        return $this->hasMany(Suka::class, 'id_user');
    }

    public function favorits()
    {
        return $this->hasMany(Favorit::class, 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
