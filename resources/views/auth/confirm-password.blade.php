<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 mt-10">

        <h2 class="text-2xl font-bold text-center text-indigo-600">Confirm Password</h2>
        <p class="text-center text-gray-500 mb-6">
            This is a secure area. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password"
                    class="block w-full mt-1" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Confirm') }}
            </x-primary-button>
        </form>

    </div>
</x-guest-layout>
