<x-app-layout>
    

    <div class="py-12 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section dengan Search -->
            <div class="relative mb-12 rounded-2xl overflow-hidden shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-700 opacity-90"></div>
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1506929562872-bb421503ef21')] bg-cover bg-center mix-blend-overlay"></div>
                
                <div class="relative py-16 px-8 text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Temukan Destinasi Impianmu</h1>
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">Jelajahi berbagai tempat wisata menarik di Tegal dan sekitarnya</p>
                    
                    <form method="GET" action="{{ route('dashboard') }}" class="max-w-md mx-auto">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-grow">
                                <select name="kategori" class="w-full bg-white/90 backdrop-blur-sm text-gray-700 rounded-lg pl-4 pr-10 py-3 appearance-none focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-lg">
                                    <option value="">Semua Kategori</option>
                                    
                                    <option value="alam" {{ request('kategori') == 'alam' ? 'selected' : '' }}>Alam</option>
                                    <option value="budaya & Sejarah" {{ request('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya & Sejarah</option>
                                    <option value="religi" {{ request('kategori') == 'religi' ? 'selected' : '' }}>Religi</option> 
                                    <option value="rekreasi & hiburan" {{ request('kategori') == 'Rekreasi' ? 'selected' : '' }}>Rekreasi & Hiburan</option>
                                    
                                    
                                    
                                    
                                    
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Destinasi Section -->
            <div class="mb-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Destinasi Populer</h2>
                    <div class="text-sm text-gray-500">Menampilkan {{ $destinasi->count() }} destinasi</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($destinasi as $d)
                        <div class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300" onclick="toggleUlasan(this)">
                            <div class="relative overflow-hidden">
                                <img src="{{ $d->image }}" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-500" alt="{{ $d->nama }}">
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst(optional($d->kategori)->nama) ?? 'Tidak diketahui' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $d->nama }}</h3>
                                
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($d->rating_rata2 ?? 0))
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-500 ml-1">({{ $d->rating_rata2 ?? 'N/A' }})</span>
                                </div>
                                
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $d->deskripsi }}</p>
                                
                                <div class="space-y-3">
                                    <form action="{{ route('favorit.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="destinasi_id" value="{{ $d->id }}">
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white border border-red-500 text-red-500 hover:bg-red-50 py-2 px-4 rounded-lg transition duration-300">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                            <span>Simpan ke Favorit</span>
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('wisata.show', $d->id) }}" class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <span>Lihat Detail</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-xl p-12 text-center shadow-md">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-6">
                                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada destinasi ditemukan</h3>
                            <p class="text-gray-500 mb-6">Coba pilih kategori lain atau reset filter pencarian</p>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Lihat Semua Destinasi
                            </a>
                        </div>
                    @endforelse
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
