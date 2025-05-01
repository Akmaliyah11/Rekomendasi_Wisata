<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wisata') }}
        </h2>
    </x-slot>

    <head>
        <style>
          .card:hover {
            transform: scale(1.02);
            transition: 0.3s;
          }
          
        </style>
      </head>
      <body class="bg-gray-100 p-6">
    <script src="https://cdn.tailwindcss.com"></script>
    <body class="bg-gray-100 py-10 px-6">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Fitur 1: Pencarian berdasarkan kategori -->
                    
                    <section class="text-center py-12 px-4"> 
                    <h1 class="text-lg font-semibold text-gray-800 mb-2">BERIKUT BEBERAPA WISATA YANG ADA DI TEGAL</h1>
                    </section>
                    <!-- Fitur 2: Rekomendasi destinasi -->
                    <div class="mb-8">
                        

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Template Card -->
                            <div class="card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="toggleUlasan(this)">
                              <img src="https://blog.bookingtogo.com/wp-content/uploads/2023/05/Pai-tegal_11zon-scaled.jpg" class="w-full h-48 object-cover" alt="Pantai Alam Indah">
                              <div class="p-4">
                                <h2 class="text-xl font-semibold mb-1">Pantai Alam Indah</h2>
                                <p class="text-gray-600 mb-1">Pantai populer di Tegal dengan pemandangan sunset.</p>
                                <p class="text-sm mb-1"><strong>Fasilitas:</strong> parkir, toilet, warung</p>
                                <p class="text-yellow-500 mb-2">Rating: ★★★★☆ (4.3)</p>
                                <div class="ulasan hidden">
                                  <textarea class="w-full border rounded p-2 mb-2" placeholder="Tulis ulasan..."></textarea>
                                  <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kirim</button>
                                </div>
                              </div>
                            </div>
                      
                            <!-- Card lainnya -->
                            <div class="card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="toggleUlasan(this)">
                              <img src="https://asset-2.tstatic.net/banyumas/foto/bank/images/Suasana-Waduk-Cacaban-Kecamatan-Kedungbanteng-Kabupaten-Tegal.jpg" class="w-full h-48 object-cover" alt="Waduk Cacaban">
                              <div class="p-4">
                                <h2 class="text-xl font-semibold mb-1">Waduk Cacaban</h2>
                                <p class="text-gray-600 mb-1">Waduk dengan suasana alam dan tempat makan terapung.</p>
                                <p class="text-sm mb-1"><strong>Fasilitas:</strong> parkir, toilet, perahu</p>
                                <p class="text-yellow-500 mb-2">Rating: ★★★★☆ (4.0)</p>
                                <div class="ulasan hidden">
                                  <textarea class="w-full border rounded p-2 mb-2" placeholder="Tulis ulasan..."></textarea>
                                  <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kirim</button>
                                </div>
                              </div>
                            </div>
                      
                            <!-- Tambah card lain sama seperti di atas -->
                            <!-- Contoh card Guci Hot Water Boom -->
                            <div class="card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="toggleUlasan(this)">
                              <img src="https://asset.kompas.com/crops/nkeCilcMIMmPcOKMsh_2tLY2wrM=/28x0:939x607/1200x800/data/photo/2024/08/27/66cdba6bd0865.jpg" class="w-full h-48 object-cover" alt="Guci Hot Water Boom">
                              <div class="p-4">
                                <h2 class="text-xl font-semibold mb-1">Guci Hot Water Boom</h2>
                                <p class="text-gray-600 mb-1">Pemandian air panas di kawasan Guci yang terkenal.</p>
                                <p class="text-sm mb-1"><strong>Fasilitas:</strong> parkir, toilet, kolam renang, penginapan</p>
                                <p class="text-yellow-500 mb-2">Rating: ★★★★★ (4.5)</p>
                                <div class="ulasan hidden">
                                  <textarea class="w-full border rounded p-2 mb-2" placeholder="Tulis ulasan..."></textarea>
                                  <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kirim</button>
                                </div>
                              </div>
                            </div>
                      
                            <!-- Tambahkan semua card lainnya sesuai datamu -->
                          </div>
                        </div>
                      
                        <script>
                          function toggleUlasan(card) {
                            const ulasanBox = card.querySelector('.ulasan');
                            ulasanBox.classList.toggle('hidden');
                          }
                        </script>
                    <!-- End Semua Fitur -->
                </div>
            </div>
        </div>
    </div>
    </body>
</x-app-layout>


