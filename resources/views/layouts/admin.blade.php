<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden">

            <!-- Mobile Sidebar Overlay -->
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 z-40 md:hidden" @click="sidebarOpen = false" style="display: none;"></div>

            <!-- Mobile Sidebar -->
            <aside x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 w-64 bg-blue-600 text-white flex flex-col z-50 md:hidden" style="display: none;">
                <div class="h-16 flex items-center justify-between px-4 border-b border-blue-500">
                    <span class="font-bold text-xl">Perpus Admin</span>
                    <button @click="sidebarOpen = false" class="p-1 rounded-lg hover:bg-blue-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Kategori Buku
                    </a>
                    <a href="{{ route('books.index') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('books.*') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Buku
                    </a>
                    <a href="{{ route('admin.history') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.history') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Riwayat Bacaan
                    </a>
                    <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Data User
                    </a>
                </nav>
                <div class="p-4 border-t border-blue-500">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Desktop Sidebar -->
            <aside class="w-64 bg-blue-600 text-white flex flex-col hidden md:flex">
                <div class="h-16 flex items-center justify-center border-b border-blue-500 font-bold text-xl">
                    Perpus Admin
                </div>
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Kategori Buku
                    </a>
                    <a href="{{ route('books.index') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('books.*') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Buku
                    </a>
                    <a href="{{ route('admin.history') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.history') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Riwayat Bacaan
                    </a>
                    <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-blue-700' : 'hover:bg-blue-500' }}">
                        Data User
                    </a>
                </nav>
                <div class="p-4 border-t border-blue-500">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col h-screen overflow-y-auto">
                <!-- Topbar mobile only -->
                <header class="h-16 bg-white shadow-sm flex items-center px-6 md:hidden justify-between">
                    <button @click="sidebarOpen = true" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="font-bold text-blue-600">Perpus Admin</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600">Log Out</button>
                    </form>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>

