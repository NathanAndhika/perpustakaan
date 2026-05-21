@if(Auth::user()->role === 'admin')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead class="bg-gray-50/75 border-b border-gray-100">
                <tr>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider w-12">No</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Buku</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Kategori</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Penerbit & Tahun</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($books as $book)
                <tr class="hover:bg-blue-50/20 transition-colors">
                    <td class="py-4 px-6 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="w-10 h-14 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 mr-4">
                                @if($book->cover_buku)
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-xs">PDF</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-gray-800 text-sm"><a href="{{ route('books.show', $book->id) }}" class="hover:text-blue-600">{{ $book->judul }}</a></div>
                                <div class="text-xs text-gray-400 mt-0.5">{{ $book->penulis }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700">
                            {{ $book->category->nama_kategori ?? 'Umum' }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm text-gray-700">{{ $book->penerbit }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">{{ $book->tahun }}</div>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="text-xs bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white font-semibold py-1.5 px-3 rounded-lg transition-colors shadow-sm">
                                Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus buku ini?')" class="text-xs bg-red-50 text-red-600 hover:bg-red-500 hover:text-white font-semibold py-1.5 px-3 rounded-lg transition-colors shadow-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <p class="text-gray-400 text-sm">Tidak menemukan buku digital yang dicari.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
    <!-- Grid User (Modern Notion/Google Books Style) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($books as $book)
        <div class="bg-white rounded-[20px] p-4 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.06)] border border-gray-100/80 transition-all duration-300 flex flex-col group relative">
            
            <!-- Cover Container -->
            <a href="{{ route('books.show', $book->id) }}" class="block w-full aspect-[3/4] bg-gray-50 rounded-xl overflow-hidden mb-4 relative z-10">
                @if($book->cover_buku)
                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center bg-blue-50/50 text-blue-300 font-bold text-sm">
                        <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        PDF
                    </div>
                @endif
                <!-- Shadow overlay at bottom of cover -->
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            
            <!-- Info Content -->
            <div class="flex-1 flex flex-col justify-between relative z-20 bg-white">
                <div>
                    <h3 class="font-bold text-sm text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-600 transition-colors">
                        <a href="{{ route('books.show', $book->id) }}">{{ $book->judul }}</a>
                    </h3>
                    <p class="text-gray-500 text-[11px] mt-1.5 font-medium line-clamp-1">{{ $book->penulis }}</p>
                </div>
                
                <!-- Action Buttons (Slide up on hover effect) -->
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
                    <a href="{{ route('books.show', $book->id) }}" class="flex-1 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-xs font-semibold py-2 px-3 rounded-lg text-center transition-colors duration-200">
                        Lihat Detail
                    </a>
                    <button type="button" data-id="{{ $book->id }}" onclick="window.toggleFavorite(this, {{ $book->id }})" class="fav-btn w-8 h-8 rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-500 flex items-center justify-center transition-colors duration-200 cursor-pointer" title="Simpan ke Favorit">
                        <svg class="w-4 h-4 heart-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="font-bold text-gray-700 text-lg">Buku Tidak Ditemukan</h3>
                <p class="text-gray-400 text-sm mt-1 max-w-sm mx-auto">Kami tidak dapat menemukan buku digital dengan kriteria pencarian Anda. Silakan coba kata kunci lain.</p>
            </div>
        </div>
        @endforelse
    </div>
@endif
