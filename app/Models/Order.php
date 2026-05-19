<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    protected $fillable = [
        'user_id', 'product_id', 'status', 'total_price', 
        'cbt_api_endpoint', 'cbt_api_key',
        'service_url', 'service_username', 'service_password' // Kolom baru
    ];
    
    public function user() { return $this->belongsTo(User::class); }
    public function product() { return $this->belongsTo(Product::class); }
}