@extends('frontend.app')

@section('title', 'Posts')

@section('content')


<div class="max-w-6xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold text-center mb-12">Latest Posts</h1>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach ($posts as $post)
            @php
                $img = $post->image ?? '';
                $imgSrc = null;

                // Absolute URLs
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

            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 overflow-hidden">
                @include('components.post-image', ['image' => $post->image, 'alt' => $post->title, 'class' => 'w-full h-48 object-cover', 'placeholder' => 'w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400'])

                <div class="p-5">
                    <h2 class="text-2xl font-bold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $post->content }}</p>
                    <a href="{{ route('public.post.show', $post->id) }}" class="text-blue-500 font-semibold hover:underline">Read More →</a>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
