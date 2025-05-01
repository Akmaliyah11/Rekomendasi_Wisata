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
                  
                  <title>Temukan Destinasi</title>
                  <script src="https://cdn.tailwindcss.com"></script>
                  
                  <!-- FORM PILIH KATEGORI -->
                  <section class="text-center py-12 px-4">
                      <form method="GET" action="{{ route('dashboard') }}" class="mb-8">
                          <h1 class="text-4xl font-bold mb-4">Temukan destinasi<br>sesuai minatmu!</h1>
                          <div class="flex flex-col md:flex-row justify-center items-center gap-4 mt-6">
                              <select name="kategori" class="border border-gray-300 rounded px-4 py-2 w-64">
                                  <option value="">-- Semua Kategori --</option>
                                  <option value="pantai" {{ request('kategori') == 'pantai' ? 'selected' : '' }}>Pantai</option>
                                  <option value="pegunungan" {{ request('kategori') == 'pegunungan' ? 'selected' : '' }}>Pegunungan</option>
                                  <option value="taman" {{ request('kategori') == 'taman' ? 'selected' : '' }}>Taman Hiburan</option>
                                  <option value="sejarah" {{ request('kategori') == 'sejarah' ? 'selected' : '' }}>Tempat Bersejarah</option>
                                  <option value="airterjun" {{ request('kategori') == 'airterjun' ? 'selected' : '' }}>Air Terjun</option>
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

                      @php
                          $destinasi = [
                              [
                                  'nama' => 'Pantai Alam Indah',
                                  'kategori' => 'pantai',
                                  'deskripsi' => 'Pantai populer di Tegal dengan pemandangan sunset.',
                                  'rating' => 4.3,
                                  'gambar' => 'https://blog.bookingtogo.com/wp-content/uploads/2023/05/Pai-tegal_11zon-scaled.jpg',
                              ],
                              [
                                  'nama' => 'Waduk Cacaban',
                                  'kategori' => 'pegunungan',
                                  'deskripsi' => 'Waduk dengan suasana alam dan tempat makan terapung.',
                                  'rating' => 4.0,
                                  'gambar' => 'https://asset-2.tstatic.net/banyumas/foto/bank/images/Suasana-Waduk-Cacaban-Kecamatan-Kedungbanteng-Kabupaten-Tegal.jpg',
                              ],
                              [
                                  'nama' => 'Guci Hot Water Boom',
                                  'kategori' => 'pegunungan',
                                  'deskripsi' => 'Pemandian air panas di kawasan Guci yang terkenal.',
                                  'rating' => 4.5,
                                  'gambar' => 'https://asset.kompas.com/crops/nkeCilcMIMmPcOKMsh_2tLY2wrM=/28x0:939x607/1200x800/data/photo/2024/08/27/66cdba6bd0865.jpg',
                              ],
                              [
                                  'nama' => 'Rita Park',
                                  'kategori' => 'taman',
                                  'deskripsi' => 'Taman hiburan keluarga dengan berbagai wahana menarik.',
                                  'rating' => 4.2,
                                  'gambar' => 'https://asset-2.tstatic.net/travel/foto/bank/images/rita-park-tempat-wisata-ramah-keluarga-di-tegal.jpg',
                              ],
                              [
                                  'nama' => 'Curug Cantel',
                                  'kategori' => 'airterjun',
                                  'deskripsi' => 'Air terjun tersembunyi dengan pemandangan asri.',
                                  'rating' => 4.1,
                                  'gambar' => 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/panturapost/2023/09/WhatsApp-Image-2023-09-17-at-13.55.02.jpeg',
                              ],
                              [
                                  'nama' => 'Masjid Agung Tegal',
                                  'kategori' => 'religi',
                                  'deskripsi' => 'Masjid besar dan ikonik di tengah kota Tegal.',
                                  'rating' => 4.6,
                                  'gambar' => 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/133/2024/02/04/Masjid-Agung-Tegal-1218846499.jpg',
                              ],
                              [
                                  'nama' => 'Masjid Agung Tegal',
                                  'kategori' => 'religi',
                                  'deskripsi' => 'Masjid besar dan ikonik di tengah kota Tegal.',
                                  'rating' => 4.6,
                                  'gambar' => 'https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2022/07/14/3342735898.jpg',
                              ],
                              // Tambahkan destinasi lain kalau mau
                          ];

                          $kategoriDipilih = request('kategori');

                          if ($kategoriDipilih) {
                              $destinasi = array_filter($destinasi, function($d) use ($kategoriDipilih) {
                                  return $d['kategori'] == $kategoriDipilih;
                              });
                          }
                      @endphp

                      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                          @forelse($destinasi as $d)
                              <div class="card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="toggleUlasan(this)">
                                  <img src="{{ $d['gambar'] }}" class="w-full h-48 object-cover" alt="{{ $d['nama'] }}">
                                  <div class="p-4">
                                      <h2 class="text-xl font-semibold mb-1">{{ $d['nama'] }}</h2>
                                      <p class="text-gray-600 mb-1">{{ $d['deskripsi'] }}</p>
                                      <p class="text-sm mb-1"><strong>Kategori:</strong> {{ ucfirst($d['kategori']) }}</p>
                                      <p class="text-yellow-500 mb-2">Rating: ★★★★☆ ({{ $d['rating'] }})</p>
                                      <div class="ulasan hidden">
                                          <textarea class="w-full border rounded p-2 mb-2" placeholder="Tulis ulasan..."></textarea>
                                          <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kirim</button>
                                      </div>
                                  </div>
                              </div>
                          @empty
                              <p class="text-center col-span-3">Tidak ada destinasi ditemukan.</p>
                          @endforelse
                      </div>
                  </section>

              </div>
          </div>
      </div>
  </div>

  <script>
      function toggleUlasan(card) {
          let ulasanBox = card.querySelector('.ulasan');
          if (ulasanBox.classList.contains('hidden')) {
              ulasanBox.classList.remove('hidden');
          } else {
              ulasanBox.classList.add('hidden');
          }
      }
  </script>

</x-app-layout>
