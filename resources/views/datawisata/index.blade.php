<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Destinasi Wisata') }}
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
                    

    <div class="py-6 px-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('datawisata.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            + Tambah Destinasi
        </a>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Kategori</th>
                        <th class="px-4 py-2 border">Lokasi</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($destinations as $index => $d)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $d->nama }}</td>
                            <td class="px-4 py-2 border">{{ $d->kategori->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $d->lokasi }}</td>
                            <td class="px-4 py-2 border space-x-2">
                                
                                <a href="{{ route('datawisata.edit', $d->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>

                                <form action="{{ route('datawisata.destroy', $d->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data destinasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
