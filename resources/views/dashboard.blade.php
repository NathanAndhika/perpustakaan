<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-5">
            Dashboard Perpustakaan
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="bg-white p-5 rounded shadow">
                <h2 class="text-xl font-bold">Total Buku</h2>
                <p class="text-3xl">{{ $totalBooks }}</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <h2 class="text-xl font-bold">Total Kategori</h2>
                <p class="text-3xl">{{ $totalCategories }}</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <h2 class="text-xl font-bold">Total Peminjaman</h2>
                <p class="text-3xl">{{ $totalBorrowings }}</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <h2 class="text-xl font-bold">Sedang Dipinjam</h2>
                <p class="text-3xl">{{ $borrowedBooks }}</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <h2 class="text-xl font-bold">Sudah Dikembalikan</h2>
                <p class="text-3xl">{{ $returnedBooks }}</p>
            </div>

        </div>

    </div>

</x-app-layout>