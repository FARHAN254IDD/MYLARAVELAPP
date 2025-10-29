@extends('layouts.admin')

@section('title', 'Posts')
@section('page_title', 'All Posts')

@section('content')
<div class="flex justify-between mb-4">
  <a href="{{ route('posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">+ Add New Post</a>
</div>

@if(session('success'))
  <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
  </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  @foreach ($posts as $post)
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="rounded-lg mb-3 h-48 w-full object-cover">
      @endif
      <h3 class="font-semibold text-lg mb-2">{{ $post->title }}</h3>
      <p class="text-gray-600 text-sm flex-grow">{{ Str::limit($post->content, 100) }}</p>

      <div class="flex justify-between mt-4">
        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>

        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-600 hover:underline">Delete</button>
        </form>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">
  {{ $posts->links() }}
</div>
@endsection
