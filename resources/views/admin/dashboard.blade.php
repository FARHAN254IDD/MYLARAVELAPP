@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')

{{-- Stats Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Users --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Total Users</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalUsers ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Registered members</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 7a4 4 0 110-8 4 4 0 010 8z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Total Posts --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Total Posts</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalPosts ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Published articles</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 text-purple-600 flex items-center justify-center rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Comments --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Comments</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalComments ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Engagements</p>
            </div>
            <div class="w-12 h-12 bg-green-100 text-green-600 flex items-center justify-center rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Reports --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Reports</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $reports ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Performance analytics</p>
            </div>
            <div class="w-12 h-12 bg-amber-100 text-amber-600 flex items-center justify-center rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-4m6 4v-8m-8 8h10m-5 4a9 9 0 110-18 9 9 0 010 18z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
    <h2 class="text-lg font-semibold text-slate-900 mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-sm">
            + Create Post
        </a>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
            👤 Add User
        </a>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
            ⚙️ Settings
        </a>
    </div>
</div>

@endsection
