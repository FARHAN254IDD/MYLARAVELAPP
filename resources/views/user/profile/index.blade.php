@extends('layouts.user')

@section('title', 'My Profile')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">My Profile</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Phone</label>
            <input type="text" name="phone" value="{{ $user->phone }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">New Password (leave blank if unchanged)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Profile
        </button>
    </form>
</div>
@endsection
