<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 mt-10">

        <h2 class="text-2xl font-bold text-center text-indigo-600">Reset Password</h2>
        <p class="text-center text-gray-500 mb-6">
            Create a new password for your account.
        </p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" type="email" name="email"
                    :value="old('email', $request->email)"
                    class="block w-full mt-1" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" type="password" name="password"
                    class="block w-full mt-1" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                    class="block w-full mt-1" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Reset Password') }}
            </x-primary-button>

        </form>

    </div>
</x-guest-layout>
