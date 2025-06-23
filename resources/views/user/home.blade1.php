<x-app-layout>
    
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
                
                <div class="relative z-10 py-20 px-8 md:px-16 flex flex-col md:flex-row items-center justify-between gap-12">
                    <!-- Left Content -->
                    <div class="text-white max-w-xl">
                        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                            <span class="block">EXPLORE</span>
                            <span class="block">DREAM</span>
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-200 to-yellow-400">DESTINATION</span>
                        </h1>
                        <p class="text-xl text-blue-100 mb-8">Temukan pengalaman tak terlupakan di tempat-tempat terbaik pilihan kami. Jelajahi Tegal dan buat kenangan indah!</p>
                        <a href="/dashboard" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-400 to-yellow-500 text-indigo-900 font-bold rounded-full shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                            <span>EXPLORE NOW</span>
                            <svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- 3D Floating Element -->
                    <div class="relative w-72 h-72 hidden md:block">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-indigo-300 rounded-full blur-2xl opacity-30 animate-pulse"></div>
                        <div class="relative h-full flex items-center justify-center">
                            <svg class="w-48 h-48 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 12L12 16L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Features Section -->
            <section class="mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Kenapa Memilih Kami?</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Kami menawarkan pengalaman terbaik untuk menjelajahi keindahan Tegal dengan fitur-fitur unggulan</p>
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
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                                READ MORE
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                                READ MORE
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                                READ MORE
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- CTA Section -->
            <section class="relative rounded-3xl overflow-hidden shadow-xl">
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
        </div>
    </div>
</x-app-layout>
