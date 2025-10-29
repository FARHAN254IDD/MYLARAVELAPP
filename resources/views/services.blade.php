@extends('frontend.app')

@section('title', 'Services')

@section('content')

@foreach ($services as $service)
<h1>Our Services</h1>
    <div
     class="max-w-4xl mx-auto px-4 py-8 bg-white rounded-lg shadow mb-6">
        <h2 class="text-2xl font-bold mb-2">{{ $service->title }}</h2>
        <p class="text-gray-700 mb-4">{{ $service->description }}</p>
        <p class="text-lg font-semibold text-blue-600">Price: ${{ $service->price }}</p>
    </div>

@endsection
