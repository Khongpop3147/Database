<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products - {{ config('app.name', 'Laravel') }}</title>
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
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <x-logo class="h-8 text-white" />
            </div>

            {{-- Right Icons --}}
            <div class="flex items-center gap-4">
                {{-- Wishlist/Heart Icon --}}
                <a href="#" class="text-red-500 hover:text-red-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
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
    <main class="max-w-7xl mx-auto px-4 py-6">
        {{-- Search Bar --}}
        <div class="mb-6">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search products..." 
                    value="{{ request('search') }}"
                    class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        {{-- Product Grid (4 columns) --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    {{-- Product Image --}}
                    <div class="bg-gray-200 aspect-square flex items-center justify-center overflow-hidden">
                        @if($product->images->first())
                            <img src="{{ asset('storage/'.$product->images->first()->path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        @else
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="p-3">
                        <h3 class="text-sm font-medium text-gray-800 truncate mb-1">{{ $product->name }}</h3>
                        <div class="flex items-center gap-1 text-xs text-gray-500 mb-1">
                            <span>⭐</span>
                            <span>{{ number_format($product->reviews_avg_rating ?? 0, 1) }}</span>
                            <span class="text-gray-300">•</span>
                            <span>{{ $product->reviews_count ?? 0 }}</span>
                        </div>
                        <p class="text-base font-semibold text-blue-600">฿{{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p>No products available.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </main>
</body>
</html>
