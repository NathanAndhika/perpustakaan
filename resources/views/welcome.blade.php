<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Library') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        
        .animate-fade-in-up { animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        .animate-fade-in { animation: fade-in 1s ease-out forwards; opacity: 0; }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 antialiased selection:bg-blue-100 selection:text-blue-900">

    <div class="min-h-screen flex flex-col">
        <!-- Main Content (Hero) -->
        <main class="flex-grow flex flex-col items-center justify-center p-6 relative z-10">
            <div class="w-full max-w-5xl mx-auto pt-8">
                <!-- Welcome Banner similar to dashboard -->
                <div class="bg-gradient-to-r from-blue-500 to-sky-400 rounded-3xl shadow-sm p-8 md:p-16 text-white relative overflow-hidden animate-fade-in-up">
                    <div class="relative z-10 text-center max-w-2xl mx-auto">
                        <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wider mb-4 animate-fade-in-up delay-100">Platform Perpustakaan Digital</span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 animate-fade-in-up delay-100">
                            Selamat Datang di <br class="hidden md:block"/> E-Library
                        </h1>
                        <p class="text-blue-50 text-base md:text-lg mb-10 animate-fade-in-up delay-200">
                            Jelajahi ribuan koleksi buku digital. Baca langsung secara online, atau unduh untuk dibaca nanti kapan saja dan di mana saja.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up delay-300">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 font-bold px-8 py-3.5 rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-sm flex items-center justify-center">
                                    Masuk ke Dashboard
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="bg-white text-blue-600 font-bold px-8 py-3.5 rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-sm flex items-center justify-center">
                                    Daftar Sekarang
                                </a>
                                <a href="{{ route('login') }}" class="bg-blue-600/30 hover:bg-blue-600/40 border border-white/20 text-white font-bold px-8 py-3.5 rounded-xl transition-all duration-300 flex items-center justify-center">
                                    Masuk
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    <!-- Decorative subtle background shapes -->
                    <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-20 top-10 w-64 h-64 bg-sky-300/20 rounded-full blur-3xl"></div>
                </div>

                <!-- Features Section matching dashboard cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 animate-fade-in-up delay-300">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Ribuan Koleksi</h3>
                        <p class="text-sm text-gray-500">Akses tak terbatas ke berbagai genre dan kategori buku yang terus diperbarui setiap hari.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Baca Online</h3>
                        <p class="text-sm text-gray-500">Baca langsung dari peramban Anda dengan antarmuka yang nyaman di mata tanpa perlu instalasi.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-sky-50 text-sky-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Unduh PDF</h3>
                        <p class="text-sm text-gray-500">Simpan buku favorit Anda ke perangkat untuk dibaca secara offline kapan saja.</p>
                    </div>
                </div>

                <!-- Tentang E-Library Section -->
                <div class="mt-10 bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 animate-fade-in-up delay-400">
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        <div class="md:w-1/2">
                            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Tentang <span class="text-blue-600">E-Library</span></h2>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                E-Library adalah platform perpustakaan digital inovatif yang didedikasikan untuk menjembatani akses pengetahuan tanpa batas ruang dan waktu. Kami percaya bahwa membaca adalah jendela dunia, dan teknologi membuat jendela tersebut dapat diakses oleh siapa saja.
                            </p>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Hadir dengan antarmuka yang modern, cepat, dan ramah pengguna, platform ini dirancang khusus untuk memenuhi kebutuhan literatur digital Anda — baik untuk keperluan akademis, profesional, maupun sekadar hiburan di waktu luang.
                            </p>
                            
                            <!-- Development Notice -->
                            <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100 flex items-start gap-4 mb-2">
                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-amber-800 font-bold text-sm mb-1">Tahap Pengembangan</h4>
                                    <p class="text-amber-700 text-xs leading-relaxed font-medium">Website ini saat ini masih dalam tahap pengembangan aktif. Fitur atau tampilan mungkin dapat berubah dan disempurnakan sewaktu-waktu.</p>
                                </div>
                            </div>
                            
                            <div class="mt-8 flex gap-6 border-t border-gray-100 pt-8">
                                <div class="flex flex-col">
                                    <span class="text-2xl font-black text-gray-900">1000+</span>
                                    <span class="text-sm font-medium text-gray-500">Koleksi Buku</span>
                                </div>
                                <div class="w-px bg-gray-200"></div>
                                <div class="flex flex-col">
                                    <span class="text-2xl font-black text-gray-900">24/7</span>
                                    <span class="text-sm font-medium text-gray-500">Akses Penuh</span>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-1/2 flex justify-center w-full">
                            <div class="relative w-full max-w-sm aspect-square bg-gradient-to-tr from-blue-100 to-sky-50 rounded-[3rem] overflow-hidden flex items-center justify-center p-8">
                                <svg class="w-full h-full text-blue-500 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <!-- Decorative elements on illustration -->
                                <div class="absolute top-10 left-10 w-4 h-4 bg-yellow-400 rounded-full mix-blend-multiply"></div>
                                <div class="absolute bottom-12 right-12 w-6 h-6 bg-red-400 rounded-full mix-blend-multiply"></div>
                                <div class="absolute top-1/2 right-8 w-3 h-3 bg-green-400 rounded-full mix-blend-multiply"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        
        <footer class="py-6 text-center text-sm text-gray-500 animate-fade-in delay-300 relative z-10">
            &copy; {{ date('Y') }} E-Library. All rights reserved.
        </footer>
    </div>
</body>
</html>

