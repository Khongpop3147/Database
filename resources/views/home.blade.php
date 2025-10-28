<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    {{-- Header with Logo, Navigation and Icons --}}
    <header class="bg-gray-900 border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            {{-- Left: Home Icon + Navigation Links --}}
            <div class="flex items-center gap-6">
                {{-- Home Icon --}}
                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>

                {{-- Navigation Links --}}
                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('home') ? 'text-white font-semibold' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('products.*') ? 'text-white font-semibold' : '' }}">
                        Products
                    </a>
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('cart.*') ? 'text-white font-semibold' : '' }}">
                            Cart
                        </a>
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('dashboard') ? 'text-white font-semibold' : '' }}">
                            Dashboard
                        </a>
                        @can('admin')
                            <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition {{ request()->is('admin*') ? 'text-white font-semibold' : '' }}">
                                Admin
                            </a>
                        @endcan
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">
                            Login
                        </a>
                    @endauth
                </nav>
            </div>

            {{-- Logo --}}
            <div class="absolute left-1/2 transform -translate-x-1/2 text-2xl font-black text-white">
                <x-logo class="h-8 text-white" />
            </div>

            {{-- Right Icons --}}
            <div class="flex items-center gap-4">
                {{-- Wishlist/Heart Icon --}}
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
                
                {{-- Cart Icon --}}
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
                
                {{-- User Icon --}}
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-8 h-8 rounded-full object-cover border-2 border-gray-600">
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
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
    <main class="max-w-7xl mx-auto px-4 py-6">
        {{-- Banner Section with Image Slider --}}
        <section class="relative rounded-lg overflow-hidden mb-8" 
                 x-data="{ 
                     currentSlide: 0, 
                     slides: @js($banners->count() > 0 ? $banners->pluck('image_path')->map(fn($path) => asset('storage/' . $path))->toArray() : [
                         'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1200&h=400&fit=crop',
                         'https://images.unsplash.com/photo-1557821552-17105176677c?w=1200&h=400&fit=crop',
                         'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=400&fit=crop'
                     ])
                 }" 
                 x-init="setInterval(() => { currentSlide = (currentSlide + 1) % slides.length }, 5000)">
            <div class="relative h-64 md:h-80 bg-gradient-to-r from-blue-100 to-purple-100">
                {{-- Banner Images --}}
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="currentSlide === index" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="absolute inset-0">
                        <img :src="slide" alt="Banner" class="w-full h-full object-cover">
                    </div>
                </template>

                {{-- Dots Navigation --}}
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="currentSlide = index" 
                                :class="currentSlide === index ? 'bg-white' : 'bg-white/50'" 
                                class="w-2 h-2 rounded-full transition-all"></button>
                    </template>
                </div>
            </div>
        </section>

        {{-- Top Products Section (Hot Products with Fire Icon) --}}
        <section class="mb-8">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">🔥 Top products</h2>
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                @foreach($topProducts as $product)
                    <a href="{{ route('products.show', $product) }}" class="flex-shrink-0 w-32 relative">
                        {{-- Fire Icon Badge with Animation --}}
                        <div class="absolute top-1 right-1 z-10 bg-gradient-to-br from-red-500 to-orange-500 rounded-full p-1.5 shadow-lg animate-pulse">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 23c-4.97 0-9-4.03-9-9 0-2.5 1.02-4.77 2.67-6.41.45-.45 1.2-.38 1.56.15.36.54.25 1.27-.25 1.67C5.76 10.63 5 12.24 5 14c0 3.86 3.14 7 7 7s7-3.14 7-7c0-1.76-.76-3.37-1.98-4.59-.5-.4-.61-1.13-.25-1.67.36-.53 1.11-.6 1.56-.15C19.98 9.23 21 11.5 21 14c0 4.97-4.03 9-9 9zm0-16c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1z"/>
                            </svg>
                        </div>
                        
                        <div class="bg-gray-200 rounded-lg aspect-square flex items-center justify-center mb-2 overflow-hidden border-2 border-orange-300">
                            @if($product->images->first())
                                <img src="{{ asset('storage/'.$product->images->first()->path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-xs font-medium text-gray-800 truncate">{{ $product->name }}</h3>
                        <p class="text-xs text-orange-600 font-semibold">
                            🔥 {{ $product->order_items_count > 0 ? $product->order_items_count : rand(10, 99) }} sold
                        </p>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Recommended for You Section --}}
        <section>
            <h2 class="text-lg font-semibold mb-4 text-gray-800">recommended for you</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($latest as $product)
                    <div class="group relative">
                        {{-- Wishlist Heart Button --}}
                        @auth
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="absolute top-2 right-2 z-10">
                                @csrf
                                <button type="submit" class="bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition-all">
                                    @if(auth()->user()->wishlists->contains('product_id', $product->id))
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        @endauth

                        <a href="{{ route('products.show', $product) }}">
                            <div class="bg-gray-200 rounded-lg aspect-square flex items-center justify-center mb-2 overflow-hidden">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/'.$product->images->first()->path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                @else
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-sm font-medium text-gray-800 truncate">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">฿{{ number_format($product->price, 2) }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</body>
</html>
