@extends('layouts.public')
@section('content')


<div class="bg-white shadow-lg rounded-xl p-8">

    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    @if(!$hasPurchased && $post->price > 0)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-6">
            <p class="font-medium text-yellow-800">
                This is a premium post. Price:
                <strong>KES {{ number_format($post->price) }}</strong>
            </p>
        </div>

        <form action="{{ route('pay.stk', $post->id) }}" method="POST">
            @csrf
            <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 text-lg font-semibold">
                Buy Now with M-Pesa
            </button>
        </form>

        <p class="mt-6 text-gray-500">
            * You will receive an STK push on your phone.
        </p>

    @endif

    @if($hasPurchased || $post->price == 0)
        <div class="mt-6 prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>
    @else
        <div class="mt-6 text-gray-500">
            <p>The full content will be available after purchase.</p>
        </div>
    @endif

</div>


@endsection
