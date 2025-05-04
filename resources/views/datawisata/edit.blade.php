<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Destinasi Wisata') }}
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Edit Destinasi</h2>
            <form action="{{ route('datawisata.update', $destination->id) }}" method="POST">
                @csrf
                @method('PUT')  <!-- Ensure the form uses PUT for update -->

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $destination->nama) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $destination->lokasi) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('deskripsi', $destination->deskripsi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori_id" name="kategori_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('kategori_id', $destination->kategori_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
                    <input type="text" id="fasilitas" name="fasilitas"
       value="{{ old('fasilitas', is_array($destination->fasilitas) ? implode(', ', $destination->fasilitas) : $destination->fasilitas) }}"
       required
       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                </div>

                <div class="mb-4">
                    <label for="rating_rata2" class="block text-sm font-medium text-gray-700">Rating Rata-Rata</label>
                    <input type="number" id="rating_rata2" name="rating_rata2" step="0.1" value="{{ old('rating_rata2', $destination->rating_rata2) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Link Gambar</label>
                    <input type="text" id="image" name="image" placeholder="https://example.com/gambar.jpg" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
