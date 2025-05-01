<!DOCTYPE html>
<html>
<head>
    <title>Daftar Destinasi Wisata</title>
</head>
<body>
    <h1>Rekomendasi Destinasi Wisata</h1>
    <ul>
        @foreach($destinasion as $d)
            <li>
                <strong>{{ $d->nama }}</strong><br>
                Kategori: {{ $d->kategori }}<br>
                Lokasi: {{ $d->lokasi }}<br>
                Rating: {{ $d->rating }}<br>
                Deskripsi: {{ $d->deskripsi }}
            </li>
            <hr>
        @endforeach
    </ul>
</body>
</html>
