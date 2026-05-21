<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Buku Digital</h1>
        <p class="text-gray-500 text-sm mt-1">Ubah data e-book, perbarui cover, atau unggah file PDF yang baru.</p>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border border-red-100 text-red-800 p-4 rounded-2xl mb-6 shadow-sm">
        <div class="font-semibold text-sm mb-2">Mohon perbaiki kesalahan berikut:</div>
        <ul class="list-disc pl-5 text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm max-w-3xl">
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Buku</label>
                    <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" required placeholder="Masukkan judul buku" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" required class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Penulis / Pengarang</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}" required placeholder="Nama penulis" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                </div>

                <!-- Penerbit -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required placeholder="Penerbit buku" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $book->tahun) }}" required placeholder="Contoh: 2024" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi / Sinopsis</label>
                <textarea name="deskripsi" rows="4" placeholder="Tulis deskripsi atau sinopsis singkat buku..." class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl px-4 py-2.5 focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all">{{ old('deskripsi', $book->deskripsi) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cover Buku -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cover Buku (Image)</label>
                    @if($book->cover_buku)
                        <div class="mb-3 flex items-center p-3 bg-blue-50/50 rounded-2xl border border-blue-100 max-w-sm">
                            <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="Current Cover" class="w-10 h-14 object-cover rounded-lg mr-3 border border-gray-200">
                            <div>
                                <p class="text-xs font-semibold text-gray-700">Cover Saat Ini</p>
                                <p class="text-[10px] text-gray-400">Biarkan kosong jika tidak ingin diubah.</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-xs text-gray-500"><span class="font-semibold">Klik untuk ganti</span> JPG, PNG, atau WebP</p>
                                <p class="text-[10px] text-gray-400 mt-1">Maks. 2MB</p>
                            </div>
                            <input type="file" name="cover_buku" accept="image/*" class="hidden" />
                        </label>
                    </div>
                </div>

                <!-- File PDF -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File PDF (E-Book)</label>
                    @if($book->file_pdf)
                        <div class="mb-3 flex items-center p-3 bg-indigo-50/50 rounded-2xl border border-indigo-100 max-w-sm">
                            <svg class="w-10 h-10 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-700 truncate">PDF Saat Ini</p>
                                <p class="text-[9px] text-gray-400 truncate">{{ basename($book->file_pdf) }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <p class="text-xs text-gray-500"><span class="font-semibold">Klik untuk ganti</span> Dokumen PDF</p>
                                <p class="text-[10px] text-gray-400 mt-1">Maks. 20MB</p>
                            </div>
                            <input type="file" name="file_pdf" accept=".pdf" class="hidden" />
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('books.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 font-bold text-sm transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-sm transition-colors text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>