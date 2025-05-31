<?php

namespace Database\Factories;

use App\Models\PromoProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromoProductFactory extends Factory
{
    protected $model = PromoProduct::class;

    public function definition()
    {
        return [

            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'promo' => $this->faker->randomFloat(2, 5, 50), //persen btw
            'image' => 'promo.jpg',
        ];
    }
}
