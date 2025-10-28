<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ShopHub</title>
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
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition">Products</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white transition">Cart</a>
                    <a href="{{ route('dashboard') }}" class="text-white font-semibold">Dashboard</a>
                    @can('admin')
                        <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition">Admin</a>
                    @endcan
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
                <a href="{{ route('dashboard') }}" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Member Information</h1>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- User Profile Card --}}
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            {{-- Profile Header --}}
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-white">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-24 h-24 bg-white bg-opacity-20 backdrop-blur-sm rounded-full overflow-hidden flex items-center justify-center">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            @endif
                        </div>
                        {{-- Upload Avatar Button --}}
                        <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" 
                              x-data="{ uploading: false }"
                              @submit="uploading = true">
                            @csrf
                            <label class="absolute bottom-0 right-0 bg-white text-blue-600 rounded-full p-2 cursor-pointer hover:bg-gray-100 transition shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <input type="file" name="avatar" accept="image/*" class="hidden" 
                                       @change="if ($event.target.files.length > 0) { $el.closest('form').submit(); }">
                            </label>
                        </form>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                        <p class="text-blue-100">@if(Auth::user()->role === 'admin') Administrator @else Member @endif</p>
                    </div>
                </div>
            </div>

            {{-- Profile Details --}}
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <span class="text-gray-600 font-medium">Email:</span>
                    <span class="text-gray-900">{{ Auth::user()->email }}</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <span class="text-gray-600 font-medium">Name:</span>
                    <span class="text-gray-900">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <span class="text-gray-600 font-medium">Member Since:</span>
                    <span class="text-gray-900">{{ Auth::user()->created_at->format('F d, Y') }}</span>
                </div>
                <div class="flex items-center justify-between py-3">
                    <span class="text-gray-600 font-medium">Account Status:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Active
                    </span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="bg-gray-50 px-6 py-4 flex items-center gap-3">
                <a href="{{ route('profile.edit') }}" 
                   class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Edit Profile
                </a>
                <a href="{{ route('home') }}" 
                   class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100 transition">
                    Back to Home
                </a>
                <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                    @csrf
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="mt-12 bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <x-logo class="h-10 text-white mx-auto mb-3" />
            <p class="text-gray-400 text-sm">© {{ date('Y') }} ShopHub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
