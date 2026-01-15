<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'hashed_password', // ✅ Kolom baru
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'hashed_password', // ✅ Sembunyikan hashed_password
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'hashed_password' => 'hashed', // ✅ Cast kolom baru
        ];
    }

    // 👇 FUNGSI PENTING BIAR BISA LOGIN 👇
    public function getAuthPassword()
    {
        return $this->hashed_password;
    }
}