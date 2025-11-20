@extends('layouts.blogger')

@section('title', $post->title)

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">

    {{-- Post Title --}}
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    {{-- Post Meta --}}
    <div class="text-sm text-gray-500 mb-4">
        Posted on {{ $post->created_at->format('M d, Y') }}
    </div>

    {{-- If post has a price --}}
    @if($post->price > 0)

        {{-- If user already bought the post --}}
        @if($hasPurchased)
            <div class="p-4 mb-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                ✔ You purchased this post.
            </div>

            {{-- Show the post content --}}
            <div class="prose max-w-none">
                {!! $post->content !!}
            </div>

        @else
            {{-- PRICE SECTION --}}
            <div class="p-4 mb-6 bg-yellow-100 border border-yellow-300 text-yellow-700 rounded-lg">
                This is a paid post.
                <br>
                <strong>Price: KES {{ $post->price }}</strong>
            </div>

            {{-- BUY BUTTON --}}
            <form action="{{ route('pay.stk', $post->id) }}" method="POST">
                @csrf

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg text-lg font-semibold">
                    Pay with M-Pesa 💰
                </button>
            </form>
        @endif

    @else
        {{-- Free Post --}}
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
    @endif

</div>

@endsection
