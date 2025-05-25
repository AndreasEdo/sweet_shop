<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
