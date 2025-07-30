<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="hero-section">
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="/logo/logo-white.png" alt="Estora Logo">
                <span>{{ __('REAL ESTATE AGENCY') }}</span>
            </div>
            <nav class="main-nav">
                <div class="contact-info">
                    <a href="tel:+998951606446">+998 95 160 64 46</a>
                </div>
                <div class="language-selector">
                    <select id="language-switcher">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>ENGLISH</option>
                        <option value="uz" {{ app()->getLocale() == 'uz' ? 'selected' : '' }}>UZBEK</option>
                        <option value="ru" {{ app()->getLocale() == 'ru' ? 'selected' : '' }}>RUSSIAN</option>
                    </select>
                </div>
                <div class="menu-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>

    <div class="mobile-menu-overlay">
        <div class="mobile-menu">
            <button class="close-menu">&times;</button>
            <ul>
                <li><a href="#" class="mobile-login-btn">{{ __('Login') }}</a></li> {{-- Tarjima qo'shildi --}}
            </ul>
        </div>
    </div>
    <div class="search-section">
        <div class="container">
            <form action="{{ route('products.filter') }}" method="GET" class="search-card">
                <div class="input-group">
                    <label for="ad_type">{{ __("E'lon turi") }}</label> {{-- Tarjima qo'shildi --}}
                    <select id="ad_type" name="ad_type">
                        <option value="">{{ __('Hammasi') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="sale" {{ $request->ad_type == 'sale' ? 'selected' : '' }}>{{ __('Sotish') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="rent" {{ $request->ad_type == 'rent' ? 'selected' : '' }}>{{ __('Ijaraga') }}</option> {{-- Tarjima qo'shildi --}}
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="property_type">{{ __('Mulk turi') }}</label> {{-- Tarjima qo'shildi --}}
                    <select id="property_type" name="property_type">
                        <option value="">{{ __('Hammasi') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="apartment" {{ $request->property_type == 'apartment' ? 'selected' : '' }}>{{ __('Kvartira') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="house" {{ $request->property_type == 'house' ? 'selected' : '' }}>{{ __('Uy/Hovli') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="land" {{ $request->property_type == 'land' ? 'selected' : '' }}>{{ __('Yer') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="commercial" {{ $request->property_type == 'commercial' ? 'selected' : '' }}>{{ __('Tijorat binosi') }}</option> {{-- Tarjima qo'shildi --}}
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="region">{{ __('Hudud') }}</label> {{-- Tarjima qo'shildi --}}
                    <select id="region" name="region">
                        <option value="">{{ __('Tanlang') }}</option> {{-- Tarjima qo'shildi --}}
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ $request->region == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="rooms">{{ __('Xonalar soni') }}</label> {{-- Tarjima qo'shildi --}}
                    <select id="rooms" name="rooms">
                        <option value="">{{ __('Hammasi') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="1" {{ $request->rooms == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $request->rooms == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $request->rooms == '3' ? 'selected' : '' }}>3</option>
                        <option value="3+" {{ $request->rooms == '3+' ? 'selected' : '' }}>3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="floors">{{ __('Qavatlar soni') }}</label> {{-- Tarjima qo'shildi --}}
                    <select id="floors" name="floors">
                        <option value="">{{ __('Hammasi') }}</option> {{-- Tarjima qo'shildi --}}
                        <option value="1" {{ $request->floors == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $request->floors == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $request->floors == '3' ? 'selected' : '' }}>3</option>
                        <option value="3+" {{ $request->floors == '3+' ? 'selected' : '' }}>3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="budget">{{ __('Byudjet') }}</label> {{-- Tarjima qo'shildi --}}
                    <input type="text" id="budget" name="budget" placeholder="{{ __('Min - Max (USD)') }}" value="{{ $request->budget ?? '' }}"> {{-- Tarjima qo'shildi --}}
                </div>

                <button type="submit" class="search-button">
                    <i class="bi bi-search"></i> {{ __('Qidirish') }} {{-- Tarjima qo'shildi --}}
                </button>
            </form>
        </div>
    </div>

</div>

<footer class="footer">
    <div class="footer-background">
        <div class="container footer-content">
            <div class="footer-logo">
                <img src="/logo/logo-white.png" alt="Estora Logo">
                <span>{{ __('REAL ESTATE AGENCY') }}</span> {{-- Tarjima qo'shildi --}}
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">{{ __('BOSH SAHIFA') }}</a></li>
                    <li><a href="#">{{ __('BIZ HAQIMIZDA') }}</a></li>
                    <li><a href="#">{{ __('YANGLILIKLAR') }}</a></li>
                    <li><a href="{{route('login.index')}}">{{ __('LOGIN') }}</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <p>{{ __('ALOQA UCHUN') }}</p>
                <p>+998 95 160 64 46</p>
                <p>info@estora.uz</p>
            </div>
            <div class="footer-social">
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-telegram"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Estora. {{ __('Barcha huquqlar himoyalangan') }}</p>
        </div>
    </div>
</footer>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
