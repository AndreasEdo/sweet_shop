<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProductController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('/admin/index', ['products' =>  $products]);
    }

    public function showProducts(Request $request)
    {
        $query = Product::query();

        // Handle Search functionality
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Handle Sorting functionality
        if ($request->get('sort') == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->get('sort') == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest(); // Default to newest
        }

        // Get the products and group them by their 'type'
        $products = $query->get();
        $groupedProducts = $products->groupBy('type');

        return view('products.index', [
            'groupedProducts' => $groupedProducts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/sweets/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreProductRequest $request)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20|string',
            'description' => 'required',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:1',
            'type' => 'required',
            'image' => 'nullable|mimes:png,jpg|max:1000',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }


        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'type' => $validated['type'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        return view('/sweets/edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateProductRequest $request, Product $product)
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }


        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }
}
