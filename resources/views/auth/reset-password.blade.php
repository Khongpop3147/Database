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

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                {{-- Hidden Token --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Email"
                        class="w-full h-12 rounded-lg border border-gray-300 px-4 text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
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
                        placeholder="New Password"
                        class="w-full h-12 rounded-lg border border-gray-300 px-4 text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
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
                        class="w-full h-12 rounded-lg border border-gray-300 px-4 text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Submit --}}
                <div class="flex justify-center pt-2">
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-full px-8 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 transition"
                    >
                        Reset Password
                    </button>
                </div>

                {{-- Back to login --}}
                <div class="text-center text-sm text-gray-600 pt-2">
                    Remembered your password?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
