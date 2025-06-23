<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Register - TravelKita</title> --}}
    <title>@yield('title', 'TravelKita')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/media/user/LOGONEW.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease;
            z-index: 1;
        }
        
        .bg-image.active {
            opacity: 1;
            z-index: 2;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
            z-index: 3;
        }
        
        .register-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .form-input {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }
        
        .register-btn {
            background: linear-gradient(to right, #0ea5e9, #0284c7);
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
        }
        
        .back-btn {
            background: linear-gradient(to right, #64748b, #475569);
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(71, 85, 105, 0.2);
        }
        
        .indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.4);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .indicator.active {
            width: 24px;
            border-radius: 12px;
            background-color: white;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        
        .progress-bar {
            position: relative;
            height: 4px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
            margin: 20px 0;
        }
        
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #0ea5e9;
            transition: width 0.3s ease;
        }
        
        .progress-bar.step-1::after {
            width: 33.33%;
        }
        
        .progress-bar.step-2::after {
            width: 66.66%;
        }
        
        .progress-bar.step-3::after {
            width: 100%;
        }
    </style>
</head>
<body class="h-full">
    <!-- Full screen background -->
    <div class="fixed inset-0">
        <div id="bgContainer" class="h-full w-full">
            <div class="bg-image active" style="background-image: url('{{ asset('Css/Image/1.png') }}');"></div>
            <div class="bg-image" style="background-image: url('{{ asset('Css/Image/3.png') }}');"></div>
            <div class="bg-image" style="background-image: url('{{ asset('Css/Image/2.png') }}');"></div>
            <div class="bg-image" style="background-image: url('{{ asset('Css/Image/4.png') }}');"></div>
            <div class="bg-image" style="background-image: url('{{ asset('Css/Image/5.png') }}');"></div>
            <div class="overlay"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="relative h-full flex items-center justify-between z-10 px-6 lg:px-12">
        <!-- Left side: Content -->
        <div class="hidden md:block md:w-1/2 text-white p-8">
            <div class="max-w-xl">
                <div class="mb-8">
                    <div class="inline-block bg-white bg-opacity-20 backdrop-blur-md rounded-xl p-3">
                        <h1 class="text-white text-2xl font-bold">Travel<span class="text-primary-400">Kita</span></h1>
                    </div>
                </div>
                
                <h2 class="text-5xl font-bold leading-tight mb-6" id="slideTitle">
                    Bergabunglah dengan TravelKita
                </h2>
                <p class="text-xl text-white text-opacity-90 mb-8" id="slideDescription">
                    Daftar sekarang dan mulai petualangan tak terlupakan di seluruh Indonesia
                </p>
                
                <!-- Indicators -->
                <div class="flex space-x-2 pt-4" id="indicators"></div>
            </div>
        </div>
        
        <!-- Right side: Register form -->
        <div class="w-full md:w-5/12 lg:w-4/12 xl:w-3/12 ml-auto my-8">
            <div class="register-card p-8 animate-fadeIn">
                <!-- Mobile logo -->
                <div class="md:hidden mb-6 flex justify-center">
                    <div class="bg-primary-500 rounded-xl p-3">
                        <h1 class="text-white text-xl font-bold">Travel<span class="text-primary-200">Kita</span></h1>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-800 mb-1 animate-fadeIn delay-100">Buat Akun Baru</h2>
                <p class="text-gray-500 mb-4 text-sm animate-fadeIn delay-200">Bergabunglah dengan TravelKita</p>
                
                @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-lg text-xs animate-fadeIn delay-100">
                    {{ $errors->first() }}
                </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <div id="step1" class="space-y-3">
                        <!-- NAME -->
                        <div class="animate-fadeIn delay-200">
                            <label for="name" class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input 
                                    id="name"
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    placeholder="Nama lengkap Anda" 
                                    class="form-input w-full pl-10 pr-4 py-2.5 text-sm focus:outline-none" 
                                    required
                                    autofocus
                                >
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600" />
                        </div>
                        
                        <!-- EMAIL -->
                        <div class="animate-fadeIn delay-300">
                            <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input 
                                    id="email"
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    placeholder="nama@email.com" 
                                    class="form-input w-full pl-10 pr-4 py-2.5 text-sm focus:outline-none" 
                                    required
                                >
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
                        </div>
                        
                        <!-- PASSWORD -->
                        <div class="animate-fadeIn delay-400">
                            <label for="password" class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input 
                                    id="password"
                                    type="password" 
                                    name="password" 
                                    placeholder="••••••••" 
                                    class="form-input w-full pl-10 pr-10 py-2.5 text-sm focus:outline-none" 
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
                        </div>
                        
                        <!-- CONFIRM PASSWORD -->
                        <div class="animate-fadeIn delay-500">
                            <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input 
                                    id="password_confirmation"
                                    type="password" 
                                    name="password_confirmation" 
                                    placeholder="••••••••" 
                                    class="form-input w-full pl-10 pr-4 py-2.5 text-sm focus:outline-none" 
                                    required
                                >
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600" />
                        </div>
                        
                        <button 
                            type="submit" 
                            class="register-btn w-full py-2.5 px-4 text-white text-sm font-medium animate-fadeIn delay-500 mt-2"
                        >
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
                
                <div class="mt-4 text-center animate-fadeIn delay-500">
                    <p class="text-xs text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-primary-600 font-medium hover:text-primary-500">
                            Masuk sekarang
                        </a>
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <div class="text-xs text-white text-opacity-70">
                    &copy; 2023 TravelKita. All rights reserved.
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }
            
            // Slide content data
            const slideData = [
                {
                title: "Jelajahi Keindahan Jawa Tengah",
                description: "Temukan destinasi wisata terbaik dan petualangan tak terlupakan bersama TravelKita"
                },
                {
                title: "Pesona Dieng Plateau",
                description: "Nikmati keindahan Candi Arjuna dan Telaga Warna dengan pemandangan yang memukau"
                },
                {
                title: "Keajaiban Borobudur",
                description: "Kunjungi candi Buddha terbesar di dunia dengan arsitektur yang menakjubkan"
                },
                {
                title: "Keindahan Pantai Karimunjawa",
                description: "Jelajahi surga tersembunyi dengan pantai berpasir putih dan terumbu karang yang memesona"
                }
            ];
            
            const backgrounds = document.querySelectorAll('.bg-image');
            const slideTitle = document.getElementById('slideTitle');
            const slideDescription = document.getElementById('slideDescription');
            const indicatorsContainer = document.getElementById('indicators');
            
            let currentSlide = 0;
            
            // Create indicators
            backgrounds.forEach((_, index) => {
                const indicator = document.createElement('div');
                indicator.classList.add('indicator');
                if (index === 0) indicator.classList.add('active');
                indicator.addEventListener('click', () => goToSlide(index));
                indicatorsContainer.appendChild(indicator);
            });
            
            // Function to go to a specific slide
            function goToSlide(index) {
                // Hide current slide
                backgrounds[currentSlide].classList.remove('active');
                document.querySelectorAll('.indicator')[currentSlide].classList.remove('active');
                
                // Show new slide
                currentSlide = index;
                backgrounds[currentSlide].classList.add('active');
                document.querySelectorAll('.indicator')[currentSlide].classList.add('active');
                
                // Update text
                if (slideTitle && slideDescription) {
                    slideTitle.textContent = slideData[currentSlide].title;
                    slideDescription.textContent = slideData[currentSlide].description;
                }
            }
            
            // Auto slide
            function nextSlide() {
                goToSlide((currentSlide + 1) % backgrounds.length);
            }
            
            // Start auto sliding
            const slideInterval = setInterval(nextSlide, 6000);
        });
    </script>
</body>
</html>






