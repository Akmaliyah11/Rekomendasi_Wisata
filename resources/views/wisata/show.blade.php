<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $d->nama }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Image Section -->
            <div class="relative rounded-xl overflow-hidden shadow-lg mb-8 h-80 md:h-96">
                <img src="{{ $d->image }}" alt="{{ $d->nama }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $d->nama }}</h1>
                    <div class="flex items-center gap-4 text-white/90">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            {{ $d->lokasi }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            {{ $d->rating_rata2 }}/5
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Tabs Navigation -->
                <div x-data="{ activeTab: 'info' }" class="border-b">
                    <div class="flex overflow-x-auto">
                        <button @click="activeTab = 'info'" :class="{ 'border-b-2 border-blue-600 text-blue-600': activeTab === 'info' }" class="px-6 py-4 font-medium text-gray-700 hover:text-blue-600 transition-colors">
                            Informasi
                        </button>
                        <button @click="activeTab = 'fasilitas'" :class="{ 'border-b-2 border-blue-600 text-blue-600': activeTab === 'fasilitas' }" class="px-6 py-4 font-medium text-gray-700 hover:text-blue-600 transition-colors">
                            Fasilitas
                        </button>
                        <button @click="activeTab = 'ulasan'" :class="{ 'border-b-2 border-blue-600 text-blue-600': activeTab === 'ulasan' }" class="px-6 py-4 font-medium text-gray-700 hover:text-blue-600 transition-colors">
                            Ulasan
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Info Tab -->
                        <div x-show="activeTab === 'info'" class="space-y-6">
                            <div>
                                <h2 class="text-2xl font-bold mb-4">Tentang Destinasi</h2>
                                <p class="text-gray-700 leading-relaxed">{{ $d->deskripsi }}</p>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-semibold mb-3">Lokasi</h3>
                                <div class="bg-blue-50 p-4 rounded-lg flex items-start">
                                    <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <div>
                                        <p class="font-medium text-blue-800">{{ $d->lokasi }}</p>
                                        <p class="text-blue-600 text-sm mt-1">Klik untuk melihat di Google Maps</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fasilitas Tab -->
                        <div x-show="activeTab === 'fasilitas'" class="space-y-6">
                            <h2 class="text-2xl font-bold mb-4">Fasilitas Tersedia</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($d->fasilitas_array as $fasilitas)
                                    <div class="flex items-center bg-gray-50 p-3 rounded-lg">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span>{{ trim($fasilitas) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Ulasan Tab -->
                        <div x-show="activeTab === 'ulasan'" class="space-y-6">
                            <div class="flex items-center justify-between">
                                <h2 class="text-2xl font-bold">Ulasan Pengunjung</h2>
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">{{ $d->reviews->count() }} ulasan</span>
                            </div>

                            <!-- Form Tambah Ulasan -->
                            <div class="bg-blue-50 p-6 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4">Bagikan Pengalaman Anda</h3>
                                
                                <form action="{{ route('review.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="destinasi_id" value="{{ $d->id }}">
                                    
                                    <div>
                                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                        <div class="flex items-center space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button type="button" onclick="setRating({{ $i }})" class="rating-star text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="rating" id="rating-value" value="5">
                                            <span class="ml-2 text-sm text-gray-600" id="rating-text">Sangat Baik</span>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Ulasan Anda</label>
                                        <textarea id="isi" name="isi" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Bagikan pengalaman Anda tentang destinasi ini..."></textarea>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Kirim Ulasan
                                        </button>
                                        <p class="ml-3 text-xs text-gray-500">Ulasan Anda akan membantu pengunjung lain</p>
                                    </div>
                                </form>
                            </div>

                            @if($d->reviews->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach ($d->reviews as $review)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-3">
                                                        {{ substr($review->user->name ?? 'A', 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-medium">{{ $review->user->name ?? 'Anonymous' }}</p>
                                                        <p class="text-gray-500 text-sm">
                                                            @if($review->created_at)
                                                                {{ $review->created_at->diffForHumans() }}
                                                            @else
                                                                Waktu tidak tersedia
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center bg-white px-2 py-1 rounded-md">
                                                    <div class="flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $review->rating)
                                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                </svg>
                                                            @else
                                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                </svg>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-gray-700">{{ $review->komentar }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    <p class="text-gray-500">Belum ada ulasan untuk destinasi ini.</p>
                                    <p class="text-gray-500 mt-2">Jadilah yang pertama memberikan ulasan!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-6 bg-gray-50 border-t">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <form action="{{ route('favorit.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="destinasi_id" value="{{ $d->id }}">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-lg transition duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                <span>Simpan ke Favorit</span>
                            </button>
                        </form>
                        
                        <a href="{{ url()->previous() }}" class="flex items-center justify-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 py-3 px-4 rounded-lg transition duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Tambahkan script untuk rating -->
<script>
    function setRating(value) {
        // Update hidden input value
        document.getElementById('rating-value').value = value;
        
        // Update star colors
        const stars = document.querySelectorAll('.rating-star');
        const ratingText = document.getElementById('rating-text');
        
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
        
        // Update rating text
        const ratingLabels = ['Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
        ratingText.textContent = ratingLabels[value - 1];
    }
    
    // Initialize with 5 stars
    document.addEventListener('DOMContentLoaded', function() {
        setRating(5);
    });
</script>
