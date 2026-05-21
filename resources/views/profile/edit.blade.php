@php
    $layout = Auth::user()->role === 'admin' ? 'admin-layout' : 'user-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class="max-w-4xl mx-auto pb-12 pt-4">
        
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pengaturan Profil</h1>
            <p class="text-gray-500 text-sm mt-2">Kelola informasi akun, kata sandi, dan privasi Anda.</p>
        </div>

        <div class="space-y-8">
            <!-- Update Profile Information -->
            <div class="p-6 sm:p-10 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.06)] border border-gray-100/80 rounded-[20px] transition-all duration-300">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-6 sm:p-10 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.06)] border border-gray-100/80 rounded-[20px] transition-all duration-300">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User -->
            <div class="p-6 sm:p-10 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.06)] border border-rose-100/50 rounded-[20px] transition-all duration-300">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
