<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Daftar Anggota</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar semua pengguna terdaftar yang menggunakan E-Library.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead class="bg-gray-50/75 border-b border-gray-100">
                <tr>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider w-16">No</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Nama & Email</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Total Dibaca</th>
                    <th class="py-4 px-6 font-semibold text-gray-500 text-xs uppercase tracking-wider">Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-blue-50/20 transition-colors">
                    <td class="py-4 px-6 text-sm text-gray-500 font-medium">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold mr-3 text-sm uppercase shadow-inner">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <span class="font-bold text-gray-800 text-sm block">{{ $user->name }}</span>
                                <span class="text-xs text-gray-400 block mt-0.5">{{ $user->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-teal-50 text-teal-700">
                            <svg class="w-3.5 h-3.5 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            {{ $user->readingHistories()->count() }} Buku
                        </span>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600 font-medium">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <p class="text-gray-400 text-sm">Belum ada anggota terdaftar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
