<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-72 bg-white border-r border-slate-200 flex flex-col">

        {{-- Logo --}}
        <div class="h-16 px-6 flex items-center border-b border-slate-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6l4 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    User Panel
                </span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1">

            <a href="{{ route('user.dashboard') }}"
               class="group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('user.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="mr-3">📊</span> Dashboard
            </a>

            <a href="{{ route('user.posts') }}"
               class="group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('user.posts') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="mr-3">📰</span> Browse Posts
            </a>

            <a href="{{ route('user.purchases') }}"
               class="group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('user.purchases') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="mr-3">🛒</span> Purchases
            </a>

            <a href="{{ route('user.profile') }}"
               class="group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('user.profile') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="mr-3">👤</span> Profile
            </a>

            <a href="{{ route('user.settings') }}"
               class="group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('user.settings') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="mr-3">⚙️</span> Settings
            </a>

        </nav>

        {{-- User Info + Logout --}}
        <div class="p-4 border-t border-slate-200">

            <div class="flex items-center px-4 py-3 mb-2 bg-slate-50 rounded-lg">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="ml-3 flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <form action="/logout" method="POST">
                @csrf
                <button class="w-full flex items-center px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>

        </div>

    </aside>

    {{-- Main Area --}}
    <main class="flex-1 flex flex-col">

        {{-- Topbar --}}
        <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold">@yield('page_title', 'User Dashboard')</h1>
            </div>
        </header>

        {{-- Page Content --}}
        <section class="flex-1 p-8 bg-slate-50 overflow-auto">
            @yield('content')
        </section>

    </main>

</div>

</body>
</html>
