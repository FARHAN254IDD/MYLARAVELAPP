@extends('layouts.blogger')

@section('title', 'Comments')
@section('page_title', 'Comments on My Posts')

@section('content')
<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Comments</h2>

    @if($comments->count())
        <div class="space-y-4">
            @foreach($comments as $c)
                <div class="bg-gray-800 p-4 rounded-lg">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-yellow-400 font-semibold">{{ $c->user?->name ?? 'Guest' }} <span class="text-xs text-gray-400">· {{ $c->created_at->diffForHumans() }}</span></p>
                            <p class="text-gray-300 mt-2">{{ $c->content }}</p>
                            <p class="text-xs text-gray-400 mt-2">On: <a class="text-blue-400 hover:underline" href="{{ route('posts.show', $c->post_id) }}">{{ $c->post->title ?? 'post' }}</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $comments->links() }}
        </div>
    @else
        <p class="text-gray-400">No comments yet.</p>
    @endif
</div>
@endsection

