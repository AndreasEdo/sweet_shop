<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Our Products - Sweet Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/carousel.js', 'resources/js/hiddenform.js'])
</head>
<body class="w-full bg-white">
    <x-header/>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Invoice</h2>

        <table class="w-full table-auto mb-4 border">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $cart->product->name }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $cart->quantity }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right font-semibold text-lg">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <div class="mt-6 flex justify-end">
            <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <button type="submit">Checkout</button>
            </form>
        </div>
    </div>

    <x-footer/>

</body>
</html>
