<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Destinasi Wisata Populer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .date {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 15px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .top-destinations {
            margin-bottom: 30px;
        }
        .top-destinations table {
            width: 80%;
            margin: 0 auto;
        }
        .top-destinations th {
            background-color: #4a6cf7;
            color: white;
        }
    </style>
</head>
<body>
    <h1>LAPORAN DESTINASI WISATA POPULER</h1>
    <p class="date">Tanggal: {{ $date }}</p>
    
    <!-- Top 5 Destinasi -->
    <div class="section-title">Top 5 Destinasi Populer</div>
    <div class="top-destinations">
        <table>
            <thead>
                <tr>
                    <th width="10%">Ranking</th>
                    <th width="50%">Nama Destinasi</th>
                    <th width="20%">Kategori</th>
                    <th width="20%">Jumlah Review</th>
                </tr>
            </thead>
            <tbody>
                @foreach($destinations->take(5) as $index => $destination)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $destination->nama }}</td>
                    <td class="text-center">{{ $destination->kategori ? $destination->kategori->nama : '-' }}</td>
                    <td class="text-center">{{ $destination->reviews_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="text-align: right; font-style: italic; margin-top: 30px;">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>

