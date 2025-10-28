<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-white py-12 px-6">

        {{-- Heading --}}
        <div class="absolute top-8 left-8 text-gray-700 font-semibold text-2xl lg:text-3xl select-none">
            
        </div>

        {{-- Card --}}
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-lg p-8">
            {{-- LOGO --}}
            <div class="mb-6 text-center">
                <div class="mx-auto h-12 w-12 rounded-full bg-gray-200 grid place-items-center font-black text-gray-700">
                    LOGO
                </div>
            </div>

            {{-- Message --}}
            <div class="mb-4 text-sm text-gray-700">
                {{ __('Forgot your password? No problem. Enter your email address below and we’ll send you a link to reset your password.') }}
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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
                        placeholder="Email"
                        class="w-full h-12 rounded-lg border border-gray-300 px-4 text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Button --}}
                <div class="flex justify-center pt-2">
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-full px-8 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 transition"
                    >
                        Email Password Reset Link
                    </button>
                </div>

                {{-- Back to login --}}
                <div class="text-center text-sm text-gray-600 pt-2">
                    Remember your password?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
