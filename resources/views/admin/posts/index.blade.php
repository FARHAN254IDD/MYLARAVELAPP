



















@extends('layouts.admin')

@section('title', 'Posts')
@section('page_title', 'All Posts')

@section('content')
<div class="flex justify-between mb-4">
  <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">+ Add New Post</a>
</div>

@if(session('success'))
  <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
  </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  @foreach ($posts as $post)
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      {{-- Image --}}
        @php
        $img = $post->image ?? '';
        $imgSrc = null;
        if (preg_match('/^https?:\/\//i', $img)) {
          $imgSrc = $img;
        } else {
          $candidate = storage_path('app/public/' . ltrim($img, '/'));
          if ($img && file_exists($candidate)) {
            $imgSrc = asset('storage/' . ltrim($img, '/'));
          }
          if (!$imgSrc) {
            $publicCandidate = public_path(ltrim($img, '/'));
            if ($img && file_exists($publicCandidate)) {
              $imgSrc = asset('/' . ltrim($img, '/'));
            }
          }
          if (!$imgSrc && $img) {
            $pub2 = public_path('images/' . basename($img));
            if (file_exists($pub2)) {
              $imgSrc = asset('images/' . basename($img));
            }
          }
        }
        @endphp
        @include('components.post-image', ['image' => $post->image, 'alt' => $post->title, 'class' => 'rounded-lg mb-3 h-48 w-full object-cover', 'placeholder' => 'rounded-lg mb-3 h-48 w-full bg-gray-100 flex items-center justify-center text-gray-400'])

      {{-- Title & Price --}}
      <h3 class="font-semibold text-lg mb-2">{{ $post->title }}</h3>
      <p class="text-sm text-gray-500 mb-2">Ksh {{ number_format($post->price, 2) }}</p>
      <p class="text-gray-600 text-sm flex-grow">{{ Str::limit($post->content, 100) }}</p>

      {{-- Status Badge --}}
      <div class="mt-3">
        <span class="px-2 py-1 text-xs rounded
    {{ $post->status === 'approved' ? 'bg-blue-100 text-blue-700' :
       ($post->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
    {{ ucfirst($post->status) }}
</span>

      </div>

      {{-- Action Buttons --}}
      <div class="flex justify-between mt-4 items-center">
        <div class="flex gap-2">
          @if($post->status == 'pending')
            <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST">
              @csrf
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Approve</button>
            </form>

            <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
              @csrf
              <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Reject</button>
            </form>
          @endif
        </div>

        <div class="flex gap-2">
          <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
          <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">
  {{ $posts->links() }}
</div>
@endsection

