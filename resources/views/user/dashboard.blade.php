@extends('layouts.user')

@section('title', 'Overview')

@section('content')

<div class="min-h-screen bg-gray-100 py-10 px-4">

    <div class="max-w-7xl mx-auto">

        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Latest Blog Posts
        </h1>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($posts as $post)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 border">

                    <!-- Post Image -->
                    <div class="w-full h-48 mb-4">
                        <img
                            src="{{ asset('storage/' . $post->image) }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover rounded-lg"
                        >
                    </div>

                    <!-- Title -->
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $post->title }}
                    </h2>

                    <!-- Short Description -->
                    <p class="text-gray-600 line-clamp-3">
                        {{ $post->body }}
                    </p>

                    <!-- Read More -->
                    <a
                        href="{{ route('posts.show', $post->id) }}"
                        class="inline-block mt-4 text-blue-600 font-medium hover:underline"
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
</div>

@endsection
