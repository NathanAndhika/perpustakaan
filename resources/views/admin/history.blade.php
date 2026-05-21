<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Riwayat Aktivitas Baca</h1>
        <p class="text-gray-500 text-sm mt-1">Pantau buku digital yang dibaca atau diunduh oleh para anggota perpustakaan secara real-time.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead class="bg-gray-50/75 border-b border-gray-100">
                <tr>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider w-16">No</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Anggota</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Buku Digital</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Terakhir Dibaca</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($histories as $history)
                <tr class="hover:bg-blue-50/20 transition-colors">
                    <td class="py-4 px-6 text-sm text-gray-500 font-medium">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold mr-3 text-xs uppercase">
                                {{ substr($history->user->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <span class="font-bold text-gray-800 text-sm block">{{ $history->user->name ?? 'User Terhapus' }}</span>
                                <span class="text-xs text-gray-400 block mt-0.5">{{ $history->user->email ?? '-' }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        @if($history->book)
                        <div class="flex items-center">
                            <div class="w-8 h-11 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 mr-3 shadow-xs">
                                @if($history->book->cover_buku)
                                    <img src="{{ asset('storage/' . $history->book->cover_buku) }}" alt="{{ $history->book->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold text-[8px]">PDF</div>
                                @endif
                            </div>
                            <div>
                                <span class="font-bold text-gray-800 text-sm block"><a href="{{ route('books.show', $history->book_id) }}" class="hover:text-blue-600">{{ $history->book->judul }}</a></span>
                                <span class="text-[10px] text-gray-400 block mt-0.5">{{ $history->book->penulis }}</span>
                            </div>
                        </div>
                        @else
                        <span class="text-xs text-gray-400 font-semibold italic">Buku Telah Dihapus</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <span class="text-sm font-semibold text-gray-700 block">{{ $history->last_read_at->format('d M Y H:i') }}</span>
                        <span class="text-xs text-blue-500 block mt-0.5">{{ $history->last_read_at->diffForHumans() }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-gray-400 text-sm">Belum ada aktivitas membaca dari para anggota.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($histories->hasPages())
    <div class="mt-6 w-full">
        {{ $histories->links() }}
    </div>
    @endif
</x-admin-layout>
