<x-app-layout>
    <!-- Modal Preferensi - Hanya ditampilkan jika user belum pernah mengisi preferensi -->
    @if(auth()->check() && !$hasPreference)
    <div id="preferenceModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 py-6 px-6 text-white rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <h3 class="text-xl font-bold" id="modal-title">Selamat Datang! Atur Preferensi Wisatamu</h3>
                        </div>
                        <button type="button" class="text-white hover:text-gray-200 focus:outline-none" onclick="closePreferenceModal()">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-blue-100 mt-2">Beri tahu kami preferensimu untuk mendapatkan rekomendasi destinasi yang lebih sesuai</p>
                </div>

                <div class="bg-white px-6 py-6">
                    <form id="preferenceForm" action="{{ route('user-preferences.store') }}" method="POST">
                        @csrf

                        <!-- Kategori Wisata -->
                        <div class="mb-6">
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Kategori Wisata Favorit:
                                </div>
                            </label>
                            <select name="kategori_id" id="kategori_id" required
                                class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Rating -->
                        <div class="mb-6">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Seberapa Suka Kamu dengan Kategori Ini:
                                </div>
                            </label>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <input type="hidden" name="rating" id="rating" value="3">
                                <div class="flex items-center justify-between">
                                    <div class="flex" id="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button" onclick="setRating({{ $i }})" class="focus:outline-none transform hover:scale-110 transition-transform">
                                                <svg class="w-8 h-8 {{ $i <= 3 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <span id="rating-text" class="text-lg font-medium text-gray-700">3 dari 5</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <button type="button" onclick="closePreferenceModal()" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Nanti Saja
                            </button>
                            <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan Preferensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- JavaScript -->
    <script>
        function setRating(rating) {
            document.getElementById('rating').value = rating;
            const stars = document.querySelectorAll('#star-rating button svg');
            const ratingText = document.getElementById('rating-text');

            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });

            ratingText.innerText = rating + ' dari 5';
        }

        function closePreferenceModal() {
            document.getElementById('preferenceModal').style.display = 'none';
            
            // Set cookie untuk tidak menampilkan modal lagi dalam sesi ini
            document.cookie = "preference_modal_closed=true; path=/";
        }
    </script>

    <!-- Konten halaman home lainnya -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <section class="relative rounded-3xl overflow-hidden shadow-2xl mb-16">
                <!-- Background with overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-800 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1596422846543-75c6fc197f11')] bg-cover bg-center"></div>
                
                <!-- Animated particles -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full animate-pulse"></div>
                    <div class="absolute right-20 top-20 w-20 h-20 bg-white opacity-10 rounded-full animate-ping" style="animation-duration: 3s"></div>
                    <div class="absolute left-10 bottom-5 w-32 h-32 bg-white opacity-10 rounded-full animate-pulse" style="animation-duration: 4s"></div>
                </div>
                
                <div class="relative z-10 py-12 px-6 md:px-12 flex flex-col md:flex-row items-center justify-between gap-8">
                    <!-- Left Content -->
                    <div class="text-white max-w-md">
                        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                            <span class="block">EXPLORE</span>
                            <span class="block">DREAM</span>
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-200 to-yellow-400">DESTINATION</span>
                        </h1>
                        <p class="text-lg text-blue-100 mb-6">Temukan pengalaman tak terlupakan di tempat-tempat terbaik pilihan kami. Jelajahi Jawa Tengah dan buat kenangan indah!</p>
                        <a href="/dashboard" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-400 to-yellow-500 text-indigo-900 font-bold rounded-full shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                            <span>EXPLORE NOW</span>
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- 3D Floating Element -->
                    <div class="relative w-72 h-72 hidden md:block">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-indigo-300 rounded-full blur-2xl opacity-30 animate-pulse"></div>
                        <div class="relative h-full flex items-center justify-center">
                           <img src="{{ asset('front/assets/media/user/LOGONEW.png') }}" alt="TravelKita Logo" class="h-100 w-auto">
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Features Section -->
            <section class="mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Kenapa Memilih Kami?</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Kami menawarkan pengalaman terbaik untuk menjelajahi keindahan Jawa Tengah dengan fitur-fitur unggulan</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Destinasi Terbaik</h3>
                        <p class="text-gray-600 text-center">Kami memilih destinasi terbaik dengan pemandangan yang menakjubkan dan pengalaman yang tak terlupakan.</p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="bg-amber-100 text-amber-600 rounded-full w-16 h-16 flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Rekomendasi Pintar</h3>
                        <p class="text-gray-600 text-center">Sistem rekomendasi kami akan membantu Anda menemukan tempat yang sesuai dengan preferensi Anda.</p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="bg-green-100 text-green-600 rounded-full w-16 h-16 flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Pengalaman Premium</h3>
                        <p class="text-gray-600 text-center">Nikmati pengalaman premium dengan informasi lengkap dan ulasan dari pengunjung lainnya.</p>
                    </div>
                </div>
            </section>
            
            <!-- Destination Highlights -->
            <section class="mb-16">
                <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800">Destinasi Populer</h2>
                    <a href="/dashboard" class="mt-4 md:mt-0 inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                        Lihat Semua Destinasi
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Destination Card 1 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group hover:shadow-2xl transition-all duration-500">
                        <div class="relative h-64 overflow-hidden">
                            <img src="https://blog.bookingtogo.com/wp-content/uploads/2023/05/Pai-tegal_11zon-scaled.jpg" alt="Pantai Alam Indah" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-2xl font-bold text-white mb-2">Pantai Alam Indah</h3>
                                <div class="flex items-center text-amber-300">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-semibold">4.8</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Pantai populer di Tegal dengan pemandangan sunset yang menakjubkan dan berbagai aktivitas menarik.</p>
                            <a href="/dashboard" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                SHOW MORE
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Destination Card 2 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group hover:shadow-2xl transition-all duration-500">
                        <div class="relative h-64 overflow-hidden">
                            <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/panturapost/2023/09/WhatsApp-Image-2023-09-17-at-13.55.02.jpeg" alt="Alun-alun Tegal" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-2xl font-bold text-white mb-2">Curug Cantel</h3>
                                <div class="flex items-center text-amber-300">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-semibold">4.6</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Air terjun tersembunyi dengan pemandangan asri.</p>
                            <a href="/dashboard" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                SHOW MORE
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Destination Card 3 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group hover:shadow-2xl transition-all duration-500">
                        <div class="relative h-64 overflow-hidden">
                            <img src="https://asset.kompas.com/crops/nkeCilcMIMmPcOKMsh_2tLY2wrM=/28x0:939x607/1200x800/data/photo/2024/08/27/66cdba6bd0865.jpg" alt="Guci" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-2xl font-bold text-white mb-2">Pemandian Air Panas Guci</h3>
                                <div class="flex items-center text-amber-300">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-semibold">4.9</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Nikmati pemandian air panas alami dengan latar belakang pegunungan yang indah dan udara yang sejuk.</p>
                            <a href="/dashboard" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                SHOW MORE
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- CTA Section -->
            <section class="relative rounded-3xl overflow-hidden shadow-xl mb-12">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-700"></div>
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1')] bg-cover bg-center mix-blend-overlay opacity-20"></div>
                
                <!-- Decorative elements -->
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
                    <div class="absolute -right-10 top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute left-20 bottom-20 w-60 h-60 bg-white opacity-10 rounded-full"></div>
                </div>
                
                <div class="relative z-10 py-16 px-8 md:px-16 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Untuk Petualangan Berikutnya?</h2>
                    <p class="text-indigo-100 max-w-2xl mx-auto mb-10 text-lg">Jelajahi berbagai destinasi menarik di Tegal dan sekitarnya. Temukan tempat-tempat tersembunyi dan buat kenangan tak terlupakan!</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/dashboard" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-700 font-bold rounded-full shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                            Mulai Jelajahi
                        </a>
                        <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition-all duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </section>
            
            <!-- About/Watermark Section -->
            <section class="mb-8 text-center">
                <div class="flex flex-col items-center justify-center">
                    <!-- Logo -->
                    <div class="mb-4">
                        <img src="{{ asset('front/assets/media/user/LOGONEW.png') }}" alt="TravelKita Logo" class="h-16 w-auto">
                    </div>
                    
                    <!-- About Text -->
                    <div class="max-w-2xl mx-auto text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tentang TravelKita</h3>
                        <p class="text-gray-600 mb-4">TravelKita adalah platform rekomendasi destinasi wisata di Jawa Tengah yang membantu Anda menemukan tempat-tempat menarik sesuai dengan preferensi Anda. Kami berkomitmen untuk memberikan pengalaman terbaik dalam menjelajahi keindahan Jawa Tengah.</p>
                        <a href="{{ route('about') }}" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                            Pelajari Lebih Lanjut
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Divider -->
                    <div class="w-full max-w-4xl mx-auto border-t border-gray-200 my-6"></div>
                    
                    <!-- Copyright -->
                    <div class="text-gray-500 text-sm">
                        <p>&copy; {{ date('Y') }} TravelKita. All rights reserved.</p>
                        <p class="mt-1">Dibuat dengan <span class="text-red-500">TravelKita Team</span> di Tegal, Indonesia</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
