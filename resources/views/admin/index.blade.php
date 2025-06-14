<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Product List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <x-header />

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-pink-600">Admin Dashboard</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6 flex flex-wrap gap-4 items-end">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search product..." class="border border-pink-300 rounded px-4 py-2 w-64" />

            <select name="type" class="border border-pink-300 rounded px-4 py-2">
                <option value="">All Types</option>
                @foreach ($allTypes as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>

            <select name="sort" class="border border-pink-300 rounded px-4 py-2">
                <option value="">Sort: Newest</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>

            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">Filter</button>
            <a href="{{ route('product.add') }}" class="ml-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Add Product
            </a>
        </form>


        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-pink-100 text-pink-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Price</th>
                        <th class="px-4 py-3 text-left">Stock</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-t">
                            <td class="px-4 py-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400 italic">No image</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $product->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $product->type }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $product->stock }}</td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('product.edit', $product) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</a>

                                <form action="{{ route('product.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Are you sure to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-6">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </main>

    <x-footer />
</body>
</html>
