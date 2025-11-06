@extends('layouts.blogger')

@section('title', 'Create Post')
@section('page_title', 'Create a New Post')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-800 p-8 rounded-xl shadow-lg">
    <form action="{{ route('blogger.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" class="w-full px-3 py-2 rounded bg-gray-900 border border-gray-700 text-gray-100" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Content</label>
            <textarea name="content" rows="5" class="w-full px-3 py-2 rounded bg-gray-900 border border-gray-700 text-gray-100" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price (optional)</label>
            <input type="number" name="price" step="0.01" class="w-full px-3 py-2 rounded bg-gray-900 border border-gray-700 text-gray-100">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image (optional)</label>
            <input type="file" name="image" class="w-full text-gray-300">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">Create Post</button>
    </form>
</div>
@endsection
