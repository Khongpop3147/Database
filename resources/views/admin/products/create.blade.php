<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - ShopHub Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    {{-- Header --}}
    <header class="bg-gray-900 border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition">Products</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white transition">Cart</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="text-white font-semibold">Admin</a>
                </nav>
            </div>
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <x-logo class="h-8 text-white" />
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="text-red-500 hover:text-red-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Create New Product</h1>
            <p class="text-gray-600 mt-1">Add a new product to your store</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <ul class="list-disc list-inside mt-2 text-sm text-red-700">
                            @foreach ($errors->all() as $error) 
                                <li>{{ $error }}</li> 
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                
                {{-- Product Images Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Images</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition"
                         x-data="{ files: [] }"
                         @drop.prevent="files = Array.from($event.dataTransfer.files)"
                         @dragover.prevent>
                        <input type="file" name="images[]" multiple accept="image/*" 
                               class="hidden" id="image-upload"
                               @change="files = Array.from($event.target.files)">
                        <label for="image-upload" class="cursor-pointer">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-600">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                        </label>
                        <template x-if="files.length > 0">
                            <div class="mt-4 text-sm text-gray-600">
                                <span x-text="files.length"></span> file(s) selected
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Product Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           placeholder="Enter product name" required>
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">— Select Category —</option>
                        @foreach($categories as $c) 
                            <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option> 
                        @endforeach
                    </select>
                </div>

                {{-- Price and Stock --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price (฿) *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                        <input type="number" name="stock" value="{{ old('stock') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               placeholder="0" required>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="5" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Enter product description">{{ old('description') }}</textarea>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        Create Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
