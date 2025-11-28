<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 mt-10">

        <h2 class="text-2xl font-bold text-center text-indigo-600">Forgot Password?</h2>
        <p class="text-center text-gray-500 mb-6">
            Enter your email and we'll send you a reset link.
        </p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" type="email" name="email"
                    class="block w-full mt-1" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </form>

    </div>
</x-guest-layout>
