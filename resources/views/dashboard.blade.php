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
                    {{ __("You're logged in!") }}

                    <!-- Judul -->
                    <h3 class="text-2xl font-bold text-pink-600 mb-6">Fitur Utama Sistem Rekomendasi Wisata</h3>

                    <!-- Fitur 1: Pencarian berdasarkan kategori -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">🔍 Cari Destinasi Berdasarkan Kategori</h4>
                        <p class="text-gray-700 mb-2">Temukan tempat wisata sesuai minatmu: alam, budaya, kuliner, dan lainnya.</p>
                        <select class="border border-gray-300 rounded p-2 w-full max-w-md">
                            <option value="">Pilih Kategori</option>
                            <option value="alam">Alam</option>
                            <option value="budaya">Budaya</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="belanja">Belanja</option>
                        </select>
                    </div>

                    <!-- Fitur 2: Rekomendasi destinasi -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">⭐ Rekomendasi untuk Kamu</h4>
                        <p class="text-gray-700 mb-4">Berikut beberapa tempat wisata yang sesuai dengan preferensimu:</p>

                        <div class="flex overflow-x-auto gap-4 pb-4">
                            <!-- Kartu Wisata -->
                            @php
                                $destinasi = [
                                    ['nama' => 'Danau Senja', 'deskripsi' => 'Tempat sempurna untuk bersantai dengan alam.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80'],
                                    ['nama' => 'Pegunungan Kristal', 'deskripsi' => 'Pemandangan menakjubkan dan udara sejuk di pegunungan.', 'img' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=800&q=80'],
                                    ['nama' => 'Pantai Tropis', 'deskripsi' => 'Kabut pagi menyelimuti hutan pinus, menciptakan suasana magis dan sejuk.', 'img' => 'https://images.unsplash.com/photo-1493558103817-58b2924bce98?auto=format&fit=crop&w=800&q=80'],
                                ];
                            @endphp

                            @foreach ($destinasi as $item)
                            <div class="min-w-[250px] bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $item['img'] }}" alt="{{ $item['nama'] }}" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h5 class="font-bold text-pink-600 text-lg">{{ $item['nama'] }}</h5>
                                    <p class="text-sm text-gray-600 mb-2">{{ $item['deskripsi'] }}</p>

                                    <!-- Ulasan & Rating per kartu -->
                                    <div class="text-sm text-gray-700 mb-2">
                                        <div class="text-yellow-500 mb-1">★★★★☆</div>
                                        <p class="text-xs text-gray-500 mb-2">“Sangat indah dan damai.”</p>
                                        <textarea class="w-full border rounded p-1 text-xs mb-1" rows="2" placeholder="Tulis ulasan..."></textarea>
                                        <div class="flex items-center gap-2 mb-2">
                                            <label class="text-xs text-gray-600">Rating:</label>
                                            <select class="border rounded p-1 text-xs">
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                        <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded text-xs">Kirim</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Semua Fitur -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
