@extends('layouts.user')

@section('title', 'Help')
@section('page_title', 'Help & Support')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Help & Support</h2>

    <p class="mb-4 text-gray-700 dark:text-gray-300">
        If you encounter any issues or need assistance, you can:
    </p>

    <ul class="list-disc ml-5 mb-6 text-gray-700 dark:text-gray-300">
        <li>Check our <a href="#" class="text-indigo-600 hover:underline">FAQs</a></li>
        <li>Contact support via <a href="mailto:support@example.com" class="text-indigo-600 hover:underline">email</a></li>
        <li>Call our support line: <span class="font-semibold">+254 700 000 000</span></li>
    </ul>

    <h3 class="text-xl font-semibold mb-2">Submit a Problem</h3>
    <form action="{{ route('user.help.submit') }}" method="POST" class="space-y-4">
        @csrf
        <textarea name="message" placeholder="Describe your issue..." rows="5"
                  class="w-full border rounded p-3"></textarea>
        <button type="submit"
                class="bg-indigo-600 text-black px-4 py-2 rounded hover:bg-indigo-700">
            Submit
        </button>
    </form>
</div>
@endsection
