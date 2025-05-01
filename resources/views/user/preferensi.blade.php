@extends('layouts.front')

@section('content')
<section class="preferensi">
    <div class="container">
        <h2>Preferensi Wisatamu</h2>
        <form action="{{ route('user.preferensi.simpan') }}" method="POST">
            @csrf

            <label for="kategori_id">Pilih Kategori Favorit:</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>

            <label for="rating">Seberapa kamu suka kategori ini? (1 - 5)</label>
            <input type="number" name="rating" id="rating" min="1" max="5" class="form-control" required>

            <button type="submit" class="btn-utama">Simpan Preferensi</button>
        </form>
    </div>
</section>
@endsection
