<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Destinasi Wisata Populer - {{ $date }}</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .date {
            text-align: center;
            margin-bottom: 20px;
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
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .download-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
            width: 200px;
        }
        .back-button {
            display: inline-block;
            margin: 20px 10px;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .button-container {
            text-align: center;
        }
        .chart-container {
            width: 80%;
            margin: 0 auto 30px;
            height: 400px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .top-destinations-table {
            width: 80%;
            margin: 0 auto 30px;
        }
        .top-destinations-table th {
            background-color: #4a6cf7;
            color: white;
        }
        @media print {
            .button-container {
                display: none;
            }
            .chart-container {
                height: 300px;
                page-break-inside: avoid;
            }
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            canvas {
                max-width: 100%;
                height: auto !important;
            }
        }
    </style>
</head>
<body>
    <h1>LAPORAN DESTINASI WISATA POPULER</h1>
    <p class="date">Tanggal: {{ $date }}</p>
    
    <!-- Top 5 Destinasi (Grafik) -->
    <div class="section-title">Top 5 Destinasi Populer (Grafik)</div>
    <div class="chart-container">
        <canvas id="topDestinationsChart"></canvas>
    </div>
    
    <!-- Top 5 Destinasi (Tabel) -->
    <div class="section-title">Top 5 Destinasi Populer (Tabel)</div>
    <div class="top-destinations-table">
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
    
    <div class="button-container">
        <button class="print-button" onclick="prepareAndPrint()">Cetak Laporan</button>
        
        <a href="{{ route('admin.dashboard') }}" class="back-button">Kembali</a>
    </div>

    <script>
        // Data untuk grafik
        const chartData = {
            labels: [
                @foreach($destinations->take(5) as $destination)
                    '{{ $destination->nama }}',
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Review',
                data: [
                    @foreach($destinations->take(5) as $destination)
                        {{ $destination->reviews_count }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Inisialisasi grafik
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('topDestinationsChart').getContext('2d');
            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Top 5 Destinasi Populer',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });

        // Fungsi untuk mencetak dengan memastikan grafik sudah di-render
        function prepareAndPrint() {
            // Tunggu sebentar untuk memastikan grafik sudah di-render dengan sempurna
            setTimeout(function() {
                // Tambahkan class untuk styling khusus cetak
                document.body.classList.add('printing');
                
                // Cetak halaman
                window.print();
                
                // Hapus class setelah selesai mencetak
                setTimeout(function() {
                    document.body.classList.remove('printing');
                }, 1000);
            }, 500);
        }

        // Tambahkan event listener untuk event beforeprint
        window.addEventListener('beforeprint', function() {
            // Pastikan grafik dirender dengan ukuran yang tepat untuk cetak
            if (window.myChart) {
                window.myChart.resize();
            }
        });
    </script>
</body>
</html>




