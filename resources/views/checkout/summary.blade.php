<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ShopHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ paymentMethod: 'acecoin' }">
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
                    @can('admin')
                        <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition">Admin</a>
                    @endcan
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
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="text-gray-600 mt-1">Complete your purchase</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Side: Payment Method --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Payment Channel Selection --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Payment Method</h2>
                    
                    <div class="space-y-3">
                        {{-- AceCoin Pay --}}
                        <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition"
                               :class="paymentMethod === 'acecoin' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="acecoin"
                                   x-model="paymentMethod"
                                   class="w-5 h-5 text-blue-600">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">AceCoin Pay</p>
                                        <p class="text-sm text-gray-500">Fast & Secure Payment</p>
                                    </div>
                                </div>
                            </div>
                            <svg class="w-6 h-6" :class="paymentMethod === 'acecoin' ? 'text-blue-600' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </label>

                        {{-- Credit Card --}}
                        <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition"
                               :class="paymentMethod === 'credit' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="credit"
                                   x-model="paymentMethod"
                                   class="w-5 h-5 text-blue-600">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Credit/Debit Card</p>
                                        <p class="text-sm text-gray-500">Visa, MasterCard, JCB</p>
                                    </div>
                                </div>
                            </div>
                            <svg class="w-6 h-6" :class="paymentMethod === 'credit' ? 'text-blue-600' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </label>

                        {{-- Bank Transfer --}}
                        <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition"
                               :class="paymentMethod === 'bank' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="bank"
                                   x-model="paymentMethod"
                                   class="w-5 h-5 text-blue-600">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Bank Transfer</p>
                                        <p class="text-sm text-gray-500">Direct bank payment</p>
                                    </div>
                                </div>
                            </div>
                            <svg class="w-6 h-6" :class="paymentMethod === 'bank' ? 'text-blue-600' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </label>
                    </div>
                </div>

                {{-- Payment Details (Shows based on selected method) --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6" x-show="paymentMethod === 'credit'" x-cloak>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Card Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                            <input type="text" placeholder="1234 5678 9012 3456" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                <input type="text" placeholder="MM/YY" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input type="text" placeholder="123" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                    
                    {{-- Product List --}}
                    <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                        @foreach($cart->items as $it)
                            <div class="flex gap-3">
                                <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                    @if($it->product && $it->product->images->first())
                                        <img src="{{ asset('storage/' . $it->product->images->first()->path) }}" 
                                             alt="{{ $it->product->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-full h-full text-gray-300 p-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 text-sm truncate">{{ $it->product->name }}</p>
                                    <p class="text-xs text-gray-500">Qty: {{ $it->quantity }}</p>
                                    <p class="text-sm font-semibold text-gray-900">฿{{ number_format(($it->product->price ?? 0) * $it->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Price Breakdown --}}
                    <div class="border-t border-gray-200 pt-4 space-y-2 mb-4">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>฿{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Tax</span>
                            <span>฿0.00</span>
                        </div>
                    </div>

                    {{-- Total --}}
                    <div class="border-t-2 border-gray-300 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-blue-600">฿{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    {{-- Pay Now Button --}}
                    <form method="POST" action="{{ route('checkout.confirm') }}">
                        @csrf
                        <button type="submit" class="w-full px-6 py-4 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Pay Now
                        </button>
                    </form>

                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Secure SSL Encrypted Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
