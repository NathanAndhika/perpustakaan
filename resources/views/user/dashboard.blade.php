<x-user-layout>
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-500 to-sky-400 rounded-3xl shadow-sm p-8 md:p-12 mb-10 text-white relative overflow-hidden">
        <div class="relative z-10 max-w-lg">
            <span class="bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wider">E-Library</span>
            <h1 class="text-3xl md:text-4xl font-extrabold mt-4 mb-3 tracking-tight">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-blue-50 text-sm md:text-base font-normal leading-relaxed">Temukan ribuan buku digital, baca langsung secara online, atau unduh untuk dibaca nanti kapan saja.</p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('books.index') }}" class="bg-white text-blue-600 hover:bg-blue-50 font-bold px-6 py-3 rounded-xl transition-all duration-300 shadow-sm hover:shadow">
                    Jelajahi Buku
                </a>
                <a href="{{ route('history.index') }}" class="bg-blue-600/30 hover:bg-blue-600/40 border border-white/20 text-white font-bold px-6 py-3 rounded-xl transition-all duration-300">
                    Riwayat Baca
                </a>
            </div>
        </div>
        <!-- Decorative subtle background shapes -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute right-20 top-5 w-32 h-32 bg-sky-300/20 rounded-full blur-2xl"></div>
    </div>

    <!-- Riwayat Bacaan (Lanjutkan Membaca) -->
    @if($readingHistories->isNotEmpty())
    <div class="mb-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">Lanjutkan Membaca</h2>
            <a href="{{ route('history.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($readingHistories as $history)
                @if($history->book)
                <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm hover:shadow transition-all duration-300 flex items-center">
                    <div class="w-12 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 mr-4">
                        @if($history->book->cover_buku)
                            <img src="{{ asset('storage/' . $history->book->cover_buku) }}" alt="{{ $history->book->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-[10px]">PDF</div>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-bold text-xs text-gray-800 line-clamp-1 hover:text-blue-600">
                            <a href="{{ route('books.show', $history->book_id) }}">{{ $history->book->judul }}</a>
                        </h4>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ $history->book->penulis }}</p>
                        <p class="text-[9px] text-blue-500 mt-2 font-medium">Dibaca {{ $history->last_read_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Dual Column (Rekomendasi & Favorit) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
        <!-- Rekomendasi Buku -->
        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Rekomendasi Buku</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($recommendedBooks as $book)
                    <div class="flex p-3 rounded-2xl hover:bg-blue-50/30 transition-colors duration-200">
                        <div class="w-14 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 mr-4">
                            @if($book->cover_buku)
                                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-xs">PDF</div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1 flex flex-col justify-between py-1">
                            <div>
                                <h4 class="font-bold text-sm text-gray-800 line-clamp-1"><a href="{{ route('books.show', $book->id) }}">{{ $book->judul }}</a></h4>
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ $book->penulis }}</p>
                            </div>
                            <span class="inline-block self-start text-[9px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-medium">
                                {{ $book->category->nama_kategori ?? 'Umum' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-8 text-gray-400 text-sm">Belum ada rekomendasi.</div>
                @endforelse
            </div>
        </div>

        <!-- Buku Terfavorit Anda -->
        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Buku Paling Sering Anda Baca</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($favoriteBooks as $book)
                    <div class="flex p-3 rounded-2xl hover:bg-indigo-50/30 transition-colors duration-200">
                        <div class="w-14 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 mr-4">
                            @if($book->cover_buku)
                                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-xs">PDF</div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1 flex flex-col justify-between py-1">
                            <div>
                                <h4 class="font-bold text-sm text-gray-800 line-clamp-1"><a href="{{ route('books.show', $book->id) }}">{{ $book->judul }}</a></h4>
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ $book->penulis }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="inline-block text-[9px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-600 font-medium">
                                    {{ $book->category->nama_kategori ?? 'Umum' }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-bold">{{ $book->reading_histories_count }}x dibaca</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-8 text-gray-400 text-sm">Belum ada riwayat membaca.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Buku Terbaru Grid -->
    <div class="mb-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">Buku Digital Terbaru</h2>
            <a href="{{ route('books.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($latestBooks as $book)
            <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <div class="w-full aspect-[3/4] bg-gray-50 rounded-xl overflow-hidden border border-gray-100 mb-4 relative">
                    @if($book->cover_buku)
                        <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-sm">PDF</div>
                    @endif
                    <!-- Hover read quick overlay -->
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <a href="{{ route('books.show', $book->id) }}" class="bg-white text-blue-600 font-bold px-3 py-1.5 rounded-lg text-xs shadow">
                            Buka Detail
                        </a>
                    </div>
                </div>
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <span class="inline-block bg-blue-50 text-blue-600 text-[9px] px-2 py-0.5 rounded-full font-medium mb-1.5">{{ $book->category->nama_kategori ?? 'Umum' }}</span>
                        <h3 class="font-bold text-sm text-gray-800 line-clamp-2 group-hover:text-blue-600 transition-colors"><a href="{{ route('books.show', $book->id) }}">{{ $book->judul }}</a></h3>
                        <p class="text-gray-400 text-[10px] mt-1">{{ $book->penulis }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-50 flex items-center justify-between">
                        <span class="text-[10px] text-gray-400">{{ $book->tahun }}</span>
                        <a href="{{ route('books.show', $book->id) }}" class="text-xs text-blue-600 font-semibold hover:text-blue-800 transition-colors flex items-center">
                            Detail
                            <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-user-layout>
