@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">➕ Add New User</h1>

<form method="POST" action="{{ route('admin.users.store') }}" class="bg-white p-6 rounded-xl shadow-md space-y-6">
    @csrf

    <div>
        <label class="block text-gray-700 mb-2">Name</label>
        <input type="text" name="name" class="w-full border-gray-300 rounded-lg" required>
    </div>

    <div>
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" class="w-full border-gray-300 rounded-lg" required>
    </div>

    <div>
        <label class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" class="w-full border-gray-300 rounded-lg" required>
    </div>

    <div>
        <label class="block text-gray-700 mb-2">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-lg" required>
    </div>

    <div>
        <label class="block text-gray-700 mb-2">Role</label>
        <select name="role" class="w-full border-gray-300 rounded-lg" required>
            <option value="user">User</option>
            <option value="blogger">Blogger</option>
            <option value="tester">Tester</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Create User</button>
</form>
@endsection
