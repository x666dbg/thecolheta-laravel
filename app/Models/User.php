<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne; // Fix typo huruf besar
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'phone', 
        'gender', 
        'birth_date', 
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Pakai method casts() bawaan Laravel 11 biar rapi
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
        ];
    }

    // Relasi ke Customer
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'user_id', 'id');
    }
}