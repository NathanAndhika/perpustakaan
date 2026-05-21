<x-user-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Riwayat Bacaan</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar buku digital yang baru saja Anda baca atau unduh.</p>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($histories as $history)
                @if($history->book)
                <div class="bg-gray-50/50 rounded-2xl border border-gray-100 p-4 flex items-center hover:bg-blue-50/20 transition-all duration-300">
                    <div class="w-16 h-24 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 mr-4 shadow-sm">
                        @if($history->book->cover_buku)
                            <img src="{{ asset('storage/' . $history->book->cover_buku) }}" alt="{{ $history->book->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-xs">PDF</div>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1 flex flex-col justify-between h-24 py-0.5">
                        <div>
                            <span class="inline-block bg-blue-50 text-blue-600 text-[9px] px-2 py-0.5 rounded-full font-semibold mb-1">
                                {{ $history->book->category->nama_kategori ?? 'Umum' }}
                            </span>
                            <h3 class="font-bold text-sm text-gray-800 line-clamp-1 hover:text-blue-600">
                                <a href="{{ route('books.show', $history->book_id) }}">{{ $history->book->judul }}</a>
                            </h3>
                            <p class="text-gray-400 text-[10px] mt-0.5 truncate">{{ $history->book->penulis }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-[10px] text-blue-500 font-semibold">Dibaca {{ $history->last_read_at->diffForHumans() }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('books.download', $history->book_id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold p-1.5 rounded-lg text-[10px] shadow transition-colors flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div class="col-span-full py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <h3 class="font-bold text-gray-700 text-lg">Belum Ada Riwayat Bacaan</h3>
                        <p class="text-gray-400 text-sm mt-1 max-w-xs mx-auto">Anda belum membaca atau mendownload buku digital apapun. Mulai jelajahi koleksi kami sekarang!</p>
                        <a href="{{ route('books.index') }}" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition-colors shadow-sm">
                            Cari Buku Digital
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($histories->hasPages())
        <div class="mt-8 pt-6 border-t border-gray-50">
            {{ $histories->links() }}
        </div>
        @endif
    </div>
</x-user-layout>
