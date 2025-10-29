

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">

  <!-- Sidebar -->

  <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <h1 class="text-xl font-bold mb-6">Admin Panel</h1>
    <ul class="space-y-3">
      <li><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a></li>
      <li><a href="{{ route('posts.index') }}" class="hover:text-gray-300">Posts</a></li>
      <li><a href="{{ route('services.index') }}" class="hover:text-gray-300">Services</a></li>
      <li><a href="{{ route('products.index') }}" class="hover:text-gray-300">Products</a></li>

      <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-600 hover:text-red-700">🚪 Logout</button>
                </form>
            </li>

    </ul>
  </aside>

  <!-- Main Content -->

  <main class="flex-1 p-8">
    <h2 class="text-2xl font-semibold mb-6">@yield('page_title')</h2>
    @yield('content')
  </main>

</body>
</html>






















