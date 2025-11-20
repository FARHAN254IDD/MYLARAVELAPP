@extends('layouts.user')
@section('title', 'Purchased')

@section('content')

<h1 class="text-2xl font-bold mb-4">Purchased Posts</h1>

@foreach($purchases as $purchase)
    <div class="bg-white p-4 shadow mb-4 rounded">
        <h3 class="text-xl font-bold">{{ $purchase->post->title }}</h3>
        <p class="text-gray-600">Purchased on {{ $purchase->created_at->format('M d, Y') }}</p>

        <a href="{{ route('user.posts.show', $purchase->post->id) }}"
           class="mt-2 inline-block text-blue-600 hover:underline">
            View Post
        </a>
    </div>
@endforeach

{{ $purchases->links() }}

@endsection
