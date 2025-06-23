<div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-2xl font-bold text-{{ $color }}-600">{{ $value }}</p>
        </div>
        <div class="text-{{ $color }}-600">
            <i class="fas {{ $icon }} text-2xl"></i>
        </div>
    </div>
</div>
