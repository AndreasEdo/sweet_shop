<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Sweet Shop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <x-header/>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-4">Invoice</h2>

        <div class="bg-white shadow rounded p-6">
            <div class="mb-4">
                <p><strong>Customer:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>
            </div>

            <table class="w-full table-auto border-collapse mb-4">
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
                            <td class="py-2 px-4">{{ optional($item->product)->name ?? 'Produk tidak tersedia' }}</td>
                            <td class="py-2 px-4">Rp {{ number_format(optional($item->product)->price ?? 0, 0, ',', '.') }}</td>
                            <td class="py-2 px-4">Rp {{ number_format((optional($item->product)->price ?? 0) * $item->quantity, 0, ',', '.') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right text-xl font-semibold">
                Total: Rp {{ number_format($total, 0, ',', '.') }}
            </div>

            <form action="{{ route('checkout') }}" method="POST" class="mt-6 text-right">
                @csrf
                <button type="submit" class="btn-pink text-white px-4 py-2 rounded-full hover:shadow-lg transition-all duration-200">
                    Checkout
                </button>
            </form>
        </div>
    </div>

    <x-footer/>
</body>
</html>
