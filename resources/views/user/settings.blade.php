@extends('layouts.user')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Settings</h2>

    <div class="mb-4">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" id="darkModeToggle" class="hidden">
            <span class="w-12 h-6 bg-gray-300 rounded-full relative">
                <span class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></span>
            </span>
            Enable Dark Mode
        </label>
    </div>
</div>

<script>
    const toggle = document.getElementById('darkModeToggle');
    const html = document.querySelector('html');
    const dot = document.querySelector('.dot');

    toggle.addEventListener('change', () => {
        html.classList.toggle('dark');
        if(html.classList.contains('dark')){
            localStorage.setItem('darkMode', 'true');
        } else {
            localStorage.setItem('darkMode', 'false');
        }
    });

    // Initialize from localStorage
    if(localStorage.getItem('darkMode') === 'true'){
        html.classList.add('dark');
        toggle.checked = true;
    }
</script>
@endsection
