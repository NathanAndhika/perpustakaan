<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Ringkasan</h1>
        <p class="text-gray-500 text-sm mt-1">Status dan statistik aktivitas E-Library saat ini.</p>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total User -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-400 font-medium">Total Anggota</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Kategori -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-400 font-medium">Kategori</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $totalCategories }}</p>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-400 font-medium">Buku Digital</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $totalBooks }}</p>
            </div>
        </div>

        <!-- Total Aktivitas Baca -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-400 font-medium">Total Dibaca</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $mostReadBooks->sum('reading_histories_count') }}</p>
            </div>
        </div>
    </div>

    <!-- Lists Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Buku Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Buku Digital Terbaru</h2>
                <a href="{{ route('books.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($latestBooks as $book)
                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-14 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 mr-4">
                                @if($book->cover_buku)
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-xs">PDF</div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-800 line-clamp-1">{{ $book->judul }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $book->penulis }}</p>
                                <span class="inline-block mt-1 text-[10px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-medium">
                                    {{ $book->category->nama_kategori ?? 'Umum' }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400">{{ $book->tahun }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400 text-sm">Belum ada buku digital.</div>
                @endforelse
            </div>
        </div>

        <!-- Buku Paling Banyak Dibaca -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Buku Terpopuler (Paling Sering Dibaca)</h2>
            </div>
            <div class="space-y-4">
                @forelse($mostReadBooks as $book)
                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-14 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 mr-4">
                                @if($book->cover_buku)
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-xs">PDF</div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-800 line-clamp-1">{{ $book->judul }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $book->penulis }}</p>
                                <span class="inline-block mt-1 text-[10px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-600 font-medium">
                                    {{ $book->category->nama_kategori ?? 'Umum' }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-1 justify-end">
                                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <span class="text-sm font-bold text-gray-700">{{ $book->reading_histories_count }}x</span>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-0.5">dibaca</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400 text-sm">Belum ada aktivitas membaca.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
