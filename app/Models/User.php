<?php

namespace App\Models;

// Import trait HasFactory untuk guna factory (testing / seeding)
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Import class Authenticatable untuk fungsi authentication user
use Illuminate\Foundation\Auth\User as Authenticatable;

// Import Notifiable untuk notification (email, etc.)
use Illuminate\Notifications\Notifiable;

// Import HasApiTokens dari Laravel Sanctum
// Ini PENTING untuk membolehkan user generate API token
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /**
     * Trait yang digunakan oleh model User
     *
     * HasApiTokens  -> membolehkan user create & manage API token (Sanctum)
     * HasFactory   -> digunakan untuk database factory
     * Notifiable   -> digunakan untuk notification
     */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Senarai field yang dibenarkan untuk mass assignment
     * (contoh: semasa register user)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Field yang disembunyikan bila response JSON
     * (password tak boleh dipaparkan atas sebab keselamatan)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attribute kepada type tertentu
     * email_verified_at -> datetime
     * password -> hashed secara automatik oleh Laravel
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
