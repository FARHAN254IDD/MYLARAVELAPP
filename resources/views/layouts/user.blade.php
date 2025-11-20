<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - @yield('title')</title>

    @vite('resources/css/app.css')

</head>
<body class="bg-gray-100 font-inter">

    <!-- Sidebar -->
    <div class="flex">

        <aside class="w-64 bg-blue-700 text-white min-h-screen p-5 space-y-3">
            <h2 class="text-xl font-bold mb-5">User Dashboard</h2>

            <a href="{{ route('user.dashboard') }}"
               class="block py-2 px-3 rounded hover:bg-blue-600">📊 Dashboard</a>

            <a href="{{ route('user.posts') }}"
               class="block py-2 px-3 rounded hover:bg-blue-600">📰 Browse Posts</a>

            <a href="{{ route('user.purchases') }}"
               class="block py-2 px-3 rounded hover:bg-blue-600">🛒 Purchased Posts</a>

            <a href="{{ route('user.profile') }}"
               class="block py-2 px-3 rounded hover:bg-blue-600">👤 My Profile</a>

            <a href="{{ route('user.settings') }}"
               class="block py-2 px-3 rounded hover:bg-blue-600">⚙ Settings</a>

            <form action="{{ route('logout') }}" method="POST" class="mt-10">
                @csrf
                <button class="w-full py-2 bg-red-500 hover:bg-red-600 rounded text-white">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow p-5 rounded-lg mb-6">
                <h1 class="text-2xl font-semibold">@yield('title')</h1>
            </div>

            @yield('content')
        </main>

    </div>

</body>
</html>
