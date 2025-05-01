<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <script src="https://cdn.tailwindcss.com"></script>
                    <!-- Judul -->
                    <section class="relative bg-cover bg-center min-h-screen flex items-center justify-center" style="background-color: white;">
                        <div class="absolute inset-0 bg-white-900 bg-opacity-60"></div>
                
                        <div class="relative max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-10">
                            <!-- Left Content -->
                            <div class="text-black max-w-lg">
                                <h1 class="text-5xl font-bold leading-tight mb-4">EXPLORE <br> DREAM <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-black to-gray-300">DESTINATION</span></h1>
                                <p class="mb-6 text-black-300">Temukan pengalaman tak terlupakan di tempat-tempat terbaik pilihan kami. Jelajahi Tegal dan buat kenangan indah!</p>
                                <a href="/dashboard" class="bg-blue-400 hover:bg-green-500 text-green-900 font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 inline-block text-center">
                                    BOOK NOW
                                </a>
                                
                            </div>
                
                            <!-- Right Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white bg-opacity-90 rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                                    <img src="https://blog.bookingtogo.com/wp-content/uploads/2023/05/Pai-tegal_11zon-scaled.jpg" alt="Pantai Alam Indah" class="h-48 w-full object-cover">
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-green-800 mb-2">Pantai Alam Indah</h3>
                                        <p class="text-sm text-gray-600 mb-4">Pantai populer di Tegal dengan pemandangan sunset.</p>
                                        <a href="#" class="text-orange-600 hover:text-green-800 font-semibold text-sm inline-flex items-center">
                                            READ MORE
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                
                                <div class="bg-white bg-opacity-90 rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                                    <img src="https://asset-2.tstatic.net/banyumas/foto/bank/images/Suasana-Waduk-Cacaban-Kecamatan-Kedungbanteng-Kabupaten-Tegal.jpg" alt="Waduk Cacaban" class="h-48 w-full object-cover">
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-green-800 mb-2">Waduk Cacaban</h3>
                                        <p class="text-sm text-gray-600 mb-4">Waduk dengan suasana alam dan tempat makan terapung.</p>
                                        <a href="#" class="text-orange-600 hover:text-green-800 font-semibold text-sm inline-flex items-center">
                                            READ MORE
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                
                                <div class="bg-white bg-opacity-90 rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                                    <img src="https://asset.kompas.com/crops/nkeCilcMIMmPcOKMsh_2tLY2wrM=/28x0:939x607/1200x800/data/photo/2024/08/27/66cdba6bd0865.jpg" alt="Guci Hot Water Boom" class="h-48 w-full object-cover">
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-green-800 mb-2">Guci Hot Water Boom</h3>
                                        <p class="text-sm text-gray-600 mb-4">Pemandian air panas di kawasan Guci yang terkenal.</p>
                                        <a href="#" class="text-orange-600 hover:text-green-800 font-semibold text-sm inline-flex items-center">
                                            READ MORE
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                
                    <!-- End Semua Fitur -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
