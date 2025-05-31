<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoProduct extends Model
{
    /** @use HasFactory<\Database\Factories\PromoProductFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'promo',
        'image',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
