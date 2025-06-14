<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Our Products - Sweet Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/carousel.js', 'resources/js/hiddenform.js'])
</head>
<body class="w-full bg-white">
    <x-header />

    <main class="container mx-auto px-4 md:px-8 py-8">

        <!-- Filter Form -->
        <form id="filterForm" class="flex flex-col md:flex-row items-center gap-4 mb-12" onsubmit="return false;">
            <input
                type="text"
                id="searchInput"
                placeholder="Search products..."
                class="w-full md:flex-grow p-4 pl-4 rounded-full border border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300"
            />

            <select
                id="filterType"
                class="w-full md:w-48 p-4 rounded-full border border-pink-300 text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-300"
            >
                <option value="">All Types</option>
                @foreach ($allTypes as $type)
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>

            <select
                id="sortSelect"
                class="w-full md:w-56 p-4 rounded-full border border-pink-300 text-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-300"
            >
                <option value="latest">Newest</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
            </select>
        </form>

        <!-- Container to render filtered products -->
        <div id="productsContainer"></div>

    </main>

    <x-footer />

    <form id="cartForm" action="{{ route('cart.add') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="product_id" id="product_id" />
        <input type="hidden" name="quantity" value="1" />
    </form>

    <script>
        window.cartAddRoute = "{{ route('cart.add') }}";
        window.csrfToken = "{{ csrf_token() }}";

        const products = [
            @foreach ($groupedProducts as $type => $prods)
                @foreach ($prods as $product)
                {
                    id: {{ $product->id }},
                    name: @json($product->name),
                    type: @json($type),
                    price: {{ $product->price }},
                    image: @json(asset('storage/' . $product->image)),
                    favorites: 25,
                    description: "Anniversary, Valentine's Day, Mother's Day, surprise gift, or any other loving moment.",

                },
                @endforeach
            @endforeach
        ];


        const searchInput = document.getElementById('searchInput');
        const filterType = document.getElementById('filterType');
        const sortSelect = document.getElementById('sortSelect');
        const productsContainer = document.getElementById('productsContainer');


        function renderProducts(data) {
            if(data.length === 0) {
                productsContainer.innerHTML = `
                <div class="text-center py-16">
                    <p class="text-gray-500 text-lg">No products found. Please check back later!</p>
                </div>`;
                return;
            }


            const grouped = data.reduce((acc, prod) => {
                (acc[prod.type] = acc[prod.type] || []).push(prod);
                return acc;
            }, {});

            let html = '';
            for (const [type, prods] of Object.entries(grouped)) {
                html += `
                <section class="mb-12">
                    <h2 class="text-[#E91E63] text-3xl font-bold mb-6 capitalize">${type}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">`;

                prods.forEach(product => {
                    html += `
                    <div class="bg-[#FCE4EC] rounded-2xl p-4 flex flex-col group">
                        <div class="relative">
                            <img src="${product.image}" alt="${product.name}" class="w-full h-64 object-cover rounded-xl" />
                            <button class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full text-pink-400 hover:text-pink-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="bg-white rounded-2xl p-4 mt-[-2rem] z-10 mx-4 flex flex-col flex-grow shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800">${product.name}</h3>
                            <div class="flex items-center my-2 text-sm text-gray-500">
                                <div class="flex text-yellow-400">` +
                                    new Array(5).fill(`
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>`).join('') +
                                `</div>
                                <span class="ml-2 text-xs">${product.favorites} Favorites</span>
                            </div>
                            <p class="text-gray-400 text-xs flex-grow leading-relaxed">${product.description}</p>
                            <p class="text-2xl font-bold text-[#E91E63] my-4">Rp ${product.price.toLocaleString('id-ID')}</p>
                            <div class="grid grid-cols-2 gap-3 mt-auto">
                                @if(auth()->check())
                                <a href="javascript:void(0)" data-product-id="${product.id}" class="add-to-cart w-full bg-[#E91E63] text-white py-3 rounded-lg font-semibold text-center hover:bg-pink-700 transition">Add To Cart</a>
                                @else
                                <a href="{{ route('login_page') }}" class="w-full bg-[#E91E63] text-white py-3 rounded-lg font-semibold text-center hover:bg-pink-700 transition">Add To Cart</a>
                                @endif
                                <a href="{{ url('sweets') }}/${product.id}" class="w-full bg-white text-[#E91E63] py-3 rounded-lg font-semibold border-2 border-[#E91E63] text-center hover:bg-pink-50 transition">Detail Product</a>
                            </div>
                        </div>
                    </div>
                    `;  
                });

                html += `</div></section>`;
            }

            productsContainer.innerHTML = html;

            // Bind event listener to Add to Cart buttons after render
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', addToCartHandler);
            });
        }

        // Fungsi filter, sort dan search
        function filterAndRender() {
            let filtered = products;

            // Filter by type
            const typeValue = filterType.value.toLowerCase();
            if (typeValue) {
                filtered = filtered.filter(p => p.type.toLowerCase() === typeValue);
            }

            // Filter by search keyword (case-insensitive)
            const keyword = searchInput.value.trim().toLowerCase();
            if (keyword) {
                filtered = filtered.filter(p => p.name.toLowerCase().includes(keyword));
            }

            // Sort
            const sortValue = sortSelect.value;
            if (sortValue === 'price_asc') {
                filtered.sort((a, b) => a.price - b.price);
            } else if (sortValue === 'price_desc') {
                filtered.sort((a, b) => b.price - a.price);
            } else if (sortValue === 'latest') {
                filtered.sort((a, b) => b.id - a.id); // asumsi id urut berdasarkan produk terbaru
            }

            renderProducts(filtered);
        }

        // Add to Cart Handler (contoh sederhana)
        function addToCartHandler(event) {
            const productId = event.currentTarget.getAttribute('data-product-id');
            if (!productId) return;

            const form = document.getElementById('cartForm');
            form.product_id.value = productId;
            form.submit();
        }

        // Event listener
        searchInput.addEventListener('input', filterAndRender);
        filterType.addEventListener('change', filterAndRender);
        sortSelect.addEventListener('change', filterAndRender);

        // Render all products awal
        filterAndRender();
    </script>
</body>
</html>
