<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // Import MustVerifyEmail
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Implementasikan kontrak MustVerifyEmail
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke pengaduan yang dibuat user
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
