<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function review(){
        return $this->belongsToMany(Review::class);
    }

    public function cart(){
        return $this->belongsToMany(Cart::class);
    }

    public function order_detail(){
        return $this->belongsToMany(OrderDetail::class);
    }
}
