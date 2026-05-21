<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500 mt-2">Daftar untuk mulai membaca ribuan buku digital.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-semibold mb-1.5" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="text-gray-700 font-semibold mb-1.5" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="text-gray-700 font-semibold mb-1.5" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Buat password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700 font-semibold mb-1.5" />
            <x-text-input id="password_confirmation" class="block w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button>
                Daftar
            </x-primary-button>
        </div>
        
        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Masuk sekarang</a>
        </p>
    </form>
</x-guest-layout>
