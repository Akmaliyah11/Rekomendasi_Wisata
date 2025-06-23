<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Wisata - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-blue-800 text-white p-4 flex flex-col">
            <div class="text-2xl font-bold mb-10">Admin</div>
            <nav class="space-y-2 flex-grow">
                <a href="/admin/home" class="block py-2 px-4 hover:bg-blue-600 rounded">Home</a>
                <a href="/admin/dashboard" class="block py-2 px-4 hover:bg-blue-600 rounded">Dashboard</a>
                <a href="/admin/galery" class="block py-2 px-4 hover:bg-blue-600 rounded">Galery</a>

                <div>
                    <p class="text-sm text-gray-300 mt-4 mb-1">DATA WISATA</p>
                    <a href="/admin/data-wisata" class="block py-2 px-4 bg-blue-600 rounded">Data Wisata</a>
                </div>

                <div>
                    <p class="text-sm text-gray-300 mt-4 mb-1">PENGATURAN</p>
                    <a href="/admin/pengaturan" class="block py-2 px-4 hover:bg-blue-600 rounded">Pengaturan Web</a>
                </div>

                <div>
                    <p class="text-sm text-gray-300 mt-4 mb-1">USERS</p>
                    <a href="/admin/users" class="block py-2 px-4 hover:bg-blue-600 rounded">Users</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 px-4 hover:bg-blue-600 rounded text-white">
                            Log Out
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard - Data Destinasi</h2>
                <div class="text-gray-700 font-medium">
                    @auth
                        {{ Auth::user()->name }}
                    @endauth
                </div>
            </div>

            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white shadow rounded p-4 text-center">
                    <p class="text-sm text-gray-500">DATA DESTINASI</p>
                    <p class="text-2xl font-bold">{{ $destinations->count() ?? 0 }}</p>
                </div>
                <div class="bg-white shadow rounded p-4 text-center">
                    <p class="text-sm text-gray-500">DATA USERS</p>
                    <p class="text-2xl font-bold">{{ $usersCount ?? '0' }}</p>
                </div>
                <div class="bg-white shadow rounded p-4 text-center">
                    <p class="text-sm text-gray-500">DATA KATEGORI</p>
                    <p class="text-2xl font-bold">{{ $categoriesCount ?? '0' }}</p>
                </div>
            </div>

            <!-- Table Data Destinasi -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('datawisata.create') }}" 
               class="mb-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
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
                                    <a href="{{ route('datawisata.edit', $d->id) }}" 
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>

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
        </main>
    </div>
</body>
</html>
