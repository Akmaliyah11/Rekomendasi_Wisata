<section class="text-center py-12 px-4">
    <form method="GET" action="{{ route('dashboard') }}" class="mb-8">
        <h1 class="text-4xl font-bold mb-4">Temukan destinasi<br>sesuai minatmu!</h1>
        <div class="flex flex-col md:flex-row justify-center items-center gap-4 mt-6">
            <select class="border border-gray-300 rounded px-4 py-2 w-64">
                <option>Kategori</option>
                <option value="Pantai">Pantai</option>
                <option value="Pegunungan">Pegunungan</option>
                <option value="Taman Hiburan">Taman Hiburan</option>
                <option value="Tempat Bersejarah">Tempat Bersejarah</option>
                <option value="Air Terjun">Air Terjun</option>
                <option value="Agrowisata">Agrowisata</option>
                <option value="Religi">Religi</option>
            </select>
            <button class="bg-gray-800 text-white px-6 py-2 rounded">Cari</button>
        </div>
    </form>
</section>