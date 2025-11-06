@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">⚙️ Site Settings</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg space-y-5">
    @csrf

    <div>
        <label class="block font-semibold text-gray-700 mb-2">Site Name</label>
        <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="w-full border-gray-300 rounded-lg">
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-2">About</label>
        <textarea name="about" rows="4" class="w-full border-gray-300 rounded-lg">{{ old('about', $setting->about) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-2">Logo</label>
        @if($setting->logo)
            <img src="{{ asset('storage/'.$setting->logo) }}" class="h-20 mb-3">
        @endif
        <input type="file" name="logo" class="w-full border-gray-300 rounded-lg">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Facebook</label>
            <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" class="w-full border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Twitter</label>
            <input type="url" name="twitter" value="{{ old('twitter', $setting->twitter) }}" class="w-full border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Instagram</label>
            <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" class="w-full border-gray-300 rounded-lg">
        </div>
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-2">Footer Text</label>
        <input type="text" name="footer_text" value="{{ old('footer_text', $setting->footer_text) }}" class="w-full border-gray-300 rounded-lg">
    </div>

    <div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Save Settings</button>
    </div>
</form>
@endsection
