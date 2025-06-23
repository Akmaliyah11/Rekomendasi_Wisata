<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-indigo-50 via-blue-50 to-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-100">
                <!-- Header Section dengan animasi -->
                <div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 py-10 px-8 text-white rounded-t-2xl overflow-hidden">
                    <!-- Animated background elements -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                        <div class="absolute right-20 top-20 w-20 h-20 bg-white opacity-10 rounded-full"></div>
                        <div class="absolute left-10 bottom-5 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                        <div class="absolute -left-10 top-10 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center mb-4">
                            <svg class="w-10 h-10 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h1 class="text-3xl font-bold">Personalisasi Pengalaman Wisatamu</h1>
                        </div>
                        <p class="text-blue-100 max-w-2xl text-lg">Beri tahu kami preferensi wisatamu untuk mendapatkan rekomendasi destinasi yang lebih sesuai dengan minatmu.</p>
                    </div>
                </div>

                <div class="p-8">
                    {{-- Flash message jika berhasil --}}
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-sm animate-fade-in">
                            <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Form Section -->
                        <div class="md:col-span-2">
                            <form action="{{ route('user-preferences.store') }}" method="POST">
                                @csrf
                                
                                <div class="bg-white rounded-2xl border border-gray-100 shadow-lg overflow-hidden">
                                    <!-- Form Header -->
                                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-100">
                                        <h2 class="text-xl font-bold text-gray-800">Atur Preferensimu</h2>
                                        <p class="text-gray-500 text-sm">Pilih kategori wisata favoritmu</p>
                                    </div>
                                    
                                    <div class="p-6 space-y-6">
                                        {{-- Pilih Kategori --}}
                                        <div class="group">
                                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2 group-hover:text-indigo-600 transition-colors">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                    Kategori Wisata Favorit:
                                                </div>
                                            </label>
                                            <div class="relative">
                                                <select name="kategori_id" id="kategori_id" required
                                                    class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-lg shadow-sm transition-all group-hover:border-indigo-300">
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($categories as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Pilih Destinasi (Opsional) --}}
                                        <div class="group mt-4" id="destinasi-container" style="display: none;">
                                            <label for="destinasi_id" class="block text-sm font-medium text-gray-700 mb-2 group-hover:text-indigo-600 transition-colors">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    Destinasi Favorit (Opsional):
                                                </div>
                                            </label>
                                            <div class="relative">
                                                <select name="destinasi_id" id="destinasi_id"
                                                    class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-lg shadow-sm transition-all group-hover:border-indigo-300">
                                                    <option value="">-- Pilih Destinasi (Opsional) --</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Rating --}}
                                        <div class="group">
                                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2 group-hover:text-indigo-600 transition-colors">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                    </svg>
                                                    Seberapa Suka Kamu dengan Kategori Ini:
                                                </div>
                                            </label>
                                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                                <input type="number" name="rating" id="rating" min="1" max="5" value="3" class="hidden" onchange="updateStars(this.value)">
                                                <div class="flex items-center">
                                                    <div class="flex" id="star-rating">
                                                        <button type="button" onclick="setRating(1)" class="focus:outline-none transform hover:scale-110 transition-transform">
                                                            <svg class="w-10 h-10 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        </button>
                                                        <button type="button" onclick="setRating(2)" class="focus:outline-none transform hover:scale-110 transition-transform">
                                                            <svg class="w-10 h-10 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        </button>
                                                        <button type="button" onclick="setRating(3)" class="focus:outline-none transform hover:scale-110 transition-transform">
                                                            <svg class="w-10 h-10 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        </button>
                                                        <button type="button" onclick="setRating(4)" class="focus:outline-none transform hover:scale-110 transition-transform">
                                                            <svg class="w-10 h-10 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        </button>
                                                        <button type="button" onclick="setRating(5)" class="focus:outline-none transform hover:scale-110 transition-transform">
                                                            <svg class="w-10 h-10 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <span class="ml-2 text-gray-700" id="rating-text">3 dari 5</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <button type="submit"
                                                class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-semibold rounded-md hover:from-indigo-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 shadow-md transition duration-300 transform hover:-translate-y-1">
                                                Simpan Preferensi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Info Section -->
                        <div class="md:col-span-1">
                            <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-6 rounded-2xl border border-indigo-100 shadow-lg relative overflow-hidden">
                                <!-- Decorative elements -->
                                <div class="absolute -right-12 -top-12 w-32 h-32 bg-indigo-100 opacity-50 rounded-full"></div>
                                <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-blue-100 opacity-50 rounded-full"></div>
                                
                                <div class="relative">
                                    <!-- Icon with animated glow effect -->
                                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-2xl mb-6 shadow-lg transform -rotate-3 hover:rotate-0 transition-all duration-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <!-- Glow effect -->
                                        <div class="absolute inset-0 rounded-2xl bg-indigo-500 blur-xl opacity-30 animate-pulse"></div>
                                    </div>
                                    
                                    <h3 class="text-xl font-bold text-indigo-900 mb-3">Mengapa Mengatur Preferensi?</h3>
                                    <p class="text-indigo-800 mb-6 leading-relaxed">Dengan mengatur preferensi, sistem kami dapat memberikan rekomendasi destinasi wisata yang lebih sesuai dengan minat dan kesukaanmu.</p>
                                    
                                    <div class="border-t border-indigo-200 my-4 pt-4"></div>
                                    
                                    <h3 class="text-xl font-bold text-indigo-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Bagaimana Cara Kerjanya?
                                    </h3>
                                    <p class="text-indigo-800 mb-6 leading-relaxed">Sistem kami menggunakan algoritma cerdas untuk menganalisis preferensimu dan mencocokkannya dengan destinasi wisata yang tersedia untuk memberikan rekomendasi yang personal.</p>
                                    
                                    <div class="mt-8">
                                        <a href="{{ route('recommendations') }}" class="group inline-flex items-center justify-center w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                                            <!-- Button background animation -->
                                            <span class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                            
                                            <span class="relative flex items-center">
                                                <svg class="w-5 h-5 mr-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                                Lihat Rekomendasi
                                            </span>
                                        </a>
                                    </div>
                                    
                                    <!-- Badge -->
                                    <div class="mt-6 flex justify-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            Data Preferensimu Aman
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Fungsi untuk mengatur rating
                    function setRating(value) {
                        document.getElementById('rating').value = value;
                        updateStars(value);
                        document.getElementById('rating-text').textContent = value + ' dari 5';
                    }

                    // Fungsi untuk memperbarui tampilan bintang
                    function updateStars(value) {
                        const stars = document.querySelectorAll('#star-rating svg');
                        stars.forEach((star, index) => {
                            if (index < value) {
                                star.classList.remove('text-gray-300');
                                star.classList.add('text-yellow-400');
                            } else {
                                star.classList.remove('text-yellow-400');
                                star.classList.add('text-gray-300');
                            }
                        });
                    }

                    // Fungsi untuk mendapatkan destinasi berdasarkan kategori
                    document.getElementById('kategori_id').addEventListener('change', function () {
                        const kategoriId = this.value;
                        const destinasiContainer = document.getElementById('destinasi-container');
                        const destinasiSelect = document.getElementById('destinasi_id');
                        
                        if (!kategoriId) {
                            destinasiContainer.style.display = 'none';
                            return;
                        }
                        
                        destinasiContainer.style.display = 'block';
                        destinasiSelect.innerHTML = '<option value="">Loading...</option>';
                        
                        fetch(`/get-destinations-by-category/${kategoriId}`)
                            .then(response => response.json())
                            .then(data => {
                                destinasiSelect.innerHTML = '<option value="">-- Pilih Destinasi (Opsional) --</option>';
                                data.forEach(destinasi => {
                                    destinasiSelect.innerHTML += `<option value="${destinasi.id}">${destinasi.nama}</option>`;
                                });
                            })
                            .catch(error => {
                                destinasiSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                                console.error(error);
                            });
                    });

                    // Inisialisasi rating
                    setRating(3);
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
