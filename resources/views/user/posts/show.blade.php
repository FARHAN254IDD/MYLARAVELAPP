@extends('layouts.user')

@section('title', $post->title)

@section('content')

<div class="max-w-3xl mx-auto mt-8">

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

    @include('components.post-image', ['image' => $post->image, 'alt' => $post->title, 'class' => 'w-full h-80 object-cover rounded-lg shadow mb-6', 'placeholder' => 'w-full h-80 bg-gray-100 flex items-center justify-center rounded-lg mb-6 text-gray-400'])

    {{-- Title --}}
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    {{-- Price --}}
    @if($post->price > 0)
        <p class="text-lg font-semibold text-green-600 mb-4">
            Price: KES {{ number_format($post->price, 2) }}
        </p>
    @else
        <p class="text-sm text-gray-500 mb-4">This post is free to read.</p>
    @endif

    {{-- Content --}}
    <div class="prose max-w-none dark:prose-invert">
        {!! nl2br(e($post->content ?? $post->body)) !!}
    </div>

    {{-- Payment Section --}}
    <div class="mt-8">
        @if($post->price > 0 && !$hasPurchased)
            <button onclick="document.getElementById('payModal').classList.remove('hidden')"
                    class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700">
                Pay via M-Pesa
            </button>
        @elseif($hasPurchased)
            <p class="text-green-600 font-semibold mt-4">
                ✅ You have already purchased this post.
            </p>
        @endif
    </div>
</div>

{{-- M-Pesa Modal --}}
<div id="payModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-96 shadow-xl">
        <h3 class="text-xl font-bold mb-4">Pay via M-Pesa</h3>

        <form method="POST" action="{{ route('user.posts.pay', $post->id) }}">
            @csrf

            <label class="block mb-2 text-sm font-medium">Phone Number (Safaricom)</label>
            <input type="text" name="phone" placeholder="07XXXXXXXX"
                   class="w-full border rounded p-2 mb-4">

            <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Send STK Push
            </button>
        </form>

        <button onclick="document.getElementById('payModal').classList.add('hidden')"
                class="mt-3 w-full text-center text-red-500">
            Cancel
        </button>
    </div>
</div>

@endsection
