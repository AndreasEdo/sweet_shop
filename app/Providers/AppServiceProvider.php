<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('update-product', function ($user, Product $product) {
            $admin = Auth::guard('admin')->user(); // ✅ Ambil dari guard admin

            if (!$admin) {
                return false; // ❌ Tidak login sebagai admin
            }

            return (new ProductPolicy)->update($admin, $product); // ✅ Gunakan policy
        });

    }
}
