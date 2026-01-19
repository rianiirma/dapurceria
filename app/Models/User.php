<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table      = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 1 user bisa punya banyak komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_user', 'id_user');
    }

    // 1 user bisa punya banyak favorit
    public function favorit()
    {
        return $this->hasMany(Favorit::class, 'id_user', 'id_user');
    }
}
