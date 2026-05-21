<x-admin-layout>
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kategori Buku</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola kategori buku digital untuk mempermudah pencarian dan pengelompokan.</p>
        </div>
        
        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-sm transition-all duration-200 flex items-center gap-1.5 self-stretch md:self-auto justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-2xl mb-6 flex items-center shadow-sm">
        <svg class="w-5 h-5 mr-2 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="text-sm font-semibold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[500px]">
            <thead class="bg-gray-50/75 border-b border-gray-100">
                <tr>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider w-16">No</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Nama Kategori</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                <tr class="hover:bg-blue-50/20 transition-colors">
                    <td class="py-4 px-6 text-sm text-gray-500 font-medium">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold mr-3 text-xs uppercase">
                                {{ substr($category->nama_kategori, 0, 2) }}
                            </div>
                            <span class="font-bold text-gray-800 text-sm">{{ $category->nama_kategori }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-xs bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white font-semibold py-1.5 px-3 rounded-lg transition-colors shadow-sm">
                                Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus kategori ini beserta buku di dalamnya?')" class="text-xs bg-red-50 text-red-600 hover:bg-red-500 hover:text-white font-semibold py-1.5 px-3 rounded-lg transition-colors shadow-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            <p class="text-gray-400 text-sm">Belum ada data kategori buku.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>