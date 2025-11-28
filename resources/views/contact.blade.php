@extends('frontend.app')

@section('title', 'Contact')

@section('content')


<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-6 text-center">Contact Us</h1>
    <p class="text-center text-gray-600 mb-8">We’d love to hear from you! Send us a message below.</p>

    <form action="#" method="POST" class="bg-white p-8 rounded-lg shadow-md space-y-6">
        <div>
            <label class="block text-gray-700 mb-2">Your Name</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-2">Email Address</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-2">Message</label>
            <textarea name="message" rows="5" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">Send Message</button>
    </form>
</div>

@endsection
