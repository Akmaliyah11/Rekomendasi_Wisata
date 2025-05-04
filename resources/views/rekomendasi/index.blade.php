<form action="{{ route('favorit.store') }}" method="POST" class="mt-4">
    @csrf
    <input type="hidden" name="destinasi_id" value="{{ $d['data']->id }}">
    <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
        ❤️ Simpan ke Favorit
    </button>
</form>
