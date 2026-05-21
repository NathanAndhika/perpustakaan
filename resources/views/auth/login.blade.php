<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500 mt-2">Masuk ke akun Anda untuk melanjutkan membaca.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="text-gray-700 font-semibold mb-1.5" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <x-input-label for="password" value="Password" class="text-gray-700 font-semibold mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Masukkan password Anda" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500/30 transition-colors" name="remember">
                <span class="ms-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Ingat saya</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button>
                Masuk
            </x-primary-button>
        </div>
        
        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>
