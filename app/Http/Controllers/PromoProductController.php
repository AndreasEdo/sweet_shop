<?php

namespace App\Http\Controllers;

use App\Models\PromoProduct;
use App\Http\Requests\StorePromoProductRequest;
use App\Http\Requests\UpdatePromoProductRequest;
use App\Models\Product;

class PromoProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promos = PromoProduct::with('product')->get();

        $promos->map(function($promo) {
            $hargaAwal = $promo->product->price;
            $diskon = $promo->promo;
            $hargaDiskon = $hargaAwal * (1 - $diskon / 100);
            $promo->price_after_discount = $hargaDiskon;
            return $promo;
        });

        // Ambil promo produk dengan tipe 'single'
        $singles = PromoProduct::with('product')
            ->whereHas('product', function($query) {
                $query->where('type', 'single');
            })
            ->take(5)
            ->get();

        // Hitung harga setelah diskon untuk $singles
        $singles->map(function($promo) {
            $hargaAwal = $promo->product->price;
            $diskon = $promo->promo;
            $hargaDiskon = $hargaAwal * (1 - $diskon / 100);
            $promo->price_after_discount = $hargaDiskon;
            return $promo;
        });

        $others = PromoProduct::with('product')
            ->whereHas('product', function($query) {
                $query->where('type', '!=', 'single');
            })
            ->take(5)
            ->get();

        $others->map(function($promo) {
            $hargaAwal = $promo->product->price;
            $diskon = $promo->promo;
            $hargaDiskon = $hargaAwal * (1 - $diskon / 100);
            $promo->price_after_discount = $hargaDiskon;
            return $promo;
        });

        return view('welcome', compact('promos', 'singles', 'others'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromoProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PromoProduct $promoProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PromoProduct $promoProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromoProductRequest $request, PromoProduct $promoProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PromoProduct $promoProduct)
    {
        //
    }
}
