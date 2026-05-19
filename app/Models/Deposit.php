<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model 
{
    protected $fillable = ['user_id', 'trx_id', 'amount', 'method', 'status'];

    public function user() { 
        return $this->belongsTo(User::class); 
    }
}