<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-semibold mb-2">Aktivitas Terbaru</h3>
    <ul class="space-y-2">
        @forelse ($activities as $activity)
            <li class="text-gray-700 text-sm">• {{ $activity }}</li>
        @empty
            <li class="text-gray-500 text-sm italic">Belum ada aktivitas terbaru.</li>
        @endforelse
    </ul>
</div>
