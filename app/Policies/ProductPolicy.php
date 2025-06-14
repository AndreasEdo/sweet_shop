<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Determine whether the admin can view any products.
     */
    public function viewAny(Admin $admin): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can view the product.
     */
    public function view(Admin $admin, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can create products.
     */
    public function create(Admin $admin): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can update the product.
     */
    public function update(Admin $admin, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can delete the product.
     */
    public function delete(Admin $admin, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the admin can restore the product.
     */
    public function restore(Admin $admin, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the admin can permanently delete the product.
     */
    public function forceDelete(Admin $admin, Product $product): bool
    {
        return false;
    }
}
