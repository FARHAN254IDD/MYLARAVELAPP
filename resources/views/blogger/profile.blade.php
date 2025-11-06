@extends('layouts.blogger')

@section('title', 'My Profile')
@section('page_title', 'Profile Information')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-900 text-white p-8 rounded-xl shadow-lg border border-gray-700">
    <h2 class="text-2xl font-bold mb-6 text-blue-400">👤 My Profile</h2>

    <div class="space-y-4">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <div class="mt-8">
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">✏️ Edit Profile</a>
    </div>
</div>
@endsection
