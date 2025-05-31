<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\PromoProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // acak
            if (rand(0, 100) < 20) {
                // biar tdk semuanya promo
                if (!PromoProduct::where('product_id', $product->id)->exists()) {
                    PromoProduct::factory()->create([
                        'product_id' => $product->id
                    ]);
                }
            }
        }
    }
}
