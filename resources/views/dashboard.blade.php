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

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .hero-bg {
                background-attachment: scroll;
                min-height: auto;
                padding: 2rem 0;
            }

            .search-form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .filter-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .filter-buttons {
                flex-direction: column;
                width: 100%;
            }

            .filter-buttons button {
                width: 100%;
            }

            .property-card {
                margin: 0 1rem;
            }

            .nav-gold {
                display: none;
            }

            .mobile-nav-toggle {
                display: block;
            }
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

        /* Custom colors from reference */
        .bg-primary-gold { background-color: #B28F3D; }
        .bg-secondary-gold { background-color: #DEAD38; }
        .bg-primary-blue { background-color: #003D7B; }
        .bg-secondary-blue { background-color: #0A2F5A; }
        .bg-accent-red { background-color: #A83335; }
        .bg-accent-green { background-color: #00A859; }

        .text-primary-gold { color: #B28F3D; }
        .text-secondary-gold { color: #DEAD38; }
        .text-primary-blue { color: #003D7B; }
        .text-secondary-blue { color: #0A2F5A; }

        .hero-bg {
            background: linear-gradient(rgba(0, 61, 123, 0.1), rgba(0, 61, 123, 0.1)), url('/images/dashboard1.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .search-tabs .tab-active {
            background-color: #003D7B;
            color: white;
        }

        .search-tabs .tab-inactive {
            background-color: transparent;
            color: #003D7B;
            border: 1px solid #003D7B;
        }

        .property-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .top-badge {
            background: linear-gradient(45deg, #B28F3D, #DEAD38);
            color: white;
            font-weight: bold;
            padding: 4px 12px;
            border-radius: 0 0 8px 0;
            font-size: 12px;
        }

        .price-badge {
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            color: white;
        }

        .price-yellow { background-color: #DEAD38; }
        .price-red { background-color: #A83335; }
        .price-green { background-color: #00A859; }

        .nav-gold {
            background-color: #B28F3D;
        }

        .test-mode-banner {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }
    </style>
</head>
<body class="font-montserrat">
<!-- Top Social Bar -->
<div class="bg-white border-b hidden md:block">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-2">
            <div class="flex items-center gap-4">
                <div class="social-icons flex gap-3">
                    <a href="#" class="text-secondary-gold hover:text-primary-gold"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-secondary-gold hover:text-primary-gold"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-secondary-gold hover:text-primary-gold"><i class="fab fa-telegram-plane"></i></a>
                    <a href="#" class="text-secondary-gold hover:text-primary-gold"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-secondary-gold hover:text-primary-gold"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="test-mode-banner px-4 py-1 rounded-full text-sm flex items-center gap-2">
                <i class="fas fa-exclamation-triangle"></i>
                <span>The site works in test mode</span>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-4 text-sm">
                    <i class="fas fa-comments text-secondary-gold"></i>
                    <span class="text-secondary-gold">English</span>
                    <i class="fas fa-chevron-down text-xs text-secondary-gold"></i>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-heart text-secondary-gold"></i>
                </div>
                <div class="flex items-center gap-2 text-secondary-gold">
                    <i class="fas fa-coins"></i>
                    <span>UZS</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3 md:py-4">
            <div class="flex items-center gap-4">
                <button id="mobile-menu-toggle" class="text-gray-600 hover:text-gray-800 md:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="/" class="logo-container">
                    <img src="/logo/logo-dashboard.png" alt="Estora Logo" class="h-8 md:h-10">
                </a>
            </div>

            <div class="flex items-center gap-2 md:gap-8">
                <button class="bg-secondary-gold text-white px-3 md:px-6 py-2 rounded-lg font-medium hover:bg-primary-gold transition-colors flex items-center gap-2 text-sm md:text-base">
                    <i class="fas fa-plus"></i>
                    <span class="hidden sm:inline">E'lon joylashtirish</span>
                    <span class="sm:hidden">E'lon</span>
                </button>

                <a href="{{route('login.index')}}" class="flex items-center gap-2 text-gray-700 hover:text-secondary-gold text-sm md:text-base">
                    <i class="fas fa-user-circle text-xl md:text-2xl"></i>
                    <span class="hidden sm:inline">Login</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Navigation Bar -->
<nav class="nav-gold text-white hidden md:block">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            <div class="flex items-center gap-8">
                <a href="#" class="hover:text-yellow-200 transition-colors">Ijara</a>
                <a href="#" class="hover:text-yellow-200 transition-colors">Sotib olish</a>
                <a href="#" class="hover:text-yellow-200 transition-colors">NoBroker</a>
                <a href="#" class="hover:text-yellow-200 transition-colors">Expats</a>
                <a href="#" class="hover:text-yellow-200 transition-colors">Business Space</a>
            </div>

            <div class="flex items-center gap-6 text-sm">
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:info@estora.uz">
                        <span>info@estora.uz</span>
                    </a>
                </div>

                <div class="flex items-center gap-2">
                    <i class="fas fa-phone"></i>
                    <a href="tel:+998951606446">
                        <span>+998 (95) 160 64 46</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-bg min-h-screen flex items-center py-8 md:py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto mt-2 px-2 md:px-0">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Search Tabs -->
                <div class="flex flex-row flex-nowrap overflow-x-auto bg-primary-blue" style="font-size: 14.5px">
                    <button class="tab flex-none text-white px-6 py-3 font-medium hover:text-yellow-300 focus:text-yellow-300">
                        Ijara
                    </button>
                    <button class="tab flex-none text-white px-6 py-3 font-medium hover:text-yellow-300 focus:text-yellow-300">
                        Sotuv
                    </button>
                    <button class="tab flex-none text-white px-6 py-3 font-medium hover:text-yellow-300 focus:text-yellow-300">
                        Xonadosh
                    </button>
                    <button class="tab flex-none text-white px-6 py-3 font-medium hover:text-yellow-300 focus:text-yellow-300">
                        Special
                    </button>
                </div>
                <!-- Search Form -->
                <div class="bg-white p-4 md:p-6">
                    <form action="{{ route('products.filter') }}" method="GET">
                        <!-- Filter Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4 mb-6">
                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Mulk turi</label>
                                <div class="relative">
                                    <select name="property_type" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        <option value="apartment" {{ $request->property_type == 'apartment' ? 'selected' : '' }}>Kvartira</option>
                                        <option value="house" {{ $request->property_type == 'house' ? 'selected' : '' }}>Uy/Hovli</option>
                                        <option value="land" {{ $request->property_type == 'land' ? 'selected' : '' }}>Yer</option>
                                        <option value="commercial" {{ $request->property_type == 'commercial' ? 'selected' : '' }}>Tijorat</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Viloyat</label>
                                <div class="relative">
                                    <select name="region" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ $request->region == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Tuman</label>
                                <div class="relative">
                                    <select name="city" id="city-select" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        @if($request->city)
                                            @foreach($cities->where('region_id', $request->region) as $city)
                                                <option value="{{ $city->id }}" {{ $request->city == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Ijara muddati</label>
                                <div class="relative">
                                    <select name="rental_period" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        <option value="daily">Kunlik</option>
                                        <option value="monthly">Oylik</option>
                                        <option value="yearly">Yillik</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Xonalar soni</label>
                                <div class="relative">
                                    <select name="rooms" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        <option value="1" {{ $request->rooms == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $request->rooms == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $request->rooms == '3' ? 'selected' : '' }}>3</option>
                                        <option value="3+" {{ $request->rooms == '3+' ? 'selected' : '' }}>3+</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Vositachilik haqqi</label>
                                <div class="relative">
                                    <select name="commission" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        <option value="with">Bor</option>
                                        <option value="without">Yo'q</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="filter-item">
                                <label class="block text-xs font-medium text-gray-500 mb-1">So'ngi e'lonlar</label>
                                <div class="relative">
                                    <select name="latest" class="w-full p-2 text-sm bg-transparent border-0 border-b-2 border-gray-300 focus:border-primary-blue focus:outline-none appearance-none">
                                        <option value="">Tanlang</option>
                                        <option value="today">Bugun</option>
                                        <option value="week">Bu hafta</option>
                                        <option value="month">Bu oy</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-0 top-2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col md:flex-row gap-3 justify-between items-center pt-3 border-t border-gray-200">
                            <button type="button" class="w-full md:w-auto bg-secondary-gold text-primary-blue px-5 py-2 rounded-lg font-medium hover:bg-primary-gold hover:text-white transition-colors flex items-center justify-center gap-2 text-sm shadow-md">
                                <i class="fas fa-sliders-h"></i>
                                Barcha Filtrlar
                            </button>

                            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                                <button type="button" class="w-full md:w-auto border-2 border-primary-blue text-primary-blue px-5 py-2 rounded-lg font-medium hover:bg-primary-blue hover:text-white transition-colors flex items-center justify-center gap-2 text-sm shadow-md">
                                    <i class="fas fa-map-marker-alt"></i>
                                    orqali qidirish
                                </button>

                                <button type="submit" class="w-full md:w-auto bg-primary-blue text-white px-6 py-2 rounded-lg font-medium hover:bg-secondary-blue transition-colors flex items-center justify-center gap-2 text-sm shadow-md">
                                    <i class="fas fa-search"></i>
                                    E'lonlarni ko'rish
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Marquee -->
<div class="bg-primary-blue text-white py-2 px-4 flex items-center text-xs md:text-sm overflow-hidden">
    <div class="animate-marquee">
        <span class="mr-16">Estora yangi imkoniyatlar taqdim etmoqda!</span>
        <span class="mr-16">-</span>
        <span class="mr-16">Yangi turar-joy loyihalari ishga tushirildi.</span>
        <span class="mr-16">-</span>
        <span class="mr-16">Xalqaro hamkorlik kengaymoqda</span>
    </div>
</div>

<!-- Best Offers Section -->
<section class="py-8 md:py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 md:mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-primary-blue mb-4">Eng yaxshi takliflar</h2>
            <p class="text-gray-600 text-sm md:text-base px-4">Siz uchun eng maqbul va samarali yechimlarni topishda ishonchli hamkoringiz bo'lamiz.</p>
        </div>

        <!-- Professional Carousel Container -->
        <div class="relative max-w-7xl mx-auto">
            <!-- Navigation Buttons -->
            <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white shadow-xl text-primary-blue w-12 h-12 rounded-full hover:bg-primary-blue hover:text-white transition-all duration-300 flex items-center justify-center border-2 border-primary-blue">
                <i class="fas fa-chevron-left text-lg"></i>
            </button>
            <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white shadow-xl text-primary-blue w-12 h-12 rounded-full hover:bg-primary-blue hover:text-white transition-all duration-300 flex items-center justify-center border-2 border-primary-blue">
                <i class="fas fa-chevron-right text-lg"></i>
            </button>

            <!-- Carousel Track -->
            <div class="overflow-hidden rounded-2xl">
                <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out">
                    @foreach($bestOffers as $index => $product)
                        <div class="w-full md:w-1/3 flex-shrink-0 px-3" data-index="{{ $index }}">
                            <div class="property-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden h-full">
                                <div class="relative">
                                    @php
                                        $images = $product->image_array ?? [];
                                    @endphp

                                    @if(!empty($images))
                                        <img src="{{ asset('storage/' . $images[0]) }}" alt="Property" class="w-full h-56 object-cover">
                                    @else
                                        <img src="https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Property" class="w-full h-56 object-cover">
                                @endif

                                <!-- TOP Badge -->
                                    <div class="absolute top-3 left-3 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                        <i class="fas fa-star mr-1"></i>TOP
                                    </div>

                                    <!-- Heart Button -->
                                    <button class="absolute top-3 right-3 bg-white bg-opacity-90 hover:bg-opacity-100 p-2 rounded-full transition-all duration-300 shadow-lg">
                                        <i class="fas fa-heart text-gray-400 hover:text-red-500 transition-colors"></i>
                                    </button>

                                    <!-- Price Badge -->
                                    <div class="absolute bottom-3 left-3">
                                        @php
                                            $badges = [
                                                ['class' => 'bg-yellow-500', 'text' => 'Yaxshi Taklif'],
                                                ['class' => 'bg-red-500', 'text' => 'Zudlik bilan'],
                                                ['class' => 'bg-green-500', 'text' => 'Super Narx']
                                            ];
                                            $randomBadge = $badges[array_rand($badges)];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-white text-xs font-medium {{ $randomBadge['class'] }}">
                                            {{ $randomBadge['text'] }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="p-5">
                                    <!-- Price and Category -->
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-xl font-bold text-primary-blue mb-1">
                                                {{ number_format($product->price) }}
                                                @if($product->currency == 'USD') y.e @else USD @endif
                                            </h3>
                                            <p class="text-gray-600 font-medium text-sm">{{ $product->category->name ?? 'Mulk' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="bg-primary-blue text-white px-2 py-1 rounded-lg text-xs font-medium">
                                                <i class="fas fa-eye mr-1"></i>{{ rand(1000, 15000) }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <i class="fas fa-map-marker-alt text-primary-blue mr-2"></i>
                                        <span>{{ $product->region->name ?? 'Toshkent' }}, {{ $product->city->name ?? 'Shahar' }}</span>
                                    </div>

                                    <!-- Property Details -->
                                    <div class="grid grid-cols-3 gap-3 mb-4 text-xs text-gray-600">
                                        <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-lg">
                                            <i class="fas fa-building text-primary-blue"></i>
                                            <span>{{ $product->floor ?? '1' }}/{{ $product->building_floor ?? '5' }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-lg">
                                            <i class="fas fa-door-open text-primary-blue"></i>
                                            <span>{{ $product->rooms ?? '2' }} xona</span>
                                        </div>
                                        <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-lg">
                                            <i class="fas fa-expand-arrows-alt text-primary-blue"></i>
                                            <span>{{ $product->square ?? '45' }}m²</span>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-tools text-primary-blue"></i>
                                            <span>{{ $product->repair_type ?? 'Yaxshi ta\'mir' }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-subway text-primary-blue"></i>
                                            <span>Metro yaqin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Carousel Indicators -->
            <div class="flex justify-center mt-6 space-x-2">
                @for($i = 0; $i < ceil(count($bestOffers) / 3); $i++)
                    <button class="carousel-indicator w-3 h-3 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-primary-blue' : 'bg-gray-300' }}" data-slide="{{ $i }}"></button>
                @endfor
            </div>
        </div>
    </div>
</section>

<!-- Statistics Cards -->
<div class="container mx-auto px-4 my-8 md:my-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <div class="bg-primary-blue text-white rounded-xl shadow-lg p-6 md:p-8 text-center">
            <h3 class="text-lg md:text-xl font-bold mb-2">Sotuvdagi Uylar</h3>
            <p class="text-sm opacity-80 mb-4">Barcha e'lonlar</p>
            <span class="text-3xl md:text-5xl font-bold">{{ number_format($statistics['sale_apartments']) }}</span>
        </div>
        <div class="bg-primary-blue text-white rounded-xl shadow-lg p-6 md:p-8 text-center">
            <h3 class="text-lg md:text-xl font-bold mb-2">Arenda Uylar</h3>
            <p class="text-sm opacity-80 mb-4">Barcha e'lonlar</p>
            <span class="text-3xl md:text-5xl font-bold">{{ number_format($statistics['rent_apartments']) }}</span>
        </div>
        <div class="bg-primary-blue text-white rounded-xl shadow-lg p-6 md:p-8 text-center">
            <h3 class="text-lg md:text-xl font-bold mb-2">Xonadosh</h3>
            <p class="text-sm opacity-80 mb-4">Barcha e'lonlar</p>
            <span class="text-3xl md:text-5xl font-bold">{{ number_format($statistics['roommates']) }}</span>
        </div>
        <div class="bg-primary-blue text-white rounded-xl shadow-lg p-6 md:p-8 text-center">
            <h3 class="text-lg md:text-xl font-bold mb-2">Business Space</h3>
            <p class="text-sm opacity-80 mb-4">Barcha e'lonlar</p>
            <span class="text-3xl md:text-5xl font-bold">{{ number_format($statistics['business_space']) }}</span>
        </div>
    </div>
</div>

<!-- Partnership Section -->
<div class="bg-gray-50 py-8 md:py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-8 md:gap-12">
            <div class="lg:w-1/2">
                <img src="{{asset('logo/contract.png')}}" alt="Partnership" class="max-w-xs md:max-w-md mx-auto">
            </div>
            <div class="lg:w-1/2 text-center lg:text-left">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary-blue mb-6">
                    HUQUQIY SHARTNOMA ASOSIDA<br>
                    HAMKORLIKNI BOSHLANG!
                </h2>
                <p class="text-gray-600 mb-8 text-sm md:text-lg leading-relaxed px-4 lg:px-0">
                    Bizning barcha xizmatlarimiz faqat rasmiy huquqiy shartnoma asosida taqdim etiladi.
                    Shartnomani onlayn tarzda imzolaganingizdan so'ng, siz bilan hamkorlik jarayoni
                    to'liq qonuniy kafolat ostida boshlanadi. Bu yondashuv mijozlarimiz manfaatlarini himoya qilish,
                    shaffoflik va ishonchni ta'minlash uchun joriy etilgan.
                </p>
                <button class="bg-secondary-gold text-primary-blue font-bold py-3 md:py-4 px-6 md:px-8 rounded-lg shadow-lg hover:bg-primary-gold transition duration-300 flex items-center gap-3 mx-auto lg:mx-0 text-sm md:text-base">
                    <i class="fas fa-pencil-alt"></i>
                    <span class="hidden sm:inline">Rasmiy shartnoma asosida davom etish</span>
                    <span class="sm:hidden">Shartnoma</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer-bg text-white">
    <div class="bg-secondary-gold text-primary-blue py-3 md:py-4">
        <div class="container mx-auto px-4 text-center">
            <ul class="flex flex-wrap justify-center gap-2 md:gap-8 font-medium text-sm md:text-base">
                <li><a href="#" class="hover:text-white transition-colors">Biz haqimizda</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Xizmatlarimiz</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Yangiliklar</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Reklama</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Ommaviy oferta</a></li>
                <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
            </ul>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
            <div class="text-center lg:text-left">
                <img src="{{ asset('logo/footer-logo.png') }}" alt="Estora Logo" class="mb-4 md:mb-6 footer-logo mx-auto lg:mx-0">
                <p class="text-xs md:text-sm text-footer-primary mb-4">YTT "Estora", 2025 yy. Barcha huquqlar himoyalangan</p>
                <p class="text-xs text-footer-primary">
                    Saytdan foydalanish orqali <strong>Foydalanuvchi shartnomasi</strong> va
                    <strong>Shaxsiy ma'lumotlarni qayta ishlash siyosati</strong> bilan rozilik bildirganingizni anglatadi.
                </p>
            </div>

            <div class="text-center">
                <div class="mb-4 md:mb-6">
                    <p class="text-footer-primary text-xs md:text-sm mb-2">O'zbekiston bo'ylab barcha qo'ng'iroqlar bepul</p>
                    <div class="flex items-center justify-center gap-2 md:gap-3 mb-4 md:mb-6">
                        <div class="bg-white bg-opacity-10 p-3 rounded-full">
                            <i class="fas fa-phone text-xl md:text-2xl"></i>
                        </div>
                        <span class="text-lg md:text-2xl font-bold">+998 (95) 160 64 46</span>
                    </div>
                </div>
                <div class="flex justify-center gap-3 md:gap-4">
                    <a href="https://www.instagram.com/estora.uz/?__pwa=1#" class="text-secondary-gold hover:text-white text-2xl transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-secondary-gold hover:text-white text-2xl transition-colors">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-secondary-gold hover:text-white text-2xl transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="text-secondary-gold hover:text-white text-2xl transition-colors">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a href="#" class="text-secondary-gold hover:text-white text-2xl transition-colors">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-secondary-gold hover:text-white text-2xl transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <div class="text-center lg:text-right">
                <button class="bg-primary-blue bg-opacity-80 text-white px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-opacity-100 transition-all flex items-center gap-2 mx-auto lg:ml-auto text-sm md:text-base">
                    <span>Savollaringiz bormi? Biz aloqadamiz.</span>
                    <i class="fas fa-comments"></i>
                </button>
            </div>
        </div>

        <hr class="border-t border-gray-700 my-8">

        <div class="text-center text-xs md:text-sm text-footer-primary px-4">
            © 2025 Estora — Barcha huquqlar himoyalangan. estora.uz saytida joylashtirilgan ma'lumotlardan foydalanish — jumladan,
            ularni namoyish etish, nusxa ko'chirish, ko'paytirish yoki tarqatish — faqatgina manbaga faol havola ko'rsatilgan taqdirda ruxsat etiladi.
        </div>
    </div>
</footer>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu fixed inset-0 bg-white z-50 hidden md:hidden">
    <div class="mobile-menu-content h-full flex flex-col">
        <div class="mobile-menu-header p-4 border-b flex justify-between items-center">
            <span class="text-xl font-bold">Menyu</span>
            <button id="close-menu-toggle" class="close-menu-btn text-2xl">&times;</button>
        </div>
        <nav class="mobile-nav flex-1 p-4 overflow-y-auto">
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Bosh Sahifa</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Biz Haqimizda</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Yangiliklar</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Ijara</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Sotib olish</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">NoBroker</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Expats</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-secondary-gold border-b">Business Space</a>
        </nav>
        <div class="mobile-actions p-4 border-t">
            <h3 class="font-bold text-lg mb-2">Aloqa</h3>
            <div class="mobile-action-item flex items-center gap-2 py-2 text-gray-700">
                <i class="fas fa-phone-alt text-secondary-gold"></i>
                <a href="tel:+998951606446" class="hover:text-secondary-gold">+998 (95) 160 64 46</a>
            </div>
            <div class="mobile-action-item flex items-center gap-2 py-2 text-gray-700">
                <i class="fas fa-envelope text-secondary-gold"></i>
                <a href="mailto:info@estora.uz" class="hover:text-secondary-gold">info@estora.uz</a>
            </div>
            <hr class="my-4 border-gray-200">
            <a href="#" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-secondary-gold">
                <i class="fas fa-heart text-secondary-gold"></i>
                <span>Favourites</span>
            </a>
            <a href="{{ route('login.index') }}" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-secondary-gold">
                <i class="fas fa-user-circle text-secondary-gold"></i>
                <span>Login</span>
            </a>
        </div>
    </div>
</div>

<script>
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const closeMenuToggle = document.getElementById('close-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuToggle.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
    });

    closeMenuToggle.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
    });

    // Search tabs functionality
    document.querySelectorAll('.search-tabs button').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.search-tabs button').forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('tab-inactive');
            });
            button.classList.remove('tab-inactive');
            button.classList.add('tab-active');
        });
    });

    // Region-City dependency
    const regionSelect = document.querySelector('select[name="region"]');
    const citySelect = document.getElementById('city-select');

    if (regionSelect && citySelect) {
        regionSelect.addEventListener('change', function() {
            const regionId = this.value;

            // Clear city options
            citySelect.innerHTML = '<option value="">Tanlang</option>';

            if (regionId) {
                // Show loading
                citySelect.innerHTML = '<option value="">Yuklanmoqda...</option>';

                // Fetch cities for selected region
                fetch(`/get-cities/${regionId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        citySelect.innerHTML = '<option value="">Tanlang</option>';
                        if (data.error) {
                            citySelect.innerHTML = '<option value="">Xatolik yuz berdi</option>';
                        } else {
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id;
                                option.textContent = city.name;
                                citySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        citySelect.innerHTML = '<option value="">Xatolik yuz berdi</option>';
                    });
            } else {
                // Reset city select when no region is selected
                citySelect.innerHTML = '<option value="">Tanlang</option>';
            }
        });

        // Initialize cities if region is already selected (for form persistence)
        if (regionSelect.value) {
            regionSelect.dispatchEvent(new Event('change'));
        }
    }

    // Carousel functionality
    let currentSlide = 0;
    const totalProducts = {{ count($bestOffers) }};
    const carouselTrack = document.getElementById('carouselTrack');
    const indicators = document.querySelectorAll('.carousel-indicator');

    // Responsive products per slide
    function getProductsPerSlide() {
        return window.innerWidth < 768 ? 1 : 3;
    }

    function getTotalSlides() {
        return Math.ceil(totalProducts / getProductsPerSlide());
    }

    function getTranslateValue() {
        const productsPerSlide = getProductsPerSlide();
        if (productsPerSlide === 1) {
            // Mobile: move by 100% for each product
            return -currentSlide * 100;
        } else {
            // Desktop: move by 100/3% for each group of 3
            return -currentSlide * (100 / productsPerSlide);
        }
    }

    function updateCarousel() {
        const translateX = getTranslateValue();
        carouselTrack.style.transform = `translateX(${translateX}%)`;

        const totalSlides = getTotalSlides();

        // Update indicators
        indicators.forEach((indicator, index) => {
            if (index < totalSlides) {
                indicator.style.display = 'block';
                indicator.classList.toggle('bg-primary-blue', index === currentSlide);
                indicator.classList.toggle('bg-gray-300', index !== currentSlide);
            } else {
                indicator.style.display = 'none';
            }
        });
    }

    document.getElementById('nextBtn').addEventListener('click', () => {
        const totalSlides = getTotalSlides();
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        const totalSlides = getTotalSlides();
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    });

    // Indicator click handlers
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            const totalSlides = getTotalSlides();
            if (index < totalSlides) {
                currentSlide = index;
                updateCarousel();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        const totalSlides = getTotalSlides();
        if (currentSlide >= totalSlides) {
            currentSlide = 0;
        }
        updateCarousel();
    });

    // Initialize carousel
    updateCarousel();

    // Auto-play carousel (optional)
    setInterval(() => {
        const totalSlides = getTotalSlides();
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }, 5000); // Change slide every 5 seconds
</script>
</body>
</html>
