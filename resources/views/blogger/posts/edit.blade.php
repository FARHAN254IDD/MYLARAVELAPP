@extends('layouts.blogger')

@section('title', 'Edit Post')
@section('page_title', 'Edit Post')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-800 p-8 rounded-xl shadow-lg">
    <form action="{{ route('blogger.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" class="w-full px-3 py-2 rounded bg-gray-900 border border-gray-700 text-gray-100" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Content</label>
            <textarea name="content" rows="5" class="w-full px-3 py-2 rounded bg-gray-900 border border-gray-700 text-gray-100" required>{{ $post->content }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price (optional)</label>
            <input type="number" name="price" step="0.01" value="{{ $post->price }}" class="w-full px-3 py-2 rounded bg-gray-900 border border-gray-700 text-gray-100">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image (optional)</label>
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
            @include('components.post-image', ['image' => $post->image, 'alt' => $post->title, 'class' => 'w-40 h-40 object-cover rounded mb-3', 'placeholder' => 'w-40 h-40 bg-gray-100 flex items-center justify-center text-gray-400 rounded mb-3'])
            <input type="file" name="image" class="w-full text-gray-300">
        </div>

        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">Update Post</button>
    </form>
</div>
@endsection
