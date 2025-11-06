@extends('layouts.admin')

@section('title', 'View Comment')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">💬 View Comment</h1>

<div class="bg-white p-6 rounded-xl shadow-md">
    <p><strong>Post:</strong> {{ $comment->post->title ?? 'Deleted Post' }}</p>
    <p><strong>User:</strong> {{ $comment->user->name ?? 'Deleted User' }}</p>
    <p class="mt-4"><strong>Comment:</strong></p>
    <p class="text-gray-700 mt-2">{{ $comment->content }}</p>

    <div class="mt-6 space-x-4">
        @if(!$comment->is_approved)
            <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Approve</button>
            </form>
        @endif

        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Delete this comment?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete</button>
        </form>

        <a href="{{ route('admin.comments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection
