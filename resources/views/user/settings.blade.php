@extends('layouts.user')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Appearance Settings
    </h2>

    <!-- Theme Toggle -->
    <div class="flex items-center justify-between py-4 border-b border-gray-200 dark:border-gray-700">
        <span class="text-gray-700 dark:text-gray-300 text-lg">Dark Mode</span>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" id="themeToggle" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-indigo-600 dark:bg-gray-600"></div>
            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-all
                peer-checked:translate-x-5"></div>
        </label>
    </div>

</div>

<script>
    // Apply saved theme
    if (localStorage.getItem("theme") === "dark") {
        document.documentElement.classList.add("dark");
        document.getElementById("themeToggle").checked = true;
    }

    // Toggle and save preference
    document.getElementById("themeToggle").addEventListener("change", function () {
        if (this.checked) {
            document.documentElement.classList.add("dark");
            localStorage.setItem("theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("theme", "light");
        }
    });
</script>
@endsection
