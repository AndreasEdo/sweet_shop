<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/carousel.js', 'resources/js/hiddenform.js'])
    <style>
        .btn-pink {
            background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
        }
        .btn-pink:hover {
            background: linear-gradient(135deg, #db2777 0%, #e11d48 100%);
        }
        .table-pink {
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
        }
    </style>
</head>
<body class="w-full bg-gray-50">
    <x-header/>

    <main class="p-4 min-h-screen">

        <div class="bg-white rounded-lg shadow-sm border mb-6 p-6">
            <div class="flex flex-wrap gap-6 items-center justify-between">
                <div class="flex flex-wrap gap-4 items-center">
                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Category</label>
                        <select class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white min-w-[150px]">
                            <option>Red Rose (2)</option>
                            <option>White Rose</option>
                            <option>Pink Rose</option>
                            <option>Mixed Bouquet</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Price</label>
                        <select class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white min-w-[180px]">
                            <option>Rp 10.000 - Rp 500.000</option>
                            <option>Rp 10.000 - Rp 100.000</option>
                            <option>Rp 100.000 - Rp 300.000</option>
                            <option>Rp 300.000 - Rp 500.000</option>
                        </select>
                    </div>
                </div>
                <a href="{{route('product.add')}}" class="btn-pink text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-200 whitespace-nowrap">
                    Add Product
                </a>
            </div>
        </div>


        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">

            <div class="table-pink px-6 py-4">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="col-span-5 flex items-center space-x-2">
                        <span class="text-sm font-semibold text-pink-700">Product Name</span>
                        <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="col-span-2 flex items-center space-x-2">
                        <span class="text-sm font-semibold text-pink-700">Price</span>
                        <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="col-span-2 flex items-center space-x-2">
                        <span class="text-sm font-semibold text-pink-700">Status</span>
                        <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="col-span-2 text-sm font-semibold text-pink-700">Stock</div>
                    <div class="col-span-1 text-sm font-semibold text-pink-700">Action</div>
                </div>
            </div>


            <div class="divide-y divide-pink-100">
                @foreach ($products as $index => $product)
                <div class="px-6 py-4 hover:bg-pink-25 transition-colors duration-200" style="background-color: rgba(253, 242, 248, 0.3);">
                    <div class="grid grid-cols-12 gap-4 items-center">

                        <div class="col-span-5 flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <img src="{{asset('storage/' . $product->image)}}" alt="">
                            </div>
                            <a class="min-w-0 flex-1 cursor-pointer" href="{{route('product.edit', $product->id)}}">
                                <p class="font-medium text-pink-600 text-sm truncate">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->type ?? 'Red Rose' }}</p>
                            </a>
                        </div>

                        <div class="col-span-2">
                            <span class="text-pink-600 font-medium text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="col-span-2">
                            @if($product->stock > 10)
                                <span class="text-pink-500 font-medium text-sm">Active</span>
                            @elseif($product->stock > 0)
                                <span class="text-orange-500 font-medium text-sm">Low Stock</span>
                            @else
                                <span class="text-red-500 font-medium text-sm">Out of Stock</span>
                            @endif
                        </div>

                        <!-- Stock -->
                        <div class="col-span-2">
                            <span class="text-gray-700 font-medium text-sm">{{ $product->stock }}</span>
                        </div>

                        <!-- Action -->
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button
                            type="button"
                            class="cursor-pointer bg-red-500 w-full text-white h-full rounded-xl hover:bg-red-700"
                            onclick="openDeleteModal('{{ route('product.destroy', $product->id) }}')"
                            >
                            Delete
                            </button>

                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <h3 class="text-lg font-semibold text-pink-700 mb-4">Confirm Delete</h3>
                <p class="mb-6 text-gray-700">Are you sure you want to delete this product?</p>
                <div class="flex justify-end space-x-4">
                <button id="cancelDelete" class="cursor-pointer px-4 py-2 rounded-full border border-gray-300 hover:bg-gray-100">Cancel</button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cursor-pointer btn-pink text-white px-4 py-2 rounded-full hover:shadow-lg transition duration-200">Delete</button>
                </form>
                </div>
            </div>
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </main>

    <x-footer/>
    <script>
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const cancelDelete = document.getElementById('cancelDelete');

    function openDeleteModal(actionUrl) {
        deleteForm.action = actionUrl;
        deleteModal.classList.remove('hidden');
    }

    cancelDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });


    deleteModal.addEventListener('click', (e) => {
        if (e.target === deleteModal) {
        deleteModal.classList.add('hidden');
        }
    });
    </script>

</body>
</html>
