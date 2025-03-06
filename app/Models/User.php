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
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_telepon',   // Menambahkan no telepon
        'gajipokok',     // Menambahkan gaji pokok
        'pinjaman',      // Menambahkan pinjaman
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gajipokok' => 'decimal:2', // Menambahkan casting untuk gaji pokok (format decimal dengan 2 tempat desimal)
            'pinjaman' => 'decimal:2',  // Menambahkan casting untuk pinjaman (format decimal dengan 2 tempat desimal)
        ];
    }
}
