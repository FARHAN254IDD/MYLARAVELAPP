@extends('layouts.admin')

@section('title', 'Manage Comments')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">💬 Manage Comments</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-x-auto">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3 text-left">Post</th>
                <th class="p-3 text-left">User</th>
                <th class="p-3 text-left">Comment</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr class="border-b">
                    <td class="p-3">{{ $comment->post->title ?? 'Deleted Post' }}</td>
                    <td class="p-3">{{ $comment->user->name ?? 'Deleted User' }}</td>
                    <td class="p-3 text-gray-700">{{ Str::limit($comment->content, 60) }}</td>
                    <td class="p-3">
                        @if($comment->is_approved)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Approved</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">Pending</span>
                        @endif
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('admin.comments.show', $comment) }}" class="text-blue-600 hover:text-blue-800">View</a>

                        @if(!$comment->is_approved)
                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                        </form>
                        @endif

                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Delete this comment?')">
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
    {{ $comments->links() }}
</div>
@endsection
