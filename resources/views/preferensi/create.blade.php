<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preferensi Pengguna') }}
        </h2>
    </x-slot>

    <head>
        <style>
            .card:hover {
                transform: scale(1.02);
                transition: 0.3s;
            }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 py-10 px-6">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        {{-- Flash message jika berhasil --}}
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('user-preferences.store') }}" method="POST"
                            class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
                            @csrf

                            {{-- Pilih Kategori --}}
                            <div class="mb-4">
                                <label for="kategori_id"
                                    class="block text-sm font-medium text-gray-700">Kategori Wisata Favorit:</label>
                                <select name="kategori_id" id="kategori_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($categories as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pilih Destinasi --}}
                            <div class="mb-4">
                                <label for="destinasi_id"
                                    class="block text-sm font-medium text-gray-700">Destinasi yang Disukai:</label>
                                <select name="destinasi_id" id="destinasi_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($destinations as $destinasi)
                                        <option value="{{ $destinasi->id }}">{{ $destinasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Rating --}}
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating dari Anda
                                    (1-5):</label>
                                <input type="number" name="rating" id="rating" min="1" max="5"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <button type="submit"
                                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                Simpan Preferensi
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
