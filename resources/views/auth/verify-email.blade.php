<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 mt-10">

        <h2 class="text-2xl font-bold text-center text-indigo-600">Verify Your Email</h2>
        <p class="text-center text-gray-500 mb-6">
            Before continuing, please check your email for a verification link.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-green-600 text-sm font-medium text-center">
                A new verification link has been sent to your email.
            </div>
        @endif

        <div class="flex items-center justify-between mt-6">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Resend Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-sm text-gray-500 hover:text-gray-800 underline">
                    {{ __('Logout') }}
                </button>
            </form>

        </div>

    </div>
</x-guest-layout>
