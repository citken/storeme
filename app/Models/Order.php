<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    // Tambahkan 'expires_at' dan 'is_suspended'
    protected $fillable = [
        'user_id', 'product_id', 'status', 'total_price', 
        'cbt_api_endpoint', 'cbt_api_key',
        'service_url', 'service_username', 'service_password',
        'expires_at', 'is_suspended'
    ];
    
    // Cast tanggal agar otomatis jadi objek Carbon (bisa dihitung)
    protected $casts = [
        'expires_at' => 'datetime',
        'is_suspended' => 'boolean',
    ];
    
    public function user() { return $this->belongsTo(User::class); }
    public function product() { return $this->belongsTo(Product::class); }
}