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
        'type',
        'image'
    ];

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_detail(){
        return $this->belongsToMany(OrderDetail::class);
    }

    public function promoProduct()
    {
        return $this->hasOne(PromoProduct::class);
    }

}
