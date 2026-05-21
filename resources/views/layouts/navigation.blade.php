<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        Kategori Buku
                    </x-nav-link>
                    @endif

                    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
                        Buku
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('admin.history')" :active="request()->routeIs('admin.history')">
                        Riwayat Bacaan
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">
                        Riwayat Bacaan
                    </x-nav-link>
                    @endif

                </div>
            </div>

            <!-- User -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm text-gray-500">
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>
            </div>

        </div>
    </div>

</nav>