
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  {{-- <title>TravelKita - Login</title> --}}
 <title>@yield('title', 'TravelKita')</title>
    
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/media/user/LOGONEW.png') }}">
    


  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    body {
      overflow: hidden;
    }
    
    .bg-image {
      background-size: cover;
      background-position: center;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      transition: opacity 1.5s ease-in-out;
      opacity: 0;
    }
    
    .bg-image.active {
      opacity: 1;
    }
    
    .overlay {
      background: linear-gradient(to right, rgba(0,0,0,0.4), rgba(0,0,0,0.1));
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }
    
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 24px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    .form-input {
      transition: all 0.2s ease;
      border: 1px solid #e5e7eb;
      background-color: #f9fafb;
      border-radius: 12px;
    }
    
    .form-input:focus {
      border-color: #0ea5e9;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
    }
    
    .login-btn {
      background: linear-gradient(to right, #0ea5e9, #0284c7);
      transition: all 0.3s ease;
      border-radius: 12px;
    }
    
    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
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
          Jelajahi Keindahan Jawa Tengah
        </h2>
        <p class="text-xl text-white text-opacity-90 mb-8" id="slideDescription">
          Temukan destinasi wisata terbaik dan petualangan tak terlupakan bersama TravelKita
        </p>
        
        <!-- Indicators -->
        <div class="flex space-x-2 pt-4" id="indicators"></div>
      </div>
    </div>
    
    <!-- Right side: Login form -->
    <div class="w-full md:w-5/12 lg:w-4/12 xl:w-3/12 ml-auto">
      <div class="login-card p-8 animate-fadeIn">
        <!-- Mobile logo -->
        <div class="md:hidden mb-8 flex justify-center">
          <div class="bg-primary-500 rounded-xl p-3">
            <h1 class="text-white text-xl font-bold">Travel<span class="text-primary-200">Kita</span></h1>
          </div>
        </div>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-2 animate-fadeIn delay-100">Selamat Datang</h2>
        <p class="text-gray-500 mb-6 animate-fadeIn delay-200">Masuk untuk melanjutkan petualanganmu</p>
        
        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-lg text-sm animate-fadeIn delay-100">
          {{ $errors->first() }}
        </div>
        @endif

        @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md animate-fadeIn delay-100">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-green-700 text-sm">{{ session('success') }}</p>
            </div>
        </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
          @csrf
          
          <div class="animate-fadeIn delay-200">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
              </div>
              <input 
                id="email"
                type="email" 
                name="email" 
                placeholder="nama@email.com" 
                class="form-input w-full pl-10 pr-4 py-3 focus:outline-none" 
                required
              >
            </div>
          </div>
          
          <div class="animate-fadeIn delay-300">
            <div class="flex items-center justify-between mb-1">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <a href="{{ route('password.request') }}" class="text-xs text-primary-600 hover:text-primary-500">
                Lupa password?
              </a>
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
              </div>
              <input 
                id="password"
                type="password" 
                name="password" 
                placeholder="••••••••" 
                class="form-input w-full pl-10 pr-4 py-3 focus:outline-none" 
                required
              >
            </div>
          </div>
          
          <div class="flex items-center animate-fadeIn delay-400">
            <input 
              type="checkbox" 
              id="remember_me" 
              name="remember" 
              class="h-4 w-4 text-primary-600 rounded border-gray-300 focus:ring-primary-500"
            >
            <label for="remember_me" class="ml-2 text-sm text-gray-600">
              Ingat saya
            </label>
          </div>
          
          <button 
            type="submit" 
            class="login-btn w-full py-3 px-4 text-white font-medium animate-fadeIn delay-500"
          >
            Masuk
          </button>
        </form>
        
        <div class="mt-6 text-center animate-fadeIn delay-500">
          <p class="text-sm text-gray-500">
            Belum punya akun? 
            <a href="/register" class="text-primary-600 font-medium hover:text-primary-500">
              Daftar sekarang
            </a>
          </p>
        </div>
      </div>
      
      <div class="text-center mt-4">
        <div class="text-xs text-white text-opacity-70">
          &copy; 2023 TravelKita. All rights reserved.
        </div>
      </div>
    </div>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
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



