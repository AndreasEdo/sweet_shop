<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        \Log::info('Add to cart request user:', ['user' => auth()->user()]);
        \Log::info('Request data:', $request->all());
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = auth()->user();
        $existingCart = Cart::where('user_id', $user->id)
                      ->where('product_id', $validated['product_id'])
                      ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $validated['quantity']);
        } else {

            Cart::create([
                'user_id' => $user->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.show', compact('cartItems', 'totalPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function invoiceGen(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('invoice.show', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user
        ]);
    }

    public function checkout(Request $request)
    {
        // \Log::info('invoiceGen accessed', [
        //     'user_id' => auth()->id(),
        //     'session_id' => session()->getId(),
        //     'auth_check' => auth()->check(),
        // ]);
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Keranjang Anda kosong.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });


        if ($user->money < $total) {
            return redirect()->route('cart.show')->with('error', 'Saldo Anda tidak mencukupi untuk checkout.');
        }


        $user->money -= $total;
        $user->save();

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('products.index')->with('success', 'Checkout berhasil! Terima kasih atas pesanan Anda.');
    }





}
