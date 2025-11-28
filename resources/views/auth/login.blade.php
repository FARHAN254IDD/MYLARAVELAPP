<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 mt-10">
        <h2 class="text-2xl font-bold text-center text-indigo-600">Welcome Back</h2>
        <p class="text-center text-gray-500 mb-6">Login to your account</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" class="block w-full mt-1"
                    :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password"
                    class="block w-full mt-1" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>

            <p class="text-center mt-4 text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register here</a>
            </p>
        </form>
    </div>
</x-guest-layout>
