<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">{{ $title }}</h3>
    <canvas id="{{ $chartId }}" width="400" height="200"></canvas>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // ganti sesuai kebutuhan
        data: {
            labels: ['A', 'B', 'C', 'D'],
            datasets: [{
                label: 'Contoh Data',
                data: [10, 20, 30, 40],
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
