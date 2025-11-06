@extends('layouts.blogger')

@section('title', 'Blogger Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')



{{-- Stats Grid with Inline Styles as Backup --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Posts --}}
    <div style="background-color: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div style="flex: 1;">
                <p style="font-size: 14px; font-weight: 500; color: #64748b; margin-bottom: 4px;">Total Posts</p>
                <h3 style="font-size: 30px; font-weight: bold; color: #0f172a; margin: 8px 0;">{{ $myPostsCount ?? 0 }}</h3>
                <p style="font-size: 12px; color: #94a3b8; margin-top: 8px;">All your articles</p>
            </div>
            <div style="width: 56px; height: 56px; background-color: #dbeafe; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 28px; height: 28px; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Approved Posts --}}
    <div style="background-color: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div style="flex: 1;">
                <p style="font-size: 14px; font-weight: 500; color: #64748b; margin-bottom: 4px;">Approved</p>
                <h3 style="font-size: 30px; font-weight: bold; color: #0f172a; margin: 8px 0;">{{ $approvedPosts ?? 0 }}</h3>
                <p style="font-size: 12px; color: #10b981; margin-top: 8px;">✓ Published</p>
            </div>
            <div style="width: 56px; height: 56px; background-color: #d1fae5; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 28px; height: 28px; color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Pending Posts --}}
    <div style="background-color: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div style="flex: 1;">
                <p style="font-size: 14px; font-weight: 500; color: #64748b; margin-bottom: 4px;">Pending</p>
                <h3 style="font-size: 30px; font-weight: bold; color: #0f172a; margin: 8px 0;">{{ $pendingPosts ?? 0 }}</h3>
                <p style="font-size: 12px; color: #f59e0b; margin-top: 8px;">⏱ Under review</p>
            </div>
            <div style="width: 56px; height: 56px; background-color: #fef3c7; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 28px; height: 28px; color: #d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Comments --}}
    <div style="background-color: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div style="flex: 1;">
                <p style="font-size: 14px; font-weight: 500; color: #64748b; margin-bottom: 4px;">Comments</p>
                <h3 style="font-size: 30px; font-weight: bold; color: #0f172a; margin: 8px 0;">{{ $commentsCount ?? 0 }}</h3>
                <p style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Total engagement</p>
            </div>
            <div style="width: 56px; height: 56px; background-color: #f3e8ff; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 28px; height: 28px; color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
        </div>
    </div>

</div>

{{-- Quick Actions --}}
<div style="background-color: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <h2 style="font-size: 18px; font-weight: 600; color: #0f172a; margin-bottom: 16px;">Quick Actions</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
        <a href="{{ route('blogger.posts.create') }}"
           style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #4f46e5; color: white; font-size: 14px; font-weight: 500; border-radius: 8px; text-decoration: none;">
            + Create New Post
        </a>
        <a href="{{ route('blogger.posts.index') }}"
           style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: white; color: #334155; font-size: 14px; font-weight: 500; border-radius: 8px; border: 1px solid #cbd5e1; text-decoration: none;">
            📄 View All Posts
        </a>
        <a href="{{ route('blogger.comments.index') }}"
           style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: white; color: #334155; font-size: 14px; font-weight: 500; border-radius: 8px; border: 1px solid #cbd5e1; text-decoration: none;">
            💬 Manage Comments
        </a>
    </div>
</div>

@endsection










