@php
    $layout = Auth::user()->role === 'admin' ? 'admin-layout' : 'user-layout';
@endphp
<x-dynamic-component :component="$layout">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Detail Buku</h1>
            <p class="text-gray-500 text-sm mt-1">Informasi lengkap, sinopsis, dan berkas buku digital.</p>
        </div>
        <a href="{{ route('books.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-10 shadow-sm flex flex-col md:flex-row gap-10">
        <!-- Cover Buku -->
        <div class="w-full md:w-72 flex-shrink-0">
            <div class="bg-blue-50/50 w-full aspect-[3/4] rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex items-center justify-center relative group">
                @if($book->cover_buku)
                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                @else
                    <div class="flex flex-col items-center justify-center text-blue-400">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span class="font-bold text-xs uppercase">E-BOOK PDF</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info & Sinopsis -->
        <div class="flex-1 flex flex-col justify-between">
            <div>
                <div class="mb-3">
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                        {{ $book->category->nama_kategori ?? 'Umum' }}
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ $book->judul }}</h2>
                <p class="text-lg text-gray-500 font-medium mb-8">Oleh <span class="text-gray-800">{{ $book->penulis }}</span></p>

                <!-- Metadata Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-8 border-t border-b border-gray-50 py-6">
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Penerbit</p>
                        <p class="font-bold text-gray-800 text-sm">{{ $book->penerbit }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Tahun Terbit</p>
                        <p class="font-bold text-gray-800 text-sm">{{ $book->tahun }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Total Pembaca</p>
                        <p class="font-bold text-gray-800 text-sm flex items-center gap-1">
                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            {{ $book->readingHistories()->count() }} kali dibaca
                        </p>
                    </div>
                </div>

                <!-- Sinopsis -->
                <div class="mb-8">
                    <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Deskripsi / Sinopsis</h4>
                    <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $book->deskripsi ?: 'Tidak ada deskripsi sinopsis untuk buku ini.' }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t border-gray-50 flex flex-wrap gap-4">
                <a href="{{ route('books.download', $book->id) }}" class="flex-1 md:flex-none justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-xl transition-all duration-200 flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh PDF
                </a>

                @if(Auth::user()->role === 'admin')
                    <div class="w-full md:w-auto md:ml-auto flex gap-2 mt-4 md:mt-0">
                        <a href="{{ route('books.edit', $book->id) }}" class="flex-1 md:flex-none justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white font-bold px-6 py-3.5 rounded-xl transition-all duration-200">
                            Edit Buku
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline flex-1 md:flex-none">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus buku ini?')" class="w-full justify-center bg-red-50 text-red-600 hover:bg-red-500 hover:text-white font-bold px-6 py-3.5 rounded-xl transition-all duration-200">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dynamic-component>
