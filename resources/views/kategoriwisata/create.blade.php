@extends('layouts.admin')

@section('title', 'Tambah Kategori Wisata')
@section('subtitle', 'Buat kategori baru untuk destinasi wisata')

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 text-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
        
        <div class="relative z-10 flex items-center">
            <svg class="w-8 h-8 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-2xl font-bold">Tambah Kategori Wisata</h2>
        </div>
        <p class="mt-1 text-blue-100 ml-11">Buat kategori baru untuk mengelompokkan destinasi wisata</p>
    </div>

    <!-- Form Section -->
    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm font-medium text-red-800">Ada beberapa kesalahan:</p>
                </div>
                <ul class="mt-1 ml-6 list-disc text-xs text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategoriwisata.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div class="space-y-5">
                <!-- Nama Kategori -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required 
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Pantai, Gunung, Taman Hiburan">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Nama kategori harus unik dan deskriptif</p>
                </div>

                <!-- Deskripsi Kategori -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                    <div class="relative">
                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="pl-10 block w-full shadow-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Deskripsi singkat tentang kategori ini">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <!-- Contoh Kategori -->
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <h3 class="text-sm font-medium text-blue-800 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Contoh Kategori Populer
                    </h3>
                    <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-1.5"></span>
                            <span>Pantai</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5"></span>
                            <span>Gunung</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-purple-400 rounded-full mr-1.5"></span>
                            <span>Taman Hiburan</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-1.5"></span>
                            <span>Wisata Budaya</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-red-400 rounded-full mr-1.5"></span>
                            <span>Wisata Kuliner</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-indigo-400 rounded-full mr-1.5"></span>
                            <span>Wisata Religi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center pt-3 border-t border-gray-200">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Kategori
                </button>
                <a href="{{ route('kategoriwisata.index') }}" class="ml-4 text-gray-600 hover:text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
