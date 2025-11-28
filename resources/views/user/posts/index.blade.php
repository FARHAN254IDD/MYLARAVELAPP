@extends('layouts.user')

@section('title', 'Browse Posts')

@section('content')

<h1 class="text-3xl font-bold mb-6">Browse Posts</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    @foreach($posts as $post)
        <div class="bg-white p-6 shadow rounded-xl hover:shadow-xl transition">

            <div class="h-48 mb-4">
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

                @include('components.post-image', ['image' => $post->image, 'alt' => $post->title, 'class' => 'w-full h-full object-cover rounded-lg', 'placeholder' => 'w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 rounded-lg'])
            </div>

            <h3 class="text-xl font-semibold">{{ $post->title }}</h3>

            <p class="text-gray-600 mt-2">{{ Str::limit($post->body, 100) }}</p>

            <a href="{{ route('user.posts.show', $post->id) }}"
               class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Read More
            </a>
        </div>
    @endforeach

</div>

<div class="mt-8">
    {{ $posts->links('pagination::tailwind') }}
</div>

@endsection
