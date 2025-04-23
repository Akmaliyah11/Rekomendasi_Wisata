<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Rekomendasi Destinasi Wisata berdasarkan preferensi dan ulasan pengguna. Temukan destinasi impianmu!">

    <title>@yield('title', 'Rekomendasi Wisata')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/media/user/iconwisata.jpg') }}">

    <!-- All CSS files -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/smoothScorllbar.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/classic.date.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/app.css') }}">
</head>

<body class="x-hidden">
    <!-- PRELOADER START -->
    <div id="preloader">
        <div class="spinner"></div>
        <div id="content"></div>
    </div>
    <!-- PRELOADER END -->

    <!-- HEADER MENU START -->
    @include('partials.header')
    <!-- HEADER MENU END -->

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER START -->
    @include('partials.footer')
    <!-- FOOTER END -->
    <button class="scrollToTopBtn"><i class="fa fa-arrow-up"></i></button>

    <!-- Mobile Menu Start -->
    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="{{ url('/') }}" aria-label="logo image"><img src="{{ asset('front/assets/media/user/logo.png')}}" alt="Logo Wisata"></a>
            </div>
            <div class="mobile-nav__container"></div>
            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:info@rekomendasipiknik.com">info@rekomendasipiknik.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:+628123456789">+62 812-3456-789</a>
                </li>
            </ul>
            <div class="mobile-nav__social">
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- All JS files -->
    <script src="{{ asset('front/assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/vendor/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('front/assets/js/vendor/picker.js') }}"></script>
    <script src="{{ asset('front/assets/js/vendor/picker.date.js') }}"></script>
    <script src="{{ asset('front/assets/js/date.js') }}"></script>
    <script src="{{ asset('front/assets/js/app.js') }}"></script>
</body>
</html>
