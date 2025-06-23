@extends('layouts.admin')

@section('title', 'Edit Destinasi Wisata')
@section('subtitle', 'Perbarui informasi destinasi wisata')

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-amber-500 to-yellow-400 px-6 py-4 text-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
        
        <div class="relative z-10 flex items-center">
            <svg class="w-10 h-10 mr-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <h2 class="text-2xl font-bold">Edit Destinasi</h2>
        </div>
        <p class="mt-2 text-amber-100 ml-14">Perbarui informasi destinasi wisata di database</p>
    </div>

    <!-- Form Section -->
    <div class="p-6">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-green-800">{{ session('success') }}</h3>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-red-800">Terdapat kesalahan pada input</h3>
                </div>
                <ul class="mt-2 ml-10 list-disc text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('datawisata.update', $destination->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Destinasi -->
                <div class="col-span-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Destinasi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $destination->nama) }}" required 
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <select id="kategori_id" name="kategori_id" required
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('kategori_id', $destination->kategori_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $destination->lokasi) }}" required 
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>

                <!-- Rating -->
                <div>
                    <label for="rating_rata2" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <input type="number" id="rating_rata2" name="rating_rata2" value="{{ old('rating_rata2', $destination->rating_rata2) }}" required
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500"
                            min="0" max="5" step="0.1">
                    </div>
                    <div class="mt-1 flex items-center">
                        <div class="flex text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($destination->rating_rata2))
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                @else
                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                @endif
                            @endfor
                        </div>
                        <span class="ml-2 text-xs text-gray-500">Rating saat ini</span>
                    </div>
                </div>

                <!-- Link Gambar -->
                <div class="col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Link Gambar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="text" id="image" name="image" value="{{ old('image', $destination->image) }}" required
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Masukkan URL gambar destinasi (format: jpg, png, atau webp)</p>
                    
                    @if($destination->image)
                    <div class="mt-2 relative rounded-lg overflow-hidden shadow-md h-32 bg-gray-100">
                        <img src="{{ $destination->image }}" alt="{{ $destination->nama }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end">
                            <p class="text-white text-xs p-2">Preview gambar saat ini</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Fasilitas -->
                <div class="col-span-2">
                    <label for="fasilitas" class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <input type="text" id="fasilitas" name="fasilitas" 
                            value="{{ old('fasilitas', is_array($destination->fasilitas) ? implode(', ', $destination->fasilitas) : $destination->fasilitas) }}"
                            required
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="col-span-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('deskripsi', $destination->deskripsi) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection    

