@extends('layouts.admin')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-6 mb-6 text-white shadow-lg">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome back, Admin!</h2>
                <p class="text-indigo-100">Here's what's happening with your destinations today.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('datawisata.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-indigo-700 rounded-lg font-medium shadow-sm hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Add New Destination
                </a>
            </div>
        </div>
    </div>
    
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Destinations -->
        <div class="stat-card group">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-blue-100 text-blue-600 mr-4 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fas fa-map-marked-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Destinations</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['destinasiCount'] ?? 0 }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm">
                    <span class="text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 12%
                    </span>
                    <span class="text-gray-500 ml-2">Since last month</span>
                </div>
            </div>
        </div>
        
        <!-- Total Users -->
        <div class="stat-card group">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-purple-100 text-purple-600 mr-4 group-hover:bg-purple-600 group-hover:text-white transition-all">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['usersCount'] ?? '0' }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm">
                    <span class="text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 8%
                    </span>
                    <span class="text-gray-500 ml-2">Since last month</span>
                </div>
            </div>
        </div>
        
        <!-- Average Rating -->
        <div class="stat-card group">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-amber-100 text-amber-600 mr-4 group-hover:bg-amber-600 group-hover:text-white transition-all">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Average Rating</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($stats['average_rating'], 1) }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm">
                    <span class="text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 3%
                    </span>
                    <span class="text-gray-500 ml-2">Since last month</span>
                </div>
            </div>
        </div>
        
        <!-- Total Categories -->
        <div class="stat-card group">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-green-100 text-green-600 mr-4 group-hover:bg-green-600 group-hover:text-white transition-all">
                    <i class="fas fa-tags text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Categories</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['kategoriCount'] ?? 0 }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm">
                    <span class="text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 5%
                    </span>
                    <span class="text-gray-500 ml-2">Since last month</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Top Destinations Chart -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Top 5 Popular Destinations</h3>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.destinations.print') }}" target="_blank" class="text-xs px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                        <i class="fas fa-print mr-1"></i> Print Report
                    </a>
                </div>
            </div>
            <div class="p-6">
                <canvas id="topDestinationsChart" height="300"></canvas>
            </div>
        </div>
        
        <!-- Categories Chart -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Popular Categories</h3>
            </div>
            <div class="p-6">
                <canvas id="categoriesChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Monthly Ratings Chart -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Average Rating Trend (Last 6 Months)</h3>
        </div>
        <div class="p-6">
            <canvas id="ratingsChart" height="100"></canvas>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Destinations Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Recent Destinations</h3>
                        <a href="{{ route('datawisata.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All</a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($destinations->take(5) as $destination)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $destination->image ?? 'https://via.placeholder.com/150' }}" alt="{{ $destination->nama }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $destination->nama }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $destination->kategori->nama ?? 'Uncategorized' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $destination->lokasi ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('datawisata.edit', $destination->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No destinations found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Activity Log -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">New destination added</p>
                            <p class="text-sm text-gray-500">Candi Borobudur was added by Admin</p>
                            <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                        </div>
                    </div>
                    
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Destination updated</p>
                            <p class="text-sm text-gray-500">Waduk Cacaban was updated by Admin</p>
                            <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                        </div>
                    </div>
                    
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">New user registered</p>
                            <p class="text-sm text-gray-500">akunuser joined TravelKita</p>
                            <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add CSS for stat-card -->
    <style>
        .stat-card {
            @apply bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300;
        }
    </style>
    
    <!-- Script untuk grafik -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart untuk Top Destinations
        const topDestinationsCtx = document.getElementById('topDestinationsChart').getContext('2d');
        new Chart(topDestinationsCtx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($topDestinations as $destination)
                        '{{ $destination->nama }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Number of Reviews',
                    data: [
                        @foreach($topDestinations as $destination)
                            {{ $destination->visitors }},
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
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Reviews'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Destination'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Reviews: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        });

        // Chart untuk Categories
        const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
        new Chart(categoriesCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($popularCategories as $category)
                        '{{ $category->nama }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($popularCategories as $category)
                            {{ $category->destinations_count }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} destinations`;
                            }
                        }
                    }
                }
            }
        });

        // Chart untuk Monthly Ratings
        const ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
        new Chart(ratingsCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthLabels) !!},
                datasets: [{
                    label: 'Average Rating',
                    data: {!! json_encode($ratingData) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 0,
                        max: 5,
                        title: {
                            display: true,
                            text: 'Rating (0-5)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Average Rating: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
