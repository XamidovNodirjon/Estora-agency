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
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        body {
            overflow-x: hidden;
        }
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
    </style>
</head>
<body class="font-montserrat">
    <div class="hero-section">
        <header class="header-container bg-white shadow-md">
            <div class="top-bar hidden md:flex justify-between items-center px-4 py-2 md:px-8 lg:px-16 border-b">
                <div class="social-icons flex gap-4">
                    <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fab fa-telegram-plane"></i></a>
                    <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fab fa-youtube"></i></a>
                </div>
                <div class="contact-info flex items-center gap-4 text-gray-600">
                    <div class="contact-item flex items-center gap-2">
                        <i class="fas fa-envelope text-yellow-600"></i>
                        <a href="mailto:info@estora.uz" class="hover:text-yellow-600 text-sm">info@estora.uz</a>
                    </div>
                    <div class="contact-item flex items-center gap-2">
                        <i class="fas fa-phone-alt text-yellow-600"></i>
                        <a href="tel:+998951606446" class="hover:text-yellow-600 text-sm">+998 (95) 160 64 46</a>
                    </div>
                </div>
            </div>

            <div class="main-header flex justify-between items-center px-4 py-4 md:px-8 lg:px-16">
                <div class="flex items-center gap-4">
                    <button id="mobile-menu-toggle" class="mobile-menu-toggle text-gray-600 hover:text-gray-800 md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="/" class="logo-container">
                        <img src="/logo/logo-dashboard.png" alt="Estora Logo" class="h-8 md:h-10">
                    </a>
                </div>

                <nav class="desktop-nav hidden md:flex space-x-6">
                    <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Ijara</a>
                    <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Sotib olish</a>
                    <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">NoBroker</a>
                    <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Expats</a>
                    <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Business Space</a>
                </nav>

                <div class="header-actions flex items-center gap-2 md:gap-4 lg:gap-6">
                    <a href="#" class="action-item hidden md:flex items-center gap-2 text-gray-600 hover:text-yellow-600">
                        <i class="fas fa-heart"></i>
                        <span class="hidden lg:inline">Favourites</span>
                    </a>
                    <div class="currency-selector relative">
                        <div class="action-item flex items-center gap-1 text-gray-600 hover:text-yellow-600 cursor-pointer">
                            <span class="font-medium">UZS</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <div class="currency-menu absolute right-0 mt-2 w-16 bg-white shadow-lg rounded hidden z-50">
                            <a href="#" class="currency-option block px-2 py-1 text-gray-700 hover:bg-gray-100">USD</a>
                            <a href="#" class="currency-option block px-2 py-1 text-gray-700 hover:bg-gray-100">RUB</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('login.index') }}" class="user-action hidden md:flex items-center gap-2 text-gray-600 hover:text-yellow-600">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span>Login</span>
                    </a>

                    <div class="language-selector relative">
                        <div class="language-btn flex items-center gap-1 text-gray-600 hover:text-yellow-600 cursor-pointer">
                            <span class="flag-icon flag-icon-{{ app()->getLocale() === 'en' ? 'gb' : app()->getLocale() }}"></span>
                            <span class="hidden md:inline">{{ strtoupper(app()->getLocale()) }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <div class="language-menu absolute right-0 mt-2 w-28 bg-white shadow-lg rounded hidden z-50">
                            <a href="{{ route('lang.switch', 'uz') }}" class="language-option flex items-center gap-2 px-2 py-1 text-gray-700 hover:bg-gray-100">
                                <span class="flag-icon flag-icon-uz"></span>
                                <span>O'zbek</span>
                            </a>
                            <a href="{{ route('lang.switch', 'ru') }}" class="language-option flex items-center gap-2 px-2 py-1 text-gray-700 hover:bg-gray-100">
                                <span class="flag-icon flag-icon-ru"></span>
                                <span>Русский</span>
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}" class="language-option flex items-center gap-2 px-2 py-1 text-gray-700 hover:bg-gray-100">
                                <span class="flag-icon flag-icon-gb"></span>
                                <span>English</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="mobile-menu" class="mobile-menu fixed inset-0 bg-white z-50 hidden md:hidden">
            <div class="mobile-menu-content h-full flex flex-col">
                <div class="mobile-menu-header p-4 border-b flex justify-between items-center">
                    <span class="text-xl font-bold">Menyu</span>
                    <button id="close-menu-toggle" class="close-menu-btn text-2xl">&times;</button>
                </div>
                <nav class="mobile-nav flex-1 p-4 overflow-y-auto">
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Bosh Sahifa</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Biz Haqimizda</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Yangiliklar</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Ijara</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Sotib olish</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">NoBroker</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Expats</a>
                    <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600 border-b">Business Space</a>
                </nav>
                <div class="mobile-actions p-4 border-t">
                    <h3 class="font-bold text-lg mb-2">Aloqa</h3>
                    <div class="mobile-action-item flex items-center gap-2 py-2 text-gray-700">
                        <i class="fas fa-phone-alt text-yellow-600"></i>
                        <a href="tel:+998951606446" class="hover:text-yellow-600">+998 (95) 160 64 46</a>
                    </div>
                    <div class="mobile-action-item flex items-center gap-2 py-2 text-gray-700">
                        <i class="fas fa-envelope text-yellow-600"></i>
                        <a href="mailto:info@estora.uz" class="hover:text-yellow-600">info@estora.uz</a>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <a href="#" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-yellow-600">
                        <i class="fas fa-heart text-yellow-600"></i>
                        <span>Favourites</span>
                    </a>
                    <a href="{{ route('login.index') }}" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-yellow-600">
                        <i class="fas fa-user-circle text-yellow-600"></i>
                        <span>Login</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="search-section py-8">
            <div class="container mx-auto px-4">
                <form action="{{ route('products.filter') }}" method="GET" class="search-card bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="input-group">
                        <label for="ad_type" class="block text-sm font-medium text-gray-700">{{ __("E'lon turi") }}</label>
                        <div class="relative">
                            <select id="ad_type" name="ad_type" class="block w-full p-2 border rounded">
                                <option value="">{{ __('Hammasi') }}</option>
                                <option value="sale" {{ $request->ad_type == 'sale' ? 'selected' : '' }}>{{ __('Sotish') }}</option>
                                <option value="rent" {{ $request->ad_type == 'rent' ? 'selected' : '' }}>{{ __('Ijaraga') }}</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-2 top-2 text-gray-400"></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="property_type" class="block text-sm font-medium text-gray-700">{{ __("Mulk turi") }}</label>
                        <div class="relative">
                            <select id="property_type" name="property_type" class="block w-full p-2 border rounded">
                                <option value="">{{ __('Hammasi') }}</option>
                                <option value="apartment" {{ $request->property_type == 'apartment' ? 'selected' : '' }}>{{ __('Kvartira') }}</option>
                                <option value="house" {{ $request->property_type == 'house' ? 'selected' : '' }}>{{ __('Uy/Hovli') }}</option>
                                <option value="land" {{ $request->property_type == 'land' ? 'selected' : '' }}>{{ __('Yer') }}</option>
                                <option value="commercial" {{ $request->property_type == 'commercial' ? 'selected' : '' }}>{{ __('Tijorat binosi') }}</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-2 top-2 text-gray-400"></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="region" class="block text-sm font-medium text-gray-700">{{ __("Hudud") }}</label>
                        <div class="relative">
                            <select id="region" name="region" class="block w-full p-2 border rounded">
                                <option value="">{{ __('Tanlang') }}</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ $request->region == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="bi bi-chevron-down absolute right-2 top-2 text-gray-400"></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="rooms" class="block text-sm font-medium text-gray-700">{{ __("Xonalar soni") }}</label>
                        <div class="relative">
                            <select id="rooms" name="rooms" class="block w-full p-2 border rounded">
                                <option value="">{{ __('Hammasi') }}</option>
                                <option value="1" {{ $request->rooms == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $request->rooms == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $request->rooms == '3' ? 'selected' : '' }}>3</option>
                                <option value="3+" {{ $request->rooms == '3+' ? 'selected' : '' }}>3+</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-2 top-2 text-gray-400"></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="floors" class="block text-sm font-medium text-gray-700">{{ __("Qavatlar soni") }}</label>
                        <div class="relative">
                            <select id="floors" name="floors" class="block w-full p-2 border rounded">
                                <option value="">{{ __('Hammasi') }}</option>
                                <option value="1" {{ $request->floors == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $request->floors == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $request->floors == '3' ? 'selected' : '' }}>3</option>
                                <option value="3+" {{ $request->floors == '3+' ? 'selected' : '' }}>3+</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-2 top-2 text-gray-400"></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="budget" class="block text-sm font-medium text-gray-700">{{ __("Byudjet") }}</label>
                        <input type="text" id="budget" name="budget" placeholder="{{ __('Min - Max (USD)') }}" value="{{ $request->budget ?? '' }}" class="w-full p-2 border rounded">
                    </div>

                    <div class="input-group col-span-1 md:col-span-2 lg:col-span-3 flex justify-center">
                        <button type="submit" class="search-button bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700 w-full md:w-auto mt-4 md:mt-0">
                            <i class="bi bi-search"></i> {{ __('Qidirish') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-blue-900 text-white py-2 px-4 flex items-center text-sm overflow-hidden">
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
    <div class="container mx-auto px-4 my-10">
        <div class="card-section flex flex-col md:flex-row justify-center items-center gap-4">
            <div class="w-full md:w-1/4 bg-blue-900 text-white rounded-xl shadow-lg p-6 text-center mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Sotuvdagi Uylar</h3>
                <p class="text-sm">Barcha e'lonlar</p>
                <span class="text-5xl font-bold mt-2">750</span>
            </div>
            <div class="w-full md:w-1/4 bg-blue-900 text-white rounded-xl shadow-lg p-6 text-center mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Arenda Uylar</h3>
                <p class="text-sm">Barcha e'lonlar</p>
                <span class="text-5xl font-bold mt-2">750</span>
            </div>
            <div class="w-full md:w-1/4 bg-blue-900 text-white rounded-xl shadow-lg p-6 text-center mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Xonadosh</h3>
                <p class="text-sm">Barcha e'lonlar</p>
                <span class="text-5xl font-bold mt-2">750</span>
            </div>
            <div class="w-full md:w-1/4 bg-blue-900 text-white rounded-xl shadow-lg p-6 text-center">
                <h3 class="text-xl font-bold mb-2">Business Space</h3>
                <p class="text-sm">Barcha e'lonlar</p>
                <span class="text-5xl font-bold mt-2">750</span>
            </div>
        </div>
    </div>
    <div class="relative bg-cover bg-center" style="background-image: url('/images/dashboard-images.jpg');">
        <div class="absolute inset-0 bg-white opacity-100"></div>
        <div class="container mx-auto px-4 py-16">
            <div class="flex flex-col md:flex-row items-center relative z-10">
                <div class="w-full md:w-auto flex justify-center md:justify-start md:mr-6 mb-6 md:mb-0">
                    <img src="{{asset('logo/contract.png')}}" alt="Partnership" class="max-w-xs w-full">
                </div>
                <div class="w-full text-center md:text-left text-black">
                    <h2 class="text-2xl md:text-4xl font-bold mb-4">HUQUQIY SHARTNOMA ASOSIDA HAMKORLIKNI BOSHLANG!</h2>
                    <p class="text-sm md:text-lg mb-6">
                        Bizning barcha xizmatlarimiz faqat rasmiy huquqiy shartnoma asosida taqdim etiladi.
                        Shartnomani onlayn tarzda imzolaganingizdan so'ng, siz bilan hamkorlik jarayoni
                        to'liq qonuniy kafolat ostida boshlanadi. Bu yondashuv mijozlarimiz manfaatlarini himoya qilish,
                        shaffoflik va ishonchni ta'minlash uchun joriy etilgan.
                    </p>
                    <button class="bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-yellow-600 transition duration-300 w-full md:w-auto">
                        <i class="fas fa-pencil-alt mr-2"></i> Rasmiy shartnoma asosida davom etish
                    </button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-bg text-white">
        <div class="bg-blue-900 text-white py-4 mt-10" style="background-color: #DEAD38;">
            <div class="container mx-auto px-4 text-center">
                <ul class="flex flex-wrap justify-center gap-4 md:gap-8">
                    <li><a href="#" class="hover:text-yellow-400 transition-colors">Biz haqimizda</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors">Xizmatlarimiz</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors">Yangiliklar</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors">Reklama</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors">Ommaviy oferta</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition-colors">FAQ</a></li>
                </ul>
            </div>
        </div>

        <div class="container mx-auto px-4 py-16">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-8 md:mb-0 md:w-1/3 text-center md:text-left">
                    <img src="{{ asset('logo/footer-logo.png') }}" alt="Estora Logo" class="mb-4 footer-logo mx-auto md:mx-0">
                    <p class="text-xs text-footer-primary mb-2">YTT "Estora", 2025 yy. Barcha huquqlar himoyalangan</p>
                    <p class="text-xs text-footer-primary">Saytdan foydalanish orqali **Foydalanuvchi shartnomasi** va **Shaxsiy ma'lumotlarni qayta ishlash siyosati** bilan rozilik bildirganingizni anglatadi.</p>
                </div>

                <div class="flex flex-col items-center text-center md:w-1/3 mb-8 md:mb-0">
                    <div class="flex items-center mb-4">
                        <span class="text-footer-primary text-xs mr-2">O'zbekiston bo'ylab barcha qo'ng'iroqlar bepul</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/phone-icon.png') }}" alt="Phone Icon" class="h-10 w-10 mr-2" style="color: white; background-color: transparent;">
                        <span class="text-xl md:text-2xl font-bold">+998 (95) 160 64 46</span>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <a href="https://www.instagram.com/estora.uz/?__pwa=1#" class="text-white hover:text-gray-200">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-200">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-200">
                            <i class="fab fa-youtube fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-200">
                            <i class="fab fa-telegram fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-200">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                        <a href="https://t.me/your_username" class="text-white hover:text-gray-200">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </div>

                <div class="w-full md:w-1/3 flex justify-center md:justify-end items-end">
                    <a href="#" class="flex items-center text-sm bg-blue-700 px-4 py-2 rounded-full">
                        <span class="mr-2">Savollaringiz bormi? Biz aloqadamiz.</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </a>
                </div>
            </div>

            <hr class="border-t border-gray-700 my-8">

            <div class="text-center text-xs text-footer-primary">
                © 2025 Estora — Barcha huquqlar himoyalangan. estora.uz saytida joylashtirilgan ma'lumotlardan foydalanish — jumladan, ularni namoyish etish, nusxa ko'chirish, ko'paytirish yoki tarqatish — faqatgina manbaga faol havola ko'rsatilgan taqdirda ruxsat etiladi.
            </div>
        </div>
    </footer>
    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const closeMenuToggle = document.getElementById('close-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const languageSelector = document.querySelector('.language-selector');
        const currencySelector = document.querySelector('.currency-selector');
        const languageMenu = document.querySelector('.language-menu');
        const currencyMenu = document.querySelector('.currency-menu');

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
        });

        closeMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });

        languageSelector.addEventListener('click', (e) => {
            e.stopPropagation();
            languageMenu.classList.toggle('hidden');
            currencyMenu.classList.add('hidden');
        });

        currencySelector.addEventListener('click', (e) => {
            e.stopPropagation();
            currencyMenu.classList.toggle('hidden');
            languageMenu.classList.add('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!languageSelector.contains(e.target) && !languageMenu.contains(e.target)) {
                languageMenu.classList.add('hidden');
            }
            if (!currencySelector.contains(e.target) && !currencyMenu.contains(e.target)) {
                currencyMenu.classList.add('hidden');
            }
        });
        document.addEventListener('click', (e) => {
        if (!languageSelector.contains(e.target) && !languageMenu.contains(e.target)) {
            languageMenu.classList.add('hidden');
        }
        if (!currencySelector.contains(e.target) && !currencyMenu.contains(e.target)) {
            currencyMenu.classList.add('hidden');
        }
    });

    </script>
    </body>
</html>