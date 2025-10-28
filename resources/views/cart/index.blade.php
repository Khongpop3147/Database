<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - ShopHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    {{-- Header with Logo, Navigation and Icons --}}
    <header class="bg-gray-900 border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            {{-- Left: Home Icon + Navigation Links --}}
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition">Products</a>
                    <a href="{{ route('cart.index') }}" class="text-white font-semibold">Cart</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition">Dashboard</a>
                    @can('admin')
                        <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition">Admin</a>
                    @endcan
                </nav>
            </div>
            
            {{-- Logo --}}
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <x-logo class="h-8 text-white" />
            </div>
            
            {{-- Right Icons --}}
            <div class="flex items-center gap-4">
                <a href="#" class="text-red-500 hover:text-red-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </a>
                <a href="{{ route('cart.index') }}" class="text-white">
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
    <main class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Shopping Cart</h1>

        @forelse($cart->items as $it)
            <div class="bg-white border border-gray-200 rounded-lg p-4 mb-3 flex items-center gap-4">
                {{-- Product Image --}}
                <div class="w-24 h-24 bg-gray-100 rounded flex-shrink-0 overflow-hidden">
                    @if($it->product && $it->product->images->first())
                        <img src="{{ asset('storage/' . $it->product->images->first()->path) }}" 
                             alt="{{ $it->product->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <svg class="w-full h-full text-gray-300 p-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="flex-1">
                    <h3 class="font-semibold text-lg text-gray-800">{{ $it->product->name ?? 'Product Deleted' }}</h3>
                    <p class="text-gray-600">฿{{ number_format($it->product->price ?? 0, 2) }}</p>
                </div>

                {{-- Quantity Update --}}
                <form method="POST" action="{{ route('cart.update', $it) }}" class="flex items-center gap-2">
                    @csrf
                    <input type="number" name="quantity" min="1" value="{{ $it->quantity }}" 
                           class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Update
                    </button>
                </form>

                {{-- Remove Button --}}
                <form method="POST" action="{{ route('cart.remove', $it) }}">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                        Remove
                    </button>
                </form>
            </div>
        @empty
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Your cart is empty</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Continue Shopping
                </a>
            </div>
        @endforelse

        @php $subtotal = $cart->items->sum(fn($i)=> $i->quantity * ($i->product->price ?? 0)); @endphp
        
        @if($cart->items->isNotEmpty())
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-semibold text-gray-700">Subtotal:</span>
                    <span class="text-2xl font-bold text-gray-900">฿{{ number_format($subtotal, 2) }}</span>
                </div>
                <a href="{{ route('checkout.summary') }}" 
                   class="block w-full text-center px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Proceed to Checkout
                </a>
            </div>
        @endif
    </main>
</body>
</html>
