<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Tambahkan 'whatsapp' di sini
    protected $fillable = ['name', 'email', 'whatsapp', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array {
        return [
            'password' => 'hashed',
        ];
    }

    public function orders() { 
        return $this->hasMany(Order::class); 
    }
    
    public function isAdmin() { 
        return $this->role === 'admin'; 
    }
}