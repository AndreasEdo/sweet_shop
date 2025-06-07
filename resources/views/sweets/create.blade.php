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
        .upload-area {
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
        }
        .remove-file {
            background: #ec4899;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
        }
        .error-input {
            border-color: #ef4444 !important;
        }
        .error-text {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="w-full bg-gray-50">
    <x-header/>

    <main class="p-4 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border p-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Upload Image</label>
                            <div class="upload-area border-2 border-dashed rounded-lg p-8 text-center @error('image') border-red-500 @else border-pink-300 @enderror">
                                <div class="mb-4">
                                    <div class="w-20 h-16 mx-auto bg-pink-500 rounded-lg flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                </div>
                                <input type="file" name="image" accept=".png,.jpg" class="hidden" id="file-upload" onchange="handleFileSelect(event)">
                                <label for="file-upload" class="cursor-pointer">
                                    <span class="text-gray-600">Click to upload image</span>
                                </label>
                                <div id="file-list" class="mt-4 space-y-2"></div>
                            </div>
                            @error('image')
                                <div class="">{{ $message }}</div>
                            @enderror
                        </div>


                        <div>
                            <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Product Type</label>
                            <select name="type" id="type" class="w-full border-2 rounded-lg px-4 py-3 focus:ring-2 outline-none transition-all>
                                <option value="">Select product type</option>
                                <option value="Single" {{ old('type') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Bouquet" {{ old('type') == 'Bouquet' ? 'selected' : '' }}>Bouquet</option>
                            </select>
                            @error('type')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border-2 rounded-lg px-4 py-3 focus:ring-2 outline-none transition-all">
                            @error('name')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="6" class="w-full border-2 rounded-lg px-4 py-3 focus:ring-2 outline-none transition-all resize-none @error('description') error-input border-red-500 @else border-pink-300 @enderror" >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" min="1000" name="price" id="price" value="{{ old('price') }}" class="w-full border-2 rounded-lg pl-12 pr-4 py-3 focus:ring-2 outline-none transition-all @error('price') error-input border-red-500 @else border-pink-300 @enderror" >
                            </div>
                            @error('price')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                            <input type="number" min="1" name="stock" id="stock" value="{{ old('stock') }}" class="w-full border-2 rounded-lg px-4 py-3 focus:ring-2 outline-none transition-all @error('stock') error-input border-red-500 @else border-pink-300 @enderror" >
                            @error('stock')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full btn-pink text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transition-all duration-200">
                                Add Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <x-footer/>

    <script>
        function handleFileSelect(event) {
            const file = event.target.files[0];
            const fileList = document.getElementById('file-list');

            fileList.innerHTML = ''; // Kosongkan daftar file sebelumnya

            if (file) {
                // Buat preview gambar
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imagePreview = document.createElement('img');
                    imagePreview.src = e.target.result;
                    imagePreview.className = 'mx-auto rounded-lg w-32 h-24 object-cover mb-2';

                    fileList.appendChild(imagePreview);

                    const fileDiv = document.createElement('div');
                    fileDiv.className = 'flex items-center justify-between bg-pink-50 border border-pink-200 rounded-full px-4 py-2';
                    fileDiv.innerHTML = `
                        <span class="text-pink-600 text-sm">${file.name}</span>
                        <button type="button" class="remove-file" onclick="removeFile(this)">×</button>
                    `;
                    fileList.appendChild(fileDiv);
                };
                reader.readAsDataURL(file);
            }
        }

        function removeFile(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
