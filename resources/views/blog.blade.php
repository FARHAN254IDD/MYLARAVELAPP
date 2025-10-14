@extends('frontend.app')

@section('title', 'Blog')

@section('content')


<div class="max-w-6xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold text-center mb-12">Latest Blog Posts</h1>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 overflow-hidden">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h2 class="text-2xl font-bold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $post->content }}</p>
                    <a href="{{ route('blog.show', $post->id) }}" class="text-blue-500 font-semibold hover:underline">Read More →</a>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
