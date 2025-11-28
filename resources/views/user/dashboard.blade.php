@extends('layouts.user')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')

{{-- Stats Section --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

    {{-- Total Posts --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Total Posts</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalPosts }}</h3>
                <p class="text-xs text-slate-400 mt-2">Posts you created</p>
            </div>
            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 flex items-center justify-center rounded-lg">
                📝
            </div>
        </div>
    </div>

    {{-- Purchased --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Purchased</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $purchased }}</h3>
                <p class="text-xs text-slate-400 mt-2">Your bought posts</p>
            </div>
            <div class="w-12 h-12 bg-green-100 text-green-600 flex items-center justify-center rounded-lg">
                🛒
            </div>
        </div>
    </div>

    {{-- Recent --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Recent</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $recent->count() }}</h3>
                <p class="text-xs text-slate-400 mt-2">Your recent activity</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 text-purple-600 flex items-center justify-center rounded-lg">
                ⭐
            </div>
        </div>
    </div>

</div>

{{-- Recent Posts --}}
<div>
    <h2 class="text-2xl font-bold text-slate-900 mb-6">Recent Posts</h2>

    @if($recent->count() == 0)
        <p class="text-slate-500">No recent posts found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($recent as $post)
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md overflow-hidden transition">

                    <div class="h-48 w-full bg-slate-100">
                        @include('components.post-image', [
                            'image' => $post->image,
                            'alt' => $post->title,
                            'class' => 'w-full h-full object-cover'
                        ])
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $post->title }}</h3>
                        <p class="text-slate-600 mb-3">{{ Str::limit($post->body ?? $post->content, 100) }}</p>
                        <a href="{{ route('user.posts.show', $post->id) }}"
                           class="text-indigo-600 font-medium hover:underline">Read More →</a>
                    </div>

                </div>
            @endforeach

        </div>
    @endif
</div>

@endsection
