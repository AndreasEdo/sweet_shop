<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Product - {{ $product->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen">

    <x-header />

    <main class="container mx-auto px-4 md:px-8 py-8">

        <section class="max-w-5xl mx-auto bg-[#FCE4EC] rounded-3xl p-8 shadow-lg flex flex-col md:flex-row gap-8">

            <!-- Gambar Produk -->
            <div class="flex-shrink-0 w-full md:w-1/2 rounded-xl overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-xl" />
            </div>

            <!-- Detail Produk -->
            <div class="flex flex-col flex-grow">

                <h1 class="text-4xl font-bold text-[#E91E63] mb-4">{{ $product->name }}</h1>

                <p class="text-gray-600 mb-6">{{ $product->description ?? 'No description available.' }}</p>

                <p class="text-3xl font-extrabold text-[#E91E63] mb-8">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <!-- Tombol Add to Cart -->
                @auth
                    <button id="addToCartBtn"
                        class="w-full md:w-64 bg-[#E91E63] text-white py-4 rounded-xl font-semibold text-lg hover:bg-pink-700 transition">
                        Add to Cart
                    </button>
                @else
                    <a href="{{ route('login_page') }}"
                        class="w-full md:w-64 block text-center bg-[#E91E63] text-white py-4 rounded-xl font-semibold text-lg hover:bg-pink-700 transition">
                        Login to Add to Cart
                    </a>
                @endauth

            </div>

        </section>

    </main>

    <x-footer />

    <!-- Form Tersembunyi untuk Add to Cart -->
    <form id="cartForm" action="{{ route('cart.add') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="product_id" id="product_id" />
        <input type="hidden" name="quantity" value="1" />
    </form>

    <script>
        // Bind event tombol Add to Cart (jika user sudah login)
        document.getElementById('addToCartBtn')?.addEventListener('click', function () {
            const productId = "{{ $product->id }}";
            const form = document.getElementById('cartForm');
            form.product_id.value = productId;
            form.submit();
        });
    </script>
</body>
</html>
