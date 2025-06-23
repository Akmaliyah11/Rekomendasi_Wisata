<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Admin Dashboard - TravelKita</title> --}}
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>@yield('title', 'TravelKita')</title>
    
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/media/user/LOGONEW.png') }}">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js via CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        
        .sidebar-link.active {
            background-color: rgba(79, 70, 229, 0.6);
            color: white;
        }
        
        .sidebar-link:hover {
            background-color: rgba(79, 70, 229, 0.4);
            color: white;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Stat Card Styles */
        .stat-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border: 1px solid #f3f4f6;
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        /* Fixed Sidebar */
        .sidebar-fixed {
            position: fixed;
            height: 100vh;
            z-index: 40;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        
        /* Main content with sidebar */
        .main-with-sidebar {
            transition: margin-left 0.3s ease;
        }
        
        /* Mobile overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div x-data="{ sidebarOpen: true }">
        <!-- Sidebar Overlay (Mobile) -->
        <div 
            @click="sidebarOpen = false" 
            class="sidebar-overlay md:hidden" 
            :class="{'active': sidebarOpen}">
        </div>
        
        <!-- Sidebar -->
        <aside 
            class="sidebar-fixed bg-indigo-900 text-white transition-all duration-300 flex flex-col"
            :class="{'w-64': sidebarOpen, 'w-20': !sidebarOpen, '-translate-x-full md:translate-x-0': !sidebarOpen && window.innerWidth < 768}">
            
            <!-- Logo and Toggle -->
            <div class="flex items-center justify-between p-4 border-b border-indigo-800">
                <a href="{{ route('datawisata.dashboard') }}" class="flex items-center gap-3">
                    <div class="bg-white rounded-lg p-1.5">
                        <img src="{{ asset('front/assets/media/user/LOGONEW.png') }}" alt="Logo" class="h-8 w-8">
                    </div>
                    <span x-show="sidebarOpen" class="font-bold text-xl transition-opacity">TravelKita</span>
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-300 hover:text-white">
                    <i x-show="sidebarOpen" class="fas fa-chevron-left"></i>
                    <i x-show="!sidebarOpen" class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <!-- Admin Info -->
            <div class="p-4 border-b border-indigo-800">
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-700 rounded-full h-10 w-10 flex items-center justify-center text-white font-semibold">
                        @auth
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @else
                            A
                        @endauth
                    </div>
                    <div x-show="sidebarOpen" class="transition-opacity">
                        <div class="font-medium text-white">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Admin
                            @endauth
                        </div>
                        <div class="text-xs text-indigo-200">Administrator</div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-2">
                <a href="{{ route('datawisata.dashboard') }}" class="sidebar-link mb-1 {{ request()->routeIs('datawisata.dashboard') ? 'active' : '' }}" :class="{'justify-center': !sidebarOpen}">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span x-show="sidebarOpen">Dashboard</span>
                </a>
                
                <a href="{{ route('kategoriwisata.index') }}" class="sidebar-link mb-1 {{ request()->routeIs('kategoriwisata.*') ? 'active' : '' }}" :class="{'justify-center': !sidebarOpen}">
                    <i class="fas fa-tags w-5 text-center"></i>
                    <span x-show="sidebarOpen">Kategori Wisata</span>
                </a>
                
                <a href="{{ route('datawisata.index') }}" class="sidebar-link mb-1 {{ request()->routeIs('datawisata.index') || request()->routeIs('datawisata.create') || request()->routeIs('datawisata.edit') ? 'active' : '' }}" :class="{'justify-center': !sidebarOpen}">
                    <i class="fas fa-map-marked-alt w-5 text-center"></i>
                    <span x-show="sidebarOpen">Data Wisata</span>
                </a>
                
                <div class="border-t border-indigo-800 my-4"></div>
                
                <a href="{{ route('home') }}" class="sidebar-link mb-1" :class="{'justify-center': !sidebarOpen}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span x-show="sidebarOpen">Kembali ke User</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="sidebar-link w-full text-left" :class="{'justify-center': !sidebarOpen}">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span x-show="sidebarOpen">Logout</span>
                    </button>
                </form>
            </nav>
            
            <!-- Footer -->
            <div class="p-4 border-t border-indigo-800 text-xs text-indigo-400">
                <div x-show="sidebarOpen">
                    &copy; {{ date('Y') }} TravelKita Admin
                </div>
                <div x-show="!sidebarOpen" class="text-center">
                    &copy;
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-with-sidebar" :class="{'ml-0 md:ml-64': sidebarOpen, 'ml-0 md:ml-20': !sidebarOpen}">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="flex items-center justify-between px-4 md:px-6 py-4">
                    <div class="flex items-center">
                        <!-- Mobile menu toggle -->
                        <button @click="sidebarOpen = !sidebarOpen" class="mr-4 text-gray-500 hover:text-gray-700 md:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-gray-800">@yield('title', 'Admin Dashboard')</h1>
                            <p class="text-sm text-gray-500">@yield('subtitle', 'Manage your travel destinations')</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <button class="text-gray-500 hover:text-gray-700 relative">
                            <i class="fas fa-bell"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </button>
                        
                        <!-- User dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                                <div class="bg-indigo-100 rounded-full h-8 w-8 flex items-center justify-center text-indigo-700">
                                    @auth
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    @else
                                        A
                                    @endauth
                                </div>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="p-4 md:p-6">
                @yield('content')
            </div>
        </main>
    </div>
    
    <script>
        // Check screen size on page load and resize
        window.addEventListener('DOMContentLoaded', function() {
            const mediaQuery = window.matchMedia('(max-width: 768px)');
            
            function handleScreenChange(e) {
                if (e.matches) {
                    // Mobile view - close sidebar by default
                    Alpine.store('sidebar', { open: false });
                }
            }
            
            // Initial check
            handleScreenChange(mediaQuery);
            
            // Add listener for changes
            mediaQuery.addEventListener('change', handleScreenChange);
        });
    </script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
