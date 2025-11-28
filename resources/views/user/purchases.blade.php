@extends('layouts.user')

@section('title', 'My Purchases')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">My Purchases</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    @forelse($purchases as $purchase)
        <div class="bg-white p-5 shadow rounded-xl hover:shadow-lg transition">
            @php
                $img = $purchase->post->image ?? '';
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

            @include('components.post-image', ['image' => $purchase->post->image, 'alt' => $purchase->post->title, 'class' => 'w-full h-48 object-cover rounded mb-3', 'placeholder' => 'w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 rounded mb-3'])
            <h2 class="text-xl font-semibold">{{ $purchase->post->title }}</h2>
            <p class="text-gray-600 mt-2">Paid: KES {{ number_format($purchase->amount, 2) }}</p>
            <p class="text-gray-500 text-sm">Purchased at: {{ $purchase->created_at->format('d M Y, H:i') }}</p>

            <a href="{{ route('user.posts.show', $purchase->post->id) }}"
               class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                View Post
            </a>

            <!-- Download Receipt Button (ADD HERE) -->
            <a href="{{ route('user.purchases.receipt', $purchase->id) }}"
               class="inline-block mt-2 bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                Download Receipt
            </a>
        </div>
    @empty
        <p class="text-gray-500 col-span-3">You have not purchased any posts yet.</p>
    @endforelse

</div>

@endsection
