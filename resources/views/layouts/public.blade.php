<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Posts' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('public.posts') }}" class="text-2xl font-bold text-blue-600">BlogStore</a>

            <div>
                @auth
                    <span class="mr-4">Hi, {{ auth()->user()->name }}</span>
                    <form class="inline" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
                    </form>
                @else
                    <a href="/login" class="text-blue-600 hover:underline mr-4">Login</a>
                    <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="max-w-7xl mx-auto  p-6">
        @yield('content')
    </main>

</body>
</html>
