<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'discount_percent', 'logo_path', 'is_cbt_panel'];
    
    protected $casts = [
        'is_cbt_panel' => 'boolean',
    ];

    public function category() { 
        return $this->belongsTo(Category::class); 
    }

    // Auto-Kalkulator Diskon
    public function getFinalPriceAttribute() {
        if ($this->discount_percent > 0) {
            return $this->price - ($this->price * ($this->discount_percent / 100));
        }
        return $this->price;
    }
}