<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - ShopHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
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
                    <a href="{{ route('products.index') }}" class="text-white font-semibold">Products</a>
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white transition">Cart</a>
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition">Dashboard</a>
                        @can('admin')
                            <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition">Admin</a>
                        @endcan
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Login</a>
                    @endauth
                </nav>
            </div>
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <x-logo class="h-8 text-white" />
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('wishlist.index') }}" class="text-red-500 hover:text-red-600 relative">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    @if($wishlistCount > 0)
                        <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $wishlistCount > 9 ? '9+' : $wishlistCount }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount > 9 ? '9+' : $cartCount }}
                        </span>
                    @endif
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Product Images --}}
            <div>
                @if($product->images->isNotEmpty())
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mb-4">
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover"
                             x-data
                             id="mainImage">
                    </div>
                    
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($product->images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-24 object-cover border-2 border-gray-200 rounded cursor-pointer hover:border-blue-500 transition"
                                     onclick="document.getElementById('mainImage').src = this.src">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="bg-gray-100 rounded-lg flex items-center justify-center h-96">
                        <svg class="w-32 h-32 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Product Details --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                
                @if($product->category)
                    <p class="text-gray-500 mb-4">{{ $product->category->name }}</p>
                @endif

                <div class="text-4xl font-bold text-blue-600 mb-6">
                    ฿{{ number_format($product->price, 2) }}
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-600">Stock:</span>
                        <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? $product->stock . ' units' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>

                @auth
                    <div class="flex gap-3 mb-6">
                        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="w-full px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Add to Cart
                            </button>
                        </form>

                        <form method="POST" action="{{ route('wishlist.toggle', $product) }}">
                            @csrf
                            <button type="submit" 
                                    class="px-6 py-3 rounded-lg border-2 transition {{ auth()->user()->wishlists->contains('product_id', $product->id) ? 'border-red-500 bg-red-50 text-red-500 hover:bg-red-100' : 'border-gray-300 bg-white text-gray-600 hover:border-red-500 hover:text-red-500' }}">
                                <svg class="w-6 h-6" fill="{{ auth()->user()->wishlists->contains('product_id', $product->id) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" 
                       class="block w-full text-center px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        Login to Purchase
                    </a>
                @endauth

                <div class="border-t border-gray-200 pt-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Description</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description ?? 'No description available.' }}</p>
                </div>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="mt-12 border-t border-gray-200 pt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
            
            {{-- Review Form --}}
            @auth
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Write a Review</h3>
                    <form method="POST" action="{{ route('reviews.store', $product) }}" x-data="{ rating: 5 }">
                        @csrf
                        <input type="hidden" name="rating" x-model="rating">
                        
                        {{-- Star Rating --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex gap-2">
                                <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                    <button type="button"
                                            @click="rating = star"
                                            class="focus:outline-none transition-transform hover:scale-110">
                                        <svg class="w-8 h-8" 
                                             :class="star <= rating ? 'text-yellow-400' : 'text-gray-300'"
                                             fill="currentColor" 
                                             viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Comment --}}
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea name="comment" 
                                      id="comment" 
                                      rows="4" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Share your thoughts about this product..."
                                      required></textarea>
                        </div>

                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            Submit Review
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8 text-center">
                    <p class="text-blue-800">
                        <a href="{{ route('login') }}" class="font-semibold hover:underline">Login</a> to write a review
                    </p>
                </div>
            @endauth

            {{-- Reviews List --}}
            @forelse($product->reviews as $r)
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-semibold">{{ substr($r->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $r->user->name }}</p>
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $r->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">{{ $r->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700">{{ $r->comment }}</p>
                </div>
            @empty
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <p class="text-gray-500">No reviews yet. Be the first to review!</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>
