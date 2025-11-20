@extends('layouts.blogger')

@section('title', 'My Posts')
@section('page_title', 'My Posts')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">All My Posts</h2>
    <a href="{{ route('blogger.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">➕ New Post</a>
</div>

@if (session('success'))
    <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif






@if ($posts->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:scale-105 transition">
                @if ($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="w-full h-40 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2 text-blue-400">{{ $post->title }}</h3>
                    <p class="text-gray-300 text-sm mb-2 truncate">{{ $post->content }}</p>
                    @if ($post->price)
                        <p class="text-yellow-400 font-semibold mb-2">Ksh {{ number_format($post->price, 2) }}</p>
                    @endif
                    <span class="mt-3 inline-block px-2 py-1 text-xs font-semibold rounded
                      {{ $post->status === 'approved' ? 'bg-green-700 text-green-100' :
                         ($post->status === 'rejected' ? 'bg-red-700 text-red-100' : 'bg-yellow-600 text-yellow-100') }}">
                      {{ ucfirst($post->status) }}
                    </span>
                    <div class="mt-3 flex justify-between">
                        <a href="{{ route('blogger.posts.edit', $post) }}" class="bg-blue-600 px-3 py-1 rounded text-sm hover:bg-blue-700">✏️ Edit</a>
                        <form action="{{ route('blogger.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 px-3 py-1 rounded text-sm hover:bg-red-700">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@else
    <p class="text-gray-400">No posts yet. <a href="{{ route('blogger.posts.create') }}" class="text-blue-400 hover:underline">Create your first post.</a></p>
@endif
@endsection
