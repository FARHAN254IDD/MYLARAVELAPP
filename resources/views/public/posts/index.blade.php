@extends('layouts.public')
@section('content')


<h1 class="text-3xl font-bold mb-6">Available Posts</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($posts as $post)
        <div class="bg-white shadow-lg rounded-xl p-5 hover:shadow-xl transition">
            <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>

            <p class="text-gray-600 text-sm mb-4">
                {{ Str::limit($post->content, 100) }}
            </p>

            <div class="flex justify-between items-center">
                <span class="text-blue-600 font-bold">
                    @if($post->price > 0)
                        KES {{ number_format($post->price) }}
                    @else
                        Free
                    @endif
                </span>

                <a href="{{ route('public.post.show', $post->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    View
                </a>
            </div>
        </div>
        @endforeach

    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>


@endsection
