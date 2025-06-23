<x-app-layout>
    

    <!-- Custom styles for animations and effects -->
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-hover:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .bg-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>

    <div class="py-12 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section with 3D effect -->
            <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 rounded-3xl shadow-2xl overflow-hidden mb-12">
                <!-- Animated particles -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full animate-pulse"></div>
                    <div class="absolute right-20 top-20 w-20 h-20 bg-white opacity-10 rounded-full animate-ping" style="animation-duration: 3s"></div>
                    <div class="absolute left-10 bottom-5 w-32 h-32 bg-white opacity-10 rounded-full animate-pulse" style="animation-duration: 4s"></div>
                    <div class="absolute -left-10 top-10 w-24 h-24 bg-white opacity-10 rounded-full animate-ping" style="animation-duration: 5s"></div>
                </div>
                
                <div class="relative z-10 px-10 py-16 text-white">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="mb-8 md:mb-0">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white bg-opacity-20 rounded-2xl mr-5 backdrop-blur-sm">
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-4xl font-extrabold tracking-tight">Koleksi Favoritmu</h1>
                                    <p class="text-indigo-100 max-w-2xl text-lg mt-2">Destinasi wisata yang telah kamu simpan untuk rencana perjalanan mendatang.</p>
                                </div>
                            </div>
                            
                            <!-- Stats bar -->
                            <div class="mt-4 flex flex-wrap gap-4">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl px-5 py-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-pink-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span>{{ $favorites->count() }} Destinasi</span>
                                </div>
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl px-5 py-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Tegal, Indonesia</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 3D Floating Illustration -->
                        <div class="relative w-64 h-64 animate-float hidden md:block">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-300 to-pink-300 rounded-full blur-2xl opacity-30"></div>
                            <div class="relative h-full flex items-center justify-center">
                                <svg class="w-48 h-48 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 12.5719L12 16.9999L4.5 12.5719V7.42793L12 3.00793L19.5 7.42793V12.5719Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M12 17V21M4.5 7.5L12 12L19.5 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center animate__animated animate__fadeInDown">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @elseif (session('error'))
                <div class="mb-8 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm flex items-center animate__animated animate__fadeInDown">
                    <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($favorites->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 bg-white rounded-3xl shadow-xl">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full blur-xl opacity-20 animate-pulse"></div>
                        <div class="relative bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full p-8 mb-6">
                            <svg class="w-24 h-24 text-indigo-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-3">Belum Ada Favorit</h3>
                    <p class="text-gray-500 mb-10 text-center max-w-md">Kamu belum menyimpan destinasi favorit. Jelajahi destinasi wisata dan simpan yang menarik perhatianmu!</p>
                    <a href="{{ route('recommendations') }}" class="inline-flex items-center px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Jelajahi Destinasi
                    </a>
                </div>
            @else
                <!-- Filter and Sort Controls -->
                <div class="bg-glass rounded-2xl shadow-lg p-6 mb-8 sticky top-4 z-20">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center flex-wrap gap-2">
                            <span class="text-gray-700 font-medium mr-3">Filter:</span>
                            <button class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-lg shadow-md hover:shadow-lg transition-all">
                                Semua
                            </button>
                            <button class="px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:shadow hover:bg-gray-50 transition-all">
                                Alam
                            </button>
                            <button class="px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:shadow hover:bg-gray-50 transition-all">
                                Budaya
                            </button>
                            <button class="px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:shadow hover:bg-gray-50 transition-all">
                                Kuliner
                            </button>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="text-gray-700 font-medium mr-3">Urutkan:</span>
                            <select class="bg-white border-0 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 shadow-sm">
                                <option>Terbaru</option>
                                <option>Rating Tertinggi</option>
                                <option>A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Modern Card Grid with Similarity to Recommendations -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($favorites as $index => $fav)
                        <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden group">
                            <!-- Image with overlay -->
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $fav->destinasi->image }}" alt="{{ $fav->destinasi->nama }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <!-- Overlay gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>
                                
                                <!-- Category badge -->
                                <div class="absolute top-4 left-4 z-10">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-white/80 text-indigo-800 backdrop-blur-sm">
                                        {{ ucfirst(optional($fav->destinasi->kategori)->nama) ?? 'Tidak diketahui' }}
                                    </span>
                                </div>
                                
                                <!-- Favorite badge - similar to similarity score in recommendations -->
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full shadow-md">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                    Favorit
                                </div>
                                
                                <!-- Quick action buttons -->
                                <div class="absolute bottom-4 right-4 z-10 flex space-x-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                                    <form action="{{ route('favorit.destroy', $fav->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-white/80 text-red-600 rounded-full backdrop-blur-sm hover:bg-white transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('wisata.show', $fav->destinasi->id) }}" class="p-2 bg-white/80 text-indigo-600 rounded-full backdrop-blur-sm hover:bg-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                                
                                <!-- Title on image -->
                                <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                                    <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-indigo-200 transition-colors">{{ $fav->destinasi->nama }}</h3>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center text-amber-300">
                                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="font-semibold">{{ $fav->destinasi->rating_rata2 ?? '4.5' }}</span>
                                        </div>
                                        <span class="text-white text-sm">
                                            @if($fav->created_at)
                                                {{ $fav->created_at->diffForHumans() }}
                                            @else
                                                Baru ditambahkan
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card content -->
                            <div class="p-6">
                                <!-- Location with icon -->
                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $fav->destinasi->lokasi ?? 'Tegal, Indonesia' }}</span>
                                </div>
                                
                                <!-- Description preview -->
                                <p class="text-gray-600 mb-6 line-clamp-2">{{ $fav->destinasi->deskripsi ?? 'Nikmati keindahan destinasi wisata ini dengan pemandangan yang menakjubkan dan pengalaman yang tak terlupakan.' }}</p>
                                
                                <!-- Action buttons -->
                                <div class="flex space-x-3">
                                    <a href="{{ route('wisata.show', $fav->destinasi->id) }}" class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Detail
                                    </a>
                                    <form action="{{ route('favorit.destroy', $fav->id) }}" method="POST" class="flex-none">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-white border border-red-500 text-red-500 hover:bg-red-50 py-3 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-300">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination if needed -->
                @if(isset($favorites) && method_exists($favorites, 'links') && $favorites->hasPages())
                    <div class="mt-8">
                        {{ $favorites->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
