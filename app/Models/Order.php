<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'total_price'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order_detail(){
        return $this->hasOne(OrderDetail::class);
    }

}
