@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">👥 Manage Users</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.users.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">+ Add New User</a>

<div class="mt-6 bg-white rounded-xl shadow-md overflow-x-auto">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Role</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3 capitalize">{{ $user->role }}</td>
                    <td class="p-3">
                        @if($user->is_blocked)
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm">Blocked</span>
                        @else
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm">Active</span>
                        @endif
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.users.block', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-yellow-600 hover:text-yellow-800">
                                {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
