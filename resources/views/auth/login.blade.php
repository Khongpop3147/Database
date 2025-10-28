<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 py-12 px-6 relative">

        {{-- Page Title on Left --}}
        <div class="absolute top-8 left-8 text-white font-semibold text-2xl lg:text-3xl select-none">
            Log-in Page
        </div>

        {{-- Card --}}
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-lg p-8">
            {{-- LOGO --}}
            <div class="mb-6 text-center">
                <div class="text-3xl font-black text-gray-800">
                    LOGO
                </div>
            </div>

            {{-- Session flash --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Email"
                        class="w-full h-12 rounded-lg bg-gray-300 border-0 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                        class="w-full h-12 rounded-lg bg-gray-300 border-0 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-full px-8 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 transition font-semibold"
                    >
                        LOGIN
                    </button>

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex justify-center rounded-full px-6 py-2.5 text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 transition font-semibold"
                    >
                        Register
                    </a>
                </div>

                {{-- Remember + Forgot (optional, below buttons) --}}
                @if (Route::has('password.request'))
                    <div class="text-center text-sm pt-2">
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                            Forgot password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>
