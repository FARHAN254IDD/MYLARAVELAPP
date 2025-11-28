<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel Blog')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">MyPosts</h1>
            <ul class="flex space-x-6">
                <li><a href="/" class="hover:text-blue-500">Home</a></li>
                <li><a href="/posts" class="hover:text-blue-500">Posts</a></li>
                <li><a href="/about" class="hover:text-blue-500">About</a></li>
                <li><a href="/contact" class="hover:text-blue-500">Contact</a></li>
                <!-- <li><a href="{{ route('services.index') }}">service</a></li> -->

                <li><a href="/login" class="hover:text-blue-500">Login</a></li>
                <li><a href="/register" class="hover:text-blue-500">Register</a></li>
            </ul>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-6 mt-10">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} MyPosts. All Rights Reserved.</p>
            <div class="mt-3 flex justify-center space-x-5">
                <a href="#" class="hover:text-gray-200">Facebook</a>
                <a href="#" class="hover:text-gray-200">Twitter</a>
                <a href="#" class="hover:text-gray-200">Instagram</a>
            </div>
        </div>
    </footer>

</body>
</html>
