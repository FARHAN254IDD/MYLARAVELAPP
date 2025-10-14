@extends('frontend.app')

@section('title', 'About')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-6 text-center">About Us</h1>
    <div class="md:flex items-center gap-10">
        <img src="{{ asset('images/office.jpg') }}" alt="About" class="rounded-lg shadow-md md:w-1/2 mb-8 md:mb-0">
        <div>
            <p class="text-gray-700 mb-4">MyBlog is a platform built for developers, designers, and creatives to share their stories and insights. We believe in learning through sharing.</p>
            <p class="text-gray-700 mb-4">Founded in 2025, our mission is to build a community where ideas meet innovation.</p>
            <p class="text-gray-700">Whether you're new to tech or a seasoned developer, there’s always something new to explore here!</p>
        </div>
    </div>
</div>
@endsection
