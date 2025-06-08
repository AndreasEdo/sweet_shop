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
    <main class="container mx-auto px-4 md:px-8 py-8">

        <!-- Search and Sort Bar -->
        <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 mb-12">
            <div class="relative flex-grow w-full">
                <input type="text" name="search" placeholder="Search all your favorite types of flowers" value="{{ request('search') }}" class="w-full p-4 pl-12 text-lg bg-[#FCE4EC] rounded-full focus:outline-none focus:ring-2 focus:ring-pink-300 placeholder-pink-400 border border-transparent focus:border-pink-300">
                <svg class="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-pink-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="relative w-full md:w-auto">
                <select name="sort" onchange="this.form.submit()" class="w-full md:w-64 appearance-none p-4 pr-10 text-lg bg-[#FCE4EC] text-pink-500 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-300 border border-transparent">
                    <option value="latest" @if(request('sort') == 'latest') selected @endif>Sort by: Newest</option>
                    <option value="price_asc" @if(request('sort') == 'price_asc') selected @endif>Price: Low to High</option>
                    <option value="price_desc" @if(request('sort') == 'price_desc') selected @endif>Price: High to Low</option>
                </select>
                <svg class="w-6 h-6 absolute right-4 top-1/2 -translate-y-1/2 text-pink-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </form>

        <!-- Product Sections -->
        @forelse ($groupedProducts as $type => $products)
            <section class="mb-12">
                <h2 class="text-[#E91E63] text-3xl font-bold mb-6 capitalize">{{ $type }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div class="bg-[#FCE4EC] rounded-2xl p-4 flex flex-col group">
                            <div class="relative">
                                <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-xl">
                                <button class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full text-pink-400 hover:text-pink-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                                </button>
                            </div>
                            <div class="bg-white rounded-2xl p-4 mt-[-2rem] z-10 mx-4 flex flex-col flex-grow shadow-lg">
                                <h3 class="text-xl font-bold text-gray-800">{{ $product->name }}</h3>
                                <div class="flex items-center my-2 text-sm text-gray-500">
                                    <div class="flex text-yellow-400">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-xs">25 Favorites</span>
                                </div>
                                <p class="text-gray-400 text-xs flex-grow leading-relaxed">Anniversary, Valentine's Day, Mother's Day, surprise gift, or any other loving moment.</p>
                                <p class="text-2xl font-bold text-[#E91E63] my-4">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                                <div class="grid grid-cols-2 gap-3 mt-auto">
                                    @if (auth()->check())
                                        <a href="javascript:void(0)" data-product-id="{{ $product->id }}" class="add-to-cart w-full bg-[#E91E63] text-white py-3 rounded-lg font-semibold text-center hover:bg-pink-700 transition">Add To Cart</a>
                                    @else
                                        <a href="{{ route('login_page') }}" class="w-full bg-[#E91E63] text-white py-3 rounded-lg font-semibold text-center hover:bg-pink-700 transition">Add To Cart</a>
                                    @endif
                                    <a href="#" class="w-full bg-white text-[#E91E63] py-3 rounded-lg font-semibold border-2 border-[#E91E63] text-center hover:bg-pink-50 transition">Detail Product</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">No products found. Please check back later!</p>
            </div>
        @endforelse

        <!-- Custom Order Section -->
        <section class="mt-16 bg-[#FCE4EC] rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
             <img src="https://www.onlygfx.com/wp-content/uploads/2022/03/flower-branch-2-cover.png" class="absolute bottom-[-50px] right-[-50px] h-full opacity-40 z-0" alt="Decorative Flower">
            <div class="md:w-1/2 text-center md:text-left z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-[#E91E63]">Custom Flower Order</h2>
                <p class="text-xl text-gray-600 mt-2">Personalized - One of a Kind</p>
                <p class="text-gray-500 mt-4">Tailor your bouquet for any moment. Weddings, birthdays, apologies, or just because. <br> You choose. We create.</p>
            </div>
            <div class="w-full md:w-1/2 z-10">
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" placeholder="Name" class="w-full p-4 text-lg bg-white border-2 border-pink-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <input type="text" placeholder="Phone Number" class="w-full p-4 text-lg bg-white border-2 border-pink-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <textarea placeholder="Description" rows="4" class="w-full p-4 text-lg bg-white border-2 border-pink-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300"></textarea>
                    <button type="submit" class="w-full bg-[#E91E63] text-white py-4 rounded-lg font-semibold text-xl hover:bg-pink-700 transition">Submit Order</button>
                </form>
            </div>
        </section>

    </main>
    <x-footer/>
        <form id="cartForm" action="{{ route('cart.add') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="product_id" id="product_id">
        <input type="hidden" name="quantity" value="1">
    </form>
    <script>
        window.cartAddRoute = "{{ route('cart.add') }}";
        window.csrfToken = "{{ csrf_token() }}";
    </script>

</body>
</html>
