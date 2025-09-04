<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        @keyframes marquee {
            0%   { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .animate-marquee {
            display: inline-block;
            min-width: 100%;
            white-space: nowrap;
            animation: marquee 40s linear infinite;
        }

        .footer-bg {
            background-color: #0E2041;
        }
        
        .footer-top-bg {
            background-color: #DDAA37;
        }
        
        .text-footer-primary {
            color: #C1C8D4;
        }
        
        .footer-logo {
            max-width: 120px;
            height: auto;
        }

        /* Mobile optimizations */
        .hero-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 60vh;
        }

        .search-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        /* Mobile menu improvements */
        .mobile-menu {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.98);
        }

        /* Responsive text sizes */
        @media (max-width: 640px) {
            .hero-title {
                font-size: 1.5rem !important;
                line-height: 1.3;
            }
            
            .hero-subtitle {
                font-size: 0.9rem !important;
            }
            
            .card-title {
                font-size: 1rem !important;
            }
            
            .card-number {
                font-size: 2rem !important;
            }
            
            .section-title {
                font-size: 1.8rem !important;
                line-height: 1.3;
            }
        }

        /* Better touch targets */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }

        /* Improved form elements */
        select, input {
            min-height: 44px;
        }

        /* Social icons spacing */
        .social-icons a {
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-montserrat">
    <!-- Header -->
    <header class="header-container bg-white shadow-md">
        <!-- Top Bar - Hidden on small screens -->
        <div class="top-bar hidden md:flex justify-between items-center px-4 py-2 md:px-8 lg:px-16 border-b">
            <div class="social-icons flex gap-2">
                <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                    <i class="fab fa-telegram-plane"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <div class="contact-info flex items-center gap-4 text-gray-600 text-sm">
                <div class="contact-item flex items-center gap-2">
                    <i class="fas fa-envelope text-yellow-600"></i>
                    <a href="mailto:info@estora.uz" class="hover:text-yellow-600">info@estora.uz</a>
                </div>
                <div class="contact-item flex items-center gap-2">
                    <i class="fas fa-phone-alt text-yellow-600"></i>
                    <a href="tel:+998951606446" class="hover:text-yellow-600">+998 (95) 160 64 46</a>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="main-header flex justify-between items-center px-4 py-3 md:px-8 lg:px-16">
            <div class="flex items-center gap-3">
                <button id="mobile-menu-toggle" class="mobile-menu-toggle text-gray-600 hover:text-gray-800 md:hidden touch-target flex items-center justify-center">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="/" class="logo-container">
                    <img src="{{ asset('logo/logo-dashboard.png') }}" alt="Estora Logo" class="h-8 md:h-10">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav hidden lg:flex space-x-6">
                @guest
                <a href="#" class="nav-link text-gray-700 hover:text-yellow-600 py-2 px-1">Ijara</a>
                <a href="#" class="nav-link text-gray-700 hover:text-yellow-600 py-2 px-1">Sotib olish</a>
                <a href="#" class="nav-link text-gray-700 hover:text-yellow-600 py-2 px-1">NoBroker</a>
                <a href="#" class="nav-link text-gray-700 hover:text-yellow-600 py-2 px-1">Expats</a>
                <a href="#" class="nav-link text-gray-700 hover:text-yellow-600 py-2 px-1">Business Space</a>
                @endguest
                @auth
                <!-- Authenticated nav if needed -->
                @endauth
            </nav>

            <!-- Header Actions -->
            <div class="header-actions flex items-center gap-2 md:gap-4">
                <!-- Favourites - Hidden on mobile -->
                <div class="hidden md:flex action-item items-center gap-2 text-gray-600 hover:text-yellow-600 cursor-pointer touch-target">
                    <i class="fas fa-heart"></i>
                    <span class="hidden lg:inline">Favourites</span>
                </div>

                <!-- Currency Selector - Simplified on mobile -->
                <div class="currency-selector relative">
                    <div class="action-item flex items-center gap-1 text-gray-600 hover:text-yellow-600 cursor-pointer touch-target">
                        <span class="font-medium text-sm">UZS</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <div class="currency-menu absolute right-0 mt-2 w-16 bg-white shadow-lg rounded hidden z-50">
                        <a href="#" class="currency-option block px-3 py-2 text-gray-700 hover:bg-gray-100">USD</a>
                        <a href="#" class="currency-option block px-3 py-2 text-gray-700 hover:bg-gray-100">RUB</a>
                    </div>
                </div>

                <!-- User Action -->
                @guest
                <a href="{{ route('login.index') }}" class="user-action flex items-center gap-1 text-gray-600 hover:text-yellow-600 touch-target">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span class="hidden md:inline text-sm">Login</span>
                </a>
                @endguest
                @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-action flex items-center gap-1 text-gray-600 hover:text-yellow-600 touch-target">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                    <span class="hidden md:inline text-sm">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
                
                <!-- Language Selector -->
                <div class="language-selector relative">
                    <div class="language-btn flex items-center gap-1 text-gray-600 hover:text-yellow-600 cursor-pointer touch-target">
                        <span class="flag-icon flag-icon-{{ app()->getLocale() === 'en' ? 'gb' : app()->getLocale() }} w-4 h-3"></span>
                        <span class="text-sm">{{ strtoupper(app()->getLocale()) }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <div class="language-menu absolute right-0 mt-2 w-32 bg-white shadow-lg rounded hidden z-50">
                        <a href="{{ route('lang.switch', 'uz') }}" class="language-option flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100">
                            <span class="flag-icon flag-icon-uz w-4 h-3"></span>
                            <span>O'zbek</span>
                        </a>
                        <a href="{{ route('lang.switch', 'ru') }}" class="language-option flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100">
                            <span class="flag-icon flag-icon-ru w-4 h-3"></span>
                            <span>Русский</span>
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" class="language-option flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100">
                            <span class="flag-icon flag-icon-gb w-4 h-3"></span>
                            <span>English</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu fixed inset-0 bg-white z-50 hidden">
        <div class="mobile-menu-content h-full flex flex-col">
            <div class="mobile-menu-header flex justify-between items-center p-4 border-b">
                <img src="{{ asset('logo/logo-dashboard.png') }}" alt="Estora Logo" class="h-8">
                <button id="close-menu-toggle" class="close-menu-btn text-3xl text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">&times;</button>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="mobile-nav flex-1 p-4 overflow-y-auto">
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Bosh Sahifa</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Ijara</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Sotib olish</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">NoBroker</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Expats</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Business Space</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Biz Haqimizda</a>
                <a href="#" class="mobile-nav-link block py-3 text-gray-700 hover:text-yellow-600 border-b border-gray-100">Yangiliklar</a>
            </nav>
            
            <!-- Mobile Actions -->
            <div class="mobile-actions p-4 border-t bg-gray-50">
                @guest
                <a href="{{ route('login.index') }}" class="mobile-action-item flex items-center gap-3 py-3 text-gray-700 hover:text-yellow-600 touch-target">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span>Login</span>
                </a>
                @endguest
                @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mobile-action-item flex items-center gap-3 py-3 text-gray-700 hover:text-yellow-600 touch-target">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                    <span>Logout</span>
                </a>
                @endauth
                <a href="#" class="mobile-action-item flex items-center gap-3 py-3 text-gray-700 hover:text-yellow-600 touch-target">
                    <i class="fas fa-heart text-xl"></i>
                    <span>Favourites</span>
                </a>
                <div class="mobile-action-item flex items-center gap-3 py-3 text-gray-700">
                    <i class="fas fa-phone-alt text-xl text-yellow-600"></i>
                    <a href="tel:+998951606446" class="hover:text-yellow-600">+998 (95) 160 64 46</a>
                </div>
                <div class="mobile-action-item flex items-center gap-3 py-2 text-gray-700">
                    <i class="fas fa-envelope text-xl text-yellow-600"></i>
                    <a href="mailto:info@estora.uz" class="hover:text-yellow-600">info@estora.uz</a>
                </div>
                
                <!-- Social Icons for Mobile -->
                <div class="flex gap-4 mt-4 pt-4 border-t border-gray-200">
                    <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                        <i class="fab fa-telegram-plane text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 touch-target flex items-center justify-center">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section with Search -->
    <div class="hero-section">
        <div class="hero-section relative bg-cover bg-center" style="background-image: url('{{ asset('images/dashboard1.png') }}'); min-height: 100vh;">
            <div class="inset-0 bg-blue-900 bg-opacity-60"></div>
                <div class="container mx-auto px-4 text-center text-white mb-6 md:mb-8 relative z-10">
                 <!-- Title -->        
                    <h1 class="hero-title text-2xl md:text-4xl font-bold mb-2">Ko'chmas mulk bozorining yetakchisi</h1>
                    <p class="hero-subtitle text-sm md:text-lg opacity-90">Eng yaxshi takliflarni toping</p>
                </div>
                
                <form action="{{ route('products.filter') }}" method="GET" class="search-card p-4 md:p-6 rounded-lg shadow-lg max-w-5xl mx-auto">
                    <!-- Mobile: Single Column, Desktop: Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __("E'lon turi") }}</label>
                            <div class="relative">
                                <select id="ad_type" name="ad_type" class="block w-full p-3 border border-gray-300 rounded-lg bg-white">
                                    <option value="">{{ __('Hammasi') }}</option>
                                    <option value="sale" {{ $request->ad_type == 'sale' ? 'selected' : '' }}>{{ __('Sotish') }}</option>
                                    <option value="rent" {{ $request->ad_type == 'rent' ? 'selected' : '' }}>{{ __('Ijaraga') }}</option>
                                </select>
                                <i class="bi bi-chevron-down absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __("Mulk turi") }}</label>
                            <div class="relative">
                                <select id="property_type" name="property_type" class="block w-full p-3 border border-gray-300 rounded-lg bg-white">
                                    <option value="">{{ __('Hammasi') }}</option>
                                    <option value="apartment" {{ $request->property_type == 'apartment' ? 'selected' : '' }}>{{ __('Kvartira') }}</option>
                                    <option value="house" {{ $request->property_type == 'house' ? 'selected' : '' }}>{{ __('Uy/Hovli') }}</option>
                                    <option value="land" {{ $request->property_type == 'land' ? 'selected' : '' }}>{{ __('Yer') }}</option>
                                    <option value="commercial" {{ $request->property_type == 'commercial' ? 'selected' : '' }}>{{ __('Tijorat binosi') }}</option>
                                </select>
                                <i class="bi bi-chevron-down absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __("Hudud") }}</label>
                            <div class="relative">
                                <select id="region" name="region" class="block w-full p-3 border border-gray-300 rounded-lg bg-white">
                                    <option value="">{{ __('Tanlang') }}</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ $request->region == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="bi bi-chevron-down absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __("Xonalar soni") }}</label>
                            <div class="relative">
                                <select id="rooms" name="rooms" class="block w-full p-3 border border-gray-300 rounded-lg bg-white">
                                    <option value="">{{ __('Hammasi') }}</option>
                                    <option value="1" {{ $request->rooms == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $request->rooms == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $request->rooms == '3' ? 'selected' : '' }}>3</option>
                                    <option value="3+" {{ $request->rooms == '3+' ? 'selected' : '' }}>3+</option>
                                </select>
                                
                                <i class="bi bi-chevron-down absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __("Qavatlar soni") }}</label>
                            <div class="relative">
                                <select id="floors" name="floors" class="block w-full p-3 border border-gray-300 rounded-lg bg-white">
                                    <option value="">{{ __('Hammasi') }}</option>
                                    <option value="1" {{ $request->floors == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $request->floors == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $request->floors == '3' ? 'selected' : '' }}>3</option>
                                    <option value="3+" {{ $request->floors == '3+' ? 'selected' : '' }}>3+</option>
                                </select>
                                <i class="bi bi-chevron-down absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __("Byudjet") }}</label>
                            <input type="text" id="budget" name="budget" placeholder="{{ __('Min - Max (USD)') }}" value="{{ $request->budget ?? '' }}" class="w-full p-3 border border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="w-full md:w-auto bg-yellow-600 text-white px-8 py-3 rounded-lg hover:bg-yellow-700 font-medium transition duration-300 min-h-12">
                            <i class="bi bi-search mr-2"></i> {{ __('Qidirish') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- News Ticker -->
    <div class="bg-blue-900 text-white py-3 px-4 flex items-center text-sm overflow-hidden">
        <div class="animate-marquee">
            <span class="mr-16">Estora yangi imkoniyatlar taqdim etmoqda!</span>
            <span class="mr-16">-</span>
            <span class="mr-16">Yangi turar-joy loyihalari ishga tushirildi.</span>
            <span class="mr-16">-</span>
            <span class="mr-16">Xalqaro hamkorlik kengaymoqda.</span>
            <span class="mr-16">Estora yangi imkoniyatlar taqdim etmoqda!</span>
            <span class="mr-16">-</span>
            <span class="mr-16">Yangi turar-joy loyihalari ishga tushirildi.</span>
            <span class="mr-16">-</span>
            <span class="mr-16">Xalqaro hamkorlik kengaymoqda.</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="container mx-auto px-4 my-8 md:my-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-blue-900 text-white rounded-xl shadow-lg p-4 md:p-6 text-center">
                <h3 class="card-title text-lg md:text-xl font-bold mb-2">Sotuvdagi Uylar</h3>
                <p class="text-sm opacity-80">Barcha e'lonlar</p>
                <span class="card-number text-3xl md:text-5xl font-bold mt-2 block">750</span>
            </div>
            <div class="bg-blue-900 text-white rounded-xl shadow-lg p-4 md:p-6 text-center">
                <h3 class="card-title text-lg md:text-xl font-bold mb-2">Arenda Uylar</h3>
                <p class="text-sm opacity-80">Barcha e'lonlar</p>
                <span class="card-number text-3xl md:text-5xl font-bold mt-2 block">750</span>
            </div>
            <div class="bg-blue-900 text-white rounded-xl shadow-lg p-4 md:p-6 text-center">
                <h3 class="card-title text-lg md:text-xl font-bold mb-2">Xonadosh</h3>
                <p class="text-sm opacity-80">Barcha e'lonlar</p>
                <span class="card-number text-3xl md:text-5xl font-bold mt-2 block">750</span>
            </div>
            <div class="bg-blue-900 text-white rounded-xl shadow-lg p-4 md:p-6 text-center">
                <h3 class="card-title text-lg md:text-xl font-bold mb-2">Business Space</h3>
                <p class="text-sm opacity-80">Barcha e'lonlar</p>
                <span class="card-number text-3xl md:text-5xl font-bold mt-2 block">750</span>
            </div>
        </div>
    </div>

    <!-- Partnership Section -->
    <div class="relative bg-cover bg-center py-12 md:py-16" style="background-image: url('/images/dashboard-images.jpg');">
        <div class="absolute inset-0 bg-white opacity-100"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-12">
                <!-- Image - Hidden on mobile, shown on tablet+ -->
                <div class="hidden md:block md:w-1/3 lg:w-auto flex-shrink-0">
                    <img src="{{ asset('logo/contract.png') }}" alt="Partnership" class="max-w-full h-auto rounded-lg">
                </div>

                <!-- Content -->
                <div class="flex-1 text-left text-black text-center lg:text-left">
                    <h2 class="section-title text-2xl md:text-4xl font-bold mb-4 leading-tight">HUQUQIY SHARTNOMA ASOSIDA HAMKORLIKNI BOSHLANG!</h2>
                    <p class="text-base md:text-lg mb-6 leading-relaxed">
                        Bizning barcha xizmatlarimiz faqat rasmiy huquqiy shartnoma asosida taqdim etiladi.
                        Shartnomani onlayn tarzda imzolaganingizdan so'ng, siz bilan hamkorlik jarayoni
                        to'liq qonuniy kafolat ostida boshlanadi. Bu yondashuv mijozlarimiz manfaatlarini himoya qilish,
                        shaffoflik va ishonchni ta'minlash uchun joriy etilgan.
                    </p>
                    <button class="w-full md:w-auto bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-yellow-600 transition duration-300 min-h-12">
                        <i class="fas fa-pencil-alt mr-2"></i> Rasmiy shartnoma asosida davom etish
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-bg text-white">
        <!-- Footer Top Links -->
        <div class="bg-blue-900 text-white py-4 mt-10" style="background-color: #DEAD38;">
            <div class="container mx-auto px-4">
                <ul class="flex flex-wrap justify-center gap-4 md:gap-8 text-center">
                    <li><a href="#" class="hover:text-yellow-400 transition-colors py-2 px-1 block">Biz haqimizda</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors py-2 px-1 block">Xizmatlarimiz</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors py-2 px-1 block">Yangiliklar</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors py-2 px-1 block">Reklama</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors py-2 px-1 block">Ommaviy oferta</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors py-2 px-1 block">FAQ</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="container mx-auto px-4 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- Logo and Description -->
                <div class="text-center md:text-left">
                    <img src="{{ asset('logo/footer-logo.png') }}" alt="Estora Logo" class="mb-4 footer-logo mx-auto md:mx-0">
                    <p class="text-xs text-footer-primary mb-2">YTT "Estora", 2025 yy. Barcha huquqlar himoyalangan</p>
                    <p class="text-xs text-footer-primary">Saytdan foydalanish orqali **Foydalanuvchi shartnomasi** va **Shaxsiy ma'lumotlarni qayta ishlash siyosati** bilan rozilik bildirganingizni anglatadi.</p>
                </div>
                
                <!-- Contact Info -->
                <div class="text-center">
                    <div class="mb-4">
                        <span class="text-footer-primary text-xs">O'zbekiston bo'ylab barcha qo'ng'iroqlar bepul</span>
                    </div>
                    <div class="flex items-center justify-center mb-4">
                        <img src="{{ asset('images/phone-icon.png') }}" alt="Phone Icon" class="h-10 w-10 mr-2">
                        <span class="text-xl md:text-2xl font-bold">+998 (95) 160 64-46</span>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="flex justify-center gap-3 mb-4">
                       <a href="https://www.instagram.com/estora.uz/?__pwa=1#" class="text-white hover:text-gray-300 touch-target flex items-center justify-center">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-300 touch-target flex items-center justify-center">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-300 touch-target flex items-center justify-center">
                            <i class="fab fa-youtube fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-300 touch-target flex items-center justify-center">
                            <i class="fab fa-telegram fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-300 touch-target flex items-center justify-center">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-300 touch-target flex items-center justify-center">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Button -->
                <div class="text-center md:text-right">
                    <a href="#" class="inline-flex items-center text-sm bg-blue-700 px-4 py-3 rounded-full hover:bg-blue-600 transition duration-300 touch-target">
                        <span class="mr-2">Savollaringiz bormi? Biz aloqadamiz.</span>
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </a>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <hr class="border-t border-gray-700 my-8">
            
            <div class="text-center text-xs text-footer-primary leading-relaxed">
                © 2025 Estora — Barcha huquqlar himoyalangan. estora.uz saytida joylashtirilgan ma'lumotlardan foydalanish — jumladan, ularni namoyish etish, nusxa ko'chirish, ko'paytirish yoki tarqatish — faqatgina manbaga faol havola ko'rsatilgan taqdirda ruxsat etiladi.
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const closeMenuToggle = document.getElementById('close-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const languageSelector = document.querySelector('.language-selector');
        const currencySelector = document.querySelector('.currency-selector');

        // Mobile menu toggle
        mobileMenuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        });

        closeMenuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        });

        // Close mobile menu when clicking outside
        mobileMenu.addEventListener('click', (e) => {
            if (e.target === mobileMenu) {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });

        // Dropdown functionality
        document.addEventListener('click', (e) => {
            // Close language dropdown if clicked outside
            if (languageSelector && !languageSelector.contains(e.target)) {
                const languageMenu = document.querySelector('.language-menu');
                if (languageMenu) {
                    languageMenu.classList.add('hidden');
                }
            }
            
            // Close currency dropdown if clicked outside
            if (currencySelector && !currencySelector.contains(e.target)) {
                const currencyMenu = document.querySelector('.currency-menu');
                if (currencyMenu) {
                    currencyMenu.classList.add('hidden');
                }
            }
        });

        // Language selector toggle
        if (languageSelector) {
            languageSelector.addEventListener('click', (e) => {
                e.stopPropagation();
                const languageMenu = document.querySelector('.language-menu');
                if (languageMenu) {
                    languageMenu.classList.toggle('hidden');
                }
                // Close currency menu if open
                const currencyMenu = document.querySelector('.currency-menu');
                if (currencyMenu) {
                    currencyMenu.classList.add('hidden');
                }
            });
        }

        // Currency selector toggle
        if (currencySelector) {
            currencySelector.addEventListener('click', (e) => {
                e.stopPropagation();
                const currencyMenu = document.querySelector('.currency-menu');
                if (currencyMenu) {
                    currencyMenu.classList.toggle('hidden');
                }
                // Close language menu if open
                const languageMenu = document.querySelector('.language-menu');
                if (languageMenu) {
                    languageMenu.classList.add('hidden');
                }
            });
        }

        // Handle keyboard navigation for accessibility
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                // Close mobile menu
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                }
                
                // Close dropdowns
                const languageMenu = document.querySelector('.language-menu');
                const currencyMenu = document.querySelector('.currency-menu');
                if (languageMenu) languageMenu.classList.add('hidden');
                if (currencyMenu) currencyMenu.classList.add('hidden');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Add loading states to forms
        const searchForm = document.querySelector('form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Qidirilmoqda...';
                    submitButton.disabled = true;
                }
            });
        }

        // Optimize images for mobile
        function optimizeImages() {
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.loading = 'lazy';
                
                // Add error handling
                img.addEventListener('error', function() {
                    this.src = 'https://via.placeholder.com/400x300/f3f4f6/374151?text=Image+Not+Found';
                });
            });
        }

        // Initialize optimizations
        document.addEventListener('DOMContentLoaded', function() {
            optimizeImages();
            
            // Add touch feedback for interactive elements
            const touchElements = document.querySelectorAll('.touch-target');
            touchElements.forEach(element => {
                element.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.95)';
                });
                
                element.addEventListener('touchend', function() {
                    this.style.transform = '';
                });
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            // Close mobile menu on resize to larger screen
            if (window.innerWidth >= 768 && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    </script>
</body>
</html>