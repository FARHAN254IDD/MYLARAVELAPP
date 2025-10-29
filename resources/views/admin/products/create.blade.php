@extends('layouts.admin')

@section('title', 'Create Product')
@section('page_title', 'Create Product')

@section('content')
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow space-y-4">
  @csrf

  <div>
    <label class="block text-gray-700 font-medium mb-1">Name</label>
    <input type="text" name="title" class="w-full border border-gray-300 rounded-lg p-2" value="{{ old('title') }}" required>
    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Content</label>
    <textarea name="content" rows="5" class="w-full border border-gray-300 rounded-lg p-2" required>{{ old('content') }}</textarea>
    @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium">Price (Ksh)</label>
    <input type="number" name="price" step="0.01" class="w-full border rounded-lg p-2" required>
    @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-gray-700 font-medium mb-1">Image</label>
    <input type="file" name="image" class="w-full border border-gray-300 rounded-lg p-2">
    @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <div class="flex justify-end">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Create Product</button>
  </div>
</form>
@endsection
