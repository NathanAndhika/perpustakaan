@php
    $layout = Auth::user()->role === 'admin' ? 'admin-layout' : 'user-layout';
@endphp
<x-dynamic-component :component="$layout">
    
    <!-- Modern Header & Search Section -->
    <div class="mb-10 text-center max-w-2xl mx-auto pt-4">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-3">Jelajahi Perpustakaan</h1>
        <p class="text-gray-500 text-sm mb-8">Temukan ribuan buku digital, baca langsung, atau simpan untuk dibaca nanti.</p>
        
        <!-- Search Bar Modern (Google Books style) -->
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" id="search-input" placeholder="Cari judul, penulis, atau penerbit..." class="w-full bg-white border border-gray-200 text-gray-800 text-base rounded-full pl-12 pr-4 py-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] focus:border-blue-400 focus:shadow-[0_4px_20px_rgba(59,130,246,0.12)] focus:ring-0 outline-none transition-all duration-300">
            
            <div class="absolute inset-y-0 right-2 flex items-center">
                <select id="category-filter" class="bg-gray-50/80 border-none text-gray-600 text-sm rounded-full px-4 py-2 hover:bg-gray-100 focus:ring-0 cursor-pointer outline-none transition-colors">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-2xl mb-8 flex items-center shadow-sm max-w-2xl mx-auto">
        <svg class="w-5 h-5 mr-2 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="text-sm font-semibold">{{ session('success') }}</span>
    </div>
    @endif

    @if(Auth::user()->role === 'admin')
    <div class="flex justify-end mb-6">
        <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition-all duration-200 flex items-center gap-1.5 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Buku Digital
        </a>
    </div>
    @endif

    <!-- Books Container -->
    <div id="books-list" class="transition-opacity duration-300">
        @include('books._list')
    </div>

    <!-- Toast Notification -->
    <div id="toast-notification" class="fixed bottom-6 right-6 transform translate-y-20 opacity-0 bg-gray-900 text-white px-6 py-3.5 rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] flex items-center gap-3 transition-all duration-300 z-50 pointer-events-none">
        <svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
        <span id="toast-message" class="text-sm font-semibold tracking-wide">Berhasil ditambahkan ke koleksi buku</span>
    </div>

    <!-- Client Side AJAX Search Script -->
    <script>
        // Global toggle favorite function with AJAX
        window.toggleFavorite = function(button, bookId) {
            event.preventDefault();
            const icon = button.querySelector('.heart-icon');
            const isFavorited = icon.getAttribute('fill') === 'currentColor';

            // Optimistically update UI
            if (isFavorited) {
                icon.setAttribute('fill', 'none');
                icon.classList.remove('text-rose-500');
            } else {
                icon.setAttribute('fill', 'currentColor');
                icon.classList.add('text-rose-500');
            }

            // Send AJAX request to server
            fetch(`/favorites/${bookId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(json => {
                if (json.favorited) {
                    showToast('Buku berhasil ditambahkan ke koleksi buku');
                } else {
                    showToast('Buku dihapus dari koleksi buku');
                }
            })
            .catch(err => console.error('Error toggling favorite:', err));
        };

        // Toast notification logic
        let toastTimeout;
        window.showToast = function(message) {
            const toast = document.getElementById('toast-notification');
            const toastMsg = document.getElementById('toast-message');
            
            toastMsg.textContent = message;
            
            // Show
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            
            // Hide after 3s
            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        };

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const categoryFilter = document.getElementById('category-filter');
            const booksList = document.getElementById('books-list');

            function filterBooks() {
                // Apply a subtle fade effect during search
                booksList.style.opacity = '0.4';

                const search = searchInput.value;
                const category = categoryFilter.value;
                const url = new URL(window.location.href);
                
                url.searchParams.set('search', search);
                url.searchParams.set('category', category);
                
                // Update browser URL without reloading
                window.history.pushState({}, '', url);

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    booksList.innerHTML = html;
                    booksList.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error fetching filtered books:', error);
                    booksList.style.opacity = '1';
                });
            }

            // Debouncer for search query
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            searchInput.addEventListener('input', debounce(filterBooks, 300));
            categoryFilter.addEventListener('change', filterBooks);
        });
    </script>
</x-dynamic-component>