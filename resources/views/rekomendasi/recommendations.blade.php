<x-app-layout>
    

    <div class="py-12 bg-gradient-to-br from-blue-50 via-indigo-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl shadow-xl overflow-hidden mb-10">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute right-20 top-20 w-20 h-20 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute left-10 bottom-5 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute -left-10 top-10 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                </div>
                
                <div class="relative z-10 px-8 py-10 text-white">
                    <div class="flex items-center mb-4">
                        <svg class="w-10 h-10 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        <h1 class="text-3xl font-bold">Rekomendasi Khusus Untukmu</h1>
                    </div>
                    <p class="text-blue-100 max-w-2xl text-lg">Berdasarkan preferensimu, kami telah memilih destinasi wisata yang paling sesuai dengan minat dan kesukaanmu.</p>
                </div>
            </div>

            @if ($recommended_destinations->isEmpty())
                <div class="bg-white rounded-xl shadow-lg p-10 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Rekomendasi</h3>
                        <p class="text-gray-500 mb-6">Sepertinya kami belum memiliki cukup informasi tentang preferensimu.</p>
                        <a href="{{ route('user-preferences.create') }}" class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Atur Preferensi
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($recommended_destinations as $destination)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <!-- Image container with overlay -->
                            <div class="relative h-56 overflow-hidden">
                                @if ($destination->image)
                                    @if (Str::startsWith($destination->image, ['http://', 'https://']))
                                        <img src="{{ $destination->image }}" alt="{{ $destination->nama }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->nama }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @endif
                                @endif
                                
                                <!-- Similarity score badge -->
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full shadow-md">
                                    {{ number_format($destination->skor_kemiripan * 100, 1) }}% Cocok
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $destination->nama }}</h3>
                                    <div class="flex items-center bg-amber-50 text-amber-700 px-2 py-1 rounded-lg">
                                        <svg class="w-4 h-4 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="font-semibold">{{ $destination->avg_rating }}</span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($destination->deskripsi, 100) }}</p>
                                
                                <!-- Features/Tags -->
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $destination->lokasi ?? 'Tegal' }}
                                    </span>
                                    @if(isset($destination->kategori) && $destination->kategori)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $destination->kategori->nama ?? 'Wisata' }}
                                    </span>
                                    @endif
                                </div>
                                
                                <!-- Action buttons -->
                                <div class="flex space-x-3">
                                    <form action="{{ route('favorit.store') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="destinasi_id" value="{{ $destination->id }}">
                                        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            </svg>
                                            Simpan Favorit
                                        </button>
                                    </form>
                                    
                                    <a href="#" class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 w-12 rounded-lg transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination or Load More -->
                <div class="mt-12 flex justify-center">
                    <a href="#" class="inline-flex items-center px-6 py-3 border border-indigo-300 text-indigo-600 bg-white rounded-lg hover:bg-indigo-50 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        Lihat Lebih Banyak
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Floating action button for refresh recommendations -->
    <div class="fixed bottom-8 right-8">
        <a href="{{ route('recommendations') }}" class="flex items-center justify-center w-14 h-14 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        </a>
    </div>

    

</x-app-layout>
