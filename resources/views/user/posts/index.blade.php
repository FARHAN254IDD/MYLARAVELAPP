@extends('layouts.user')

@section('title', 'Browse Posts')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Browse Posts</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($posts as $post)
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-5 border">

                <!-- Image -->
                @if($post->image)
                    <div class="w-full h-48 mb-4 overflow-hidden rounded-lg">
                        <img
                            src="{{ asset('storage/posts/' . $post->image) }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg mb-4">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                @endif

                <!-- Title -->
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    {{ $post->title }}
                </h3>

                <!-- Short description/body -->
                <p class="text-gray-600 line-clamp-3">
                    {{ Str::limit($post->content ?? $post->body, 100) }}
                </p>

                <!-- Read more button -->
                <a
                    href="{{ route('user.posts.show', $post->id) }}"
                    class="mt-4 inline-block text-blue-600 font-medium hover:underline"
                >
                    Read More →
                </a>

            </div>
        @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>

</div>

@endsection
