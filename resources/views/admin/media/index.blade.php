@extends('layouts.admin')

@section('title', 'Media Management')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">🖼️ Media Management</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md mb-8">
    @csrf
    <label class="block text-gray-700 font-semibold mb-2">Upload New Media</label>
    <input type="file" name="file" class="block w-full border border-gray-300 rounded-lg p-2 mb-4">
    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Upload</button>
</form>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($mediaFiles as $media)
        <div class="bg-white p-4 rounded-xl shadow-md text-center relative">
            @if(Str::startsWith($media->type, 'image'))
                <img src="{{ asset('storage/'.$media->file_path) }}" class="rounded-lg mb-3 h-40 w-full object-cover">
            @else
                <video controls class="rounded-lg mb-3 h-40 w-full">
                    <source src="{{ asset('storage/'.$media->file_path) }}">
                </video>
            @endif

            <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST" class="absolute top-2 right-2">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white rounded-full px-3 py-1 text-sm hover:bg-red-600">Delete</button>
            </form>
        </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $mediaFiles->links() }}
</div>
@endsection
