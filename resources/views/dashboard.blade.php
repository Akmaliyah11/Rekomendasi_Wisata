<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- FORM PILIH KATEGORI -->
                    <section class="text-center py-8 px-4">
                        <form method="GET" action="{{ route('dashboard') }}" class="mb-8">
                            <h1 class="text-4xl font-bold mb-4">Temukan destinasi<br>sesuai minatmu!</h1>
                            <div class="flex flex-col md:flex-row justify-center items-center gap-4 mt-6">
                                <select name="kategori" class="border border-gray-300 rounded px-4 py-2 w-64">
                                    <option value="">-- Semua Kategori --</option>
                                    <option value="pantai" {{ request('kategori') == 'pantai' ? 'selected' : '' }}>Pantai</option>
                                    <option value="pegunungan" {{ request('kategori') == 'pegunungan' ? 'selected' : '' }}>Pegunungan</option>
                                    <option value="taman hiburan" {{ request('kategori') == 'taman' ? 'selected' : '' }}>Taman Hiburan</option>
                                    <option value="tempat bersejarah" {{ request('kategori') == 'sejarah' ? 'selected' : '' }}>Tempat Bersejarah</option>
                                    <option value="air terjun" {{ request('kategori') == 'airterjun' ? 'selected' : '' }}>Air Terjun</option>
                                    <option value="agrowisata" {{ request('kategori') == 'agrowisata' ? 'selected' : '' }}>Agrowisata</option>
                                    <option value="religi" {{ request('kategori') == 'religi' ? 'selected' : '' }}>Religi</option>
                                </select>
                                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded">Cari</button>
                            </div>
                        </form>
                    </section>

                    <!-- DESTINASI CARD -->
                    <section class="bg-gray-100 py-10 px-6">
                        <h2 class="text-center text-2xl font-semibold mb-8">Destinasi Unggulan</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($destinasi as $d)
                                <div class="card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="toggleUlasan(this)">
                                    <img src="{{ $d->image }}" class="w-full h-48 object-cover" alt="{{ $d->nama }}">
                                    <div class="p-4">
                                        <h2 class="text-xl font-semibold mb-1">{{ $d->nama }}</h2>
                                        <p class="text-gray-600 mb-1">{{ $d->deskripsi }}</p>
                                        <p class="text-sm mb-1"><strong>Kategori:</strong> {{ ucfirst(optional($d->kategori)->nama) ?? 'Tidak diketahui' }}</p>
                                        
                                        <p class="text-yellow-500 mb-2">Rating: ★★★★☆ ({{ $d->rating_rata2 ?? 'N/A' }})</p>
                                         
                                        <form action="{{ route('favorit.store') }}" method="POST" class="mt-4">
                                            @csrf
                                            <input type="hidden" name="destinasi_id" value="{{ $d->id }}">
                                            <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                                ❤️ Simpan ke Favorit
                                            </button>
                                        </form>
                                      
                                        <div class="ulasan-form hidden">            
                                            <form method="POST" action="{{ route('review.store') }}">
                                                @csrf
                                                <input type="hidden" name="destinasi_id" value="{{ $d->id }}">
                                                <textarea name="isi" class="w-full border rounded p-2 mb-2" placeholder="Tulis ulasan..."></textarea>
                                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kirim</button>
                                            </form>
                                                
                                            <!-- Menampilkan daftar ulasan -->
                                            @if($d->reviews->isNotEmpty())
                                            <div class="mt-4">
                                                <h3 class="text-sm font-semibold mb-2">Ulasan Pengguna:</h3>
                                                <div class="space-y-2">
                                                    @foreach ($d->reviews as $review)
                                                        <div class="bg-gray-100 p-2 rounded text-left">
                                                            <div class="flex justify-between items-center">
                                                                <p class="font-semibold text-sm">{{ $review->user->name }}</p>
                                                                <span class="text-yellow-500 text-sm">⭐ {{ $review->rating }}/5</span>
                                                            </div>
                                                            <p class="text-gray-700 text-sm mt-1">{{ $review->komentar }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @else
                                                <p>Tidak ada ulasan untuk destinasi ini.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center col-span-full">Tidak ada destinasi ditemukan.</p>
                            @endforelse
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleUlasan(card) {
            // Jangan toggle kalau klik-nya di dalam form
            if (event.target.closest('form') || event.target.tagName === 'TEXTAREA') {
                return;
            }
    
            let ulasanBox = card.querySelector('.ulasan-form');
            if (ulasanBox) {
                ulasanBox.classList.toggle('hidden');
            }
        }
    </script>

</x-app-layout>
