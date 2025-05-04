<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekomendasi Destinasi Wisata') }}
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
                    

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($recommended_destinations->isEmpty())
                <p class="text-gray-700">Tidak ada rekomendasi untuk Anda.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($recommended_destinations as $destination)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition card">
                            @if ($destination->gambar)
                                <img src="{{ asset('storage/' . $destination->gambar) }}" alt="{{ $destination->nama }}"
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $destination->nama }}</h3>
                                <p class="text-gray-600 text-sm mt-2">{{ Str::limit($destination->deskripsi, 100) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
