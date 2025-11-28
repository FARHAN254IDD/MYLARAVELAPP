







<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 mt-10">
        <h2 class="text-2xl font-bold text-center text-indigo-600">Create an Account</h2>
        <p class="text-center text-gray-500 mb-6">Join us today</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" type="text" name="name" class="block w-full mt-1"
                    :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" type="email" name="email" class="block w-full mt-1"
                    :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" class="block w-full mt-1" required/>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                    class="block w-full mt-1" required/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>

            <p class="text-center mt-4 text-sm text-gray-600">
                Already registered?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">
                    Login here
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>












