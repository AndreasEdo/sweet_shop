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
        <div class="container mx-auto px-4 py-6">
            <h2 class="text-2xl font-semibold mb-6">Your Cart</h2>

            @if($cartItems->isEmpty())
                <p class="text-gray-600">Your cart is empty.</p>
            @else
                <div class="bg-white rounded-lg shadow p-6">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-pink-100 text-pink-700">
                                <th class="py-2 px-4 text-left">Product</th>
                                <th class="py-2 px-4 text-left">Quantity</th>
                                <th class="py-2 px-4 text-left">Price</th>
                                <th class="py-2 px-4 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr class="border-t">
                                    <td class="py-2 px-4">{{ $item->product->name }}</td>
                                    <td class="py-2 px-4">{{ $item->quantity }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-between items-center mt-6">
                        <div class="text-lg font-semibold">Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}</div>

                        <a href="{{ route('invoice.generate') }}" class="bg-pink-700 btn-pink text-black px-4 py-2 rounded-full hover:shadow-lg transition-all duration-200">
                            Proceed to Invoice
                        </a>

                    </div>
                </div>
            @endif
        </div>

    <x-footer/>

</body>
</html>
