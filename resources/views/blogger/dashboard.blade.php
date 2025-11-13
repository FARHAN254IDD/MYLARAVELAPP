@extends('layouts.blogger')

@section('title', 'Blogger Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')

{{-- ✅ Notifications Dropdown --}}
<div class="relative flex justify-end mb-6">
    <div x-data="{ open: false }" class="relative">
        @php
            $notifications = json_decode(Auth::user()->notifications ?? '[]', true);
        @endphp

        <button @click="open = !open" class="relative flex items-center bg-gray-800 text-gray-100 px-4 py-2 rounded-lg shadow hover:bg-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405M19 13a7 7 0 10-14 0 7 7 0 0014 0z" />
            </svg>
            Notifications
            @if(count($notifications) > 0)
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ count($notifications) }}
                </span>
            @endif
        </button>

        {{-- Dropdown Panel --}}
        <div x-show="open" @click.away="open = false" x-transition
             class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-xl border border-gray-200 z-50">

            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-800">Recent Notifications</h3>
                <form action="{{ route('blogger.notifications.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs text-red-600 hover:underline">Clear All</button>
                </form>
            </div>

            @if(count($notifications) > 0)
                <div class="max-h-64 overflow-y-auto divide-y divide-gray-100">
                    @foreach(array_reverse($notifications) as $note)
                        <div class="p-4 flex items-start gap-3 {{ $note['type'] === 'success' ? 'bg-green-50' : 'bg-red-50' }}">
                            <div class="flex-shrink-0 mt-1">
                                @if($note['type'] === 'success')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-gray-800">{{ $note['message'] }}</p>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($note['time'])->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-4 text-center text-gray-500 text-sm">No new notifications</div>
            @endif
        </div>
    </div>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Posts --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow">
        <p class="text-sm font-medium text-gray-500 mb-1">Total Posts</p>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $myPostsCount ?? 0 }}</h3>
        <p class="text-xs text-gray-400">All your articles</p>
    </div>
    {{-- Approved Posts --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow">
        <p class="text-sm font-medium text-gray-500 mb-1">Approved</p>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $approvedPosts ?? 0 }}</h3>
        <p class="text-xs text-green-600">✓ Published</p>
    </div>
    {{-- Pending Posts --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow">
        <p class="text-sm font-medium text-gray-500 mb-1">Pending</p>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $pendingPosts ?? 0 }}</h3>
        <p class="text-xs text-yellow-600">⏱ Under review</p>
    </div>
    {{-- Comments --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow">
        <p class="text-sm font-medium text-gray-500 mb-1">Comments</p>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $commentsCount ?? 0 }}</h3>
        <p class="text-xs text-gray-400">Total engagement</p>
    </div>
</div>

{{-- Quick Actions --}}
<div class="bg-white border border-gray-300 rounded-lg p-6 shadow">
    <h2 class="font-semibold text-lg mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('blogger.posts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">+ Create New Post</a>
        <a href="{{ route('blogger.posts.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">📄 View All Posts</a>
        <a href="{{ route('blogger.comments.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">💬 Manage Comments</a>
    </div>
</div>

@endsection
