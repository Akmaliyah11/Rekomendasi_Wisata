<h2>Rekomendasi Untukmu</h2>
@foreach($destinations as $destination)
    <div>
        <h3>{{ $destination->name }}</h3>
        <p>{{ $destination->description }}</p>
        <p>Kategori: {{ $destination->category->name }}</p>
    </div>
@endforeach
