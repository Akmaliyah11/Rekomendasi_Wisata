@props(['image', 'title', 'description', 'facilities', 'rating'])

<div class="card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="toggleUlasan(this)">
    <img src="{{ $image }}" class="w-full h-48 object-cover" alt="{{ $title }}">
    <div class="p-4">
        <h2 class="text-xl font-semibold mb-1">{{ $title }}</h2>
        <p class="text-gray-600 mb-1">{{ $description }}</p>
        <p class="text-sm mb-1"><strong>Fasilitas:</strong> {{ $facilities }}</p>
        <p class="text-yellow-500 mb-2">Rating: {{ $rating }}</p>
        <div class="ulasan hidden">
            <textarea class="w-full border rounded p-2 mb-2" placeholder="Tulis ulasan..."></textarea>
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kirim</button>
        </div>
    </div>
</div>