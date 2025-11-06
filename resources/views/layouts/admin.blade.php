<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        AdminPanel
                    </span>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-6 space-y-1">
                @php
                    $menuItems = [
                        ['name' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6', 'route' => 'admin.dashboard'],
                        ['name' => 'Posts', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'route' => 'admin.posts.index'],
                        ['name' => 'Users', 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 7a4 4 0 110-8 4 4 0 010 8z', 'route' => 'admin.users.index'],
                        ['name' => 'Comments', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72', 'route' => 'admin.comments.index'],
                        ['name' => 'Media', 'icon' => 'M4 16l4-4 4 4m8-8l-4 4-4-4', 'route' => 'admin.media.index'],
                        ['name' => 'Reports', 'icon' => 'M3 3v18h18V3H3zm9 14v-4m0-4V7', 'route' => 'admin.reports.index'],
                        ['name' => 'Settings', 'icon' => 'M12 8v8m8-8v8M4 8v8', 'route' => 'admin.settings.index'],
                    ];
                @endphp

                @foreach ($menuItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200
                              {{ request()->routeIs($item['route'])
                                 ? 'bg-indigo-50 text-indigo-600'
                                 : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs($item['route']) ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        <span>{{ $item['name'] }}</span>
                        @if(request()->routeIs($item['route']))
                            <div class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-600"></div>
                        @endif
                    </a>
                @endforeach
            </nav>

            {{-- User Info & Logout --}}
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

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col">
            {{-- Topbar --}}
            <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">@yield('page_title', 'Dashboard')</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Welcome back, {{ auth()->user()->name }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
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
