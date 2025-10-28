<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 py-12 px-6 relative">

        {{-- Page Title on Left --}}
        <div class="absolute top-8 left-8 text-white font-semibold text-2xl lg:text-3xl select-none">
            Register Page
        </div>

        {{-- Card --}}
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-lg p-8">
            {{-- LOGO --}}
            <div class="mb-6 text-center">
                <div class="text-3xl font-black text-gray-800">
                    LOGO
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="sr-only">Name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Name"
                        value="{{ old('name') }}"
                        class="w-full h-12 rounded-lg bg-gray-300 border-0 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        autocomplete="username"
                        placeholder="Email"
                        value="{{ old('email') }}"
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
                        autocomplete="new-password"
                        placeholder="Password"
                        class="w-full h-12 rounded-lg bg-gray-300 border-0 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm Password"
                        class="w-full h-12 rounded-lg bg-gray-300 border-0 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Submit --}}
                <div class="flex justify-center pt-2">
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-full px-10 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 transition font-semibold"
                    >
                        Register
                    </button>
                </div>

                {{-- Back to login --}}
                <div class="text-center text-sm text-gray-600 pt-2">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Log in</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
