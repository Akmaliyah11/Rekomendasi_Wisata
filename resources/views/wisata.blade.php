<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wisata') }}
        </h2>
    </x-slot>

    <style>
      .card:hover {
        transform: scale(1.02);
        transition: 0.3s;
      }
    </style>

    <div x-data="{ tab: 'info' }" class="bg-white p-6 rounded shadow-md">
        <!-- Tab Menu -->
        <div class="flex space-x-4 border-b mb-4">
            <button @click="tab = 'info'" 
                :class="tab === 'info' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
                class="pb-2">
                Informasi
            </button>
            <button @click="tab = 'ulasan'" 
                :class="tab === 'ulasan' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
                class="pb-2">
                Ulasan
            </button>
            <button @click="tab = 'favorit'" 
                :class="tab === 'favorit' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
                class="pb-2">
                Favorit
            </button>
        </div>
    
        <!-- Tab Content -->
        <div x-show="tab === 'info'">
            <h3 class="text-xl font-bold">Informasi Destinasi</h3>
            <p>{{ $d->deskripsi ?? 'Deskripsi belum tersedia.' }}</p>
        </div>
    
        <div x-show="tab === 'ulasan'" x-cloak>
            <h3 class="text-xl font-bold">Ulasan Pengguna</h3>
            <!-- Tambahkan isi ulasan di sini -->
        </div>
    
        <div x-show="tab === 'favorit'" x-cloak>
            <h3 class="text-xl font-bold">Simpan ke Favorit</h3>
            <!-- Tambahkan tombol favorit di sini -->
        </div>
    </div>
</x-app-layout>
