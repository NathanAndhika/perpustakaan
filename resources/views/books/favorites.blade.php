<x-user-layout>
    <div class="max-w-7xl mx-auto py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Buku Saya (Favorit)</h1>
        @if($books->isEmpty())
            <div class="text-center py-12 text-gray-500">
                Anda belum menambahkan buku ke koleksi.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($books as $book)
                    <div class="bg-white rounded-[20px] p-4 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.06)] border border-gray-100/80 transition-all duration-300 flex flex-col group relative">
                        <a href="{{ route('books.show', $book->id) }}" class="block w-full aspect-[3/4] bg-gray-50 rounded-xl overflow-hidden mb-4 relative z-10">
                            @if($book->cover_buku)
                                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-blue-50/50 text-blue-300 font-bold text-sm">
                                    <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    PDF
                                </div>
                            @endif
                        </a>
                        <div class="flex-1 flex flex-col justify-between">
                            <h3 class="font-bold text-sm text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('books.show', $book->id) }}">{{ $book->judul }}</a>
                            </h3>
                            <p class="text-gray-500 text-[11px] mt-1.5 font-medium line-clamp-1">{{ $book->penulis }}</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
                            <a href="{{ route('books.show', $book->id) }}" class="flex-1 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-xs font-semibold py-2 px-3 rounded-lg text-center transition-colors duration-200">Lihat Detail</a>
                            <button type="button" data-id="{{ $book->id }}" onclick="window.toggleFavorite(this, {{ $book->id }})" class="fav-btn w-8 h-8 rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-500 flex items-center justify-center transition-colors duration-200 cursor-pointer text-rose-500" title="Hapus dari Favorit">
                                <svg class="w-4 h-4 heart-icon transition-colors fill-current" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-user-layout>
