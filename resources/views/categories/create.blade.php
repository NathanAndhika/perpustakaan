<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tambah Kategori Buku</h1>
        <p class="text-gray-500 text-sm mt-1">Tambahkan kategori baru untuk klasifikasi buku digital.</p>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border border-red-100 text-red-800 p-4 rounded-2xl mb-6 shadow-sm max-w-xl">
        <ul class="list-disc pl-5 text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm max-w-xl">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required placeholder="Masukkan nama kategori (contoh: Sains, Novel)" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">
            </div>

            <!-- Submit buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('categories.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 font-bold text-sm transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-sm transition-colors text-sm">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>