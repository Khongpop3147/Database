<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Member Info - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            {{-- Card Container --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                {{-- User Icon Section --}}
                <div class="bg-white pt-8 pb-6 text-center">
                    <div class="mx-auto w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>

                    {{-- User Name --}}
                    <div class="px-8">
                        <div class="text-xl font-semibold text-gray-800 mb-6">
                            {{ Auth::user()->name }}
                        </div>

                        {{-- User Info Fields --}}
                        <div class="space-y-4 text-left">
                            {{-- Email --}}
                            <div class="border-b border-gray-300 pb-2">
                                <label class="block text-xs text-gray-500 mb-1">Email</label>
                                <div class="text-gray-800">{{ Auth::user()->email }}</div>
                            </div>

                            {{-- Name Fields (example layout from mockup) --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="border-b border-gray-300 pb-2">
                                    <label class="block text-xs text-gray-500 mb-1">First Name</label>
                                    <div class="text-gray-800">{{ explode(' ', Auth::user()->name)[0] ?? '' }}</div>
                                </div>
                                <div class="border-b border-gray-300 pb-2">
                                    <label class="block text-xs text-gray-500 mb-1">Last Name</label>
                                    <div class="text-gray-800">{{ explode(' ', Auth::user()->name)[1] ?? '' }}</div>
                                </div>
                            </div>

                            {{-- Member Since --}}
                            <div class="border-b border-gray-300 pb-2">
                                <label class="block text-xs text-gray-500 mb-1">Member Since</label>
                                <div class="text-gray-800">{{ Auth::user()->created_at->format('F Y') }}</div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 space-y-3">
                            <a href="{{ route('profile.edit') }}" 
                               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2.5 transition">
                                Edit Profile
                            </a>
                            <a href="{{ route('home') }}" 
                               class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-2.5 transition">
                                Back to Home
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-center bg-red-500 hover:bg-red-600 text-white rounded-lg py-2.5 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Footer with LOGO --}}
                <div class="bg-gray-200 py-4 text-center">
                    <div class="text-2xl font-black text-gray-800">LOGO</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
