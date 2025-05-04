<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $d->nama }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <img src="{{ $d->image }}" alt="{{ $d->nama }}" class="w-full h-64 object-cover rounded mb-4">

                <h3 class="text-2xl font-bold mb-2">{{ $d->nama }}</h3>
                <p class="text-gray-600 mb-2"><strong>Lokasi:</strong> {{ $d->lokasi }}</p>
                <p class="text-gray-800 mb-4">{{ $d->deskripsi }}</p>

                <h4 class="font-semibold">Fasilitas:</h4>
                <ul class="list-disc ml-5 mb-4">
                    @foreach($d->fasilitas as $fasilitas)
                        <li>{{ $fasilitas }}</li>
                    @endforeach
                </ul>

                <p><strong>Rating rata-rata:</strong> {{ $d->rating_rata2 }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
