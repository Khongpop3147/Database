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
                {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you. If you didn\'t receive the email, we can send another one.') }}
            </div>

            {{-- Status --}}
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between gap-3">
                {{-- Resend --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-full px-6 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 transition"
                    >
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-md"
                    >
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
