<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWp/PzWc1lA6T1sD1D8x9I2I+I3V6t5K5G5L8t5C5L5V5T1T3T8L1W8T2W5A5A5C5" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}

    <style>
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            flex-wrap: wrap;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 45px;
        }

        .logo-text {
            font-size: 16px;
            color: #0a0a0a;
            font-weight: 500;
        }

        /* Telefon raqam */
        .phone-btn {
            background-color: #f59e0b;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.3s;
        }

        .phone-btn:hover {
            background-color: #d97706;
        }

        /* Language selector */
        .language-selector {
            position: relative;
            margin-left: 15px;
            z-index: 1000;
        }

        .select-language {
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            user-select: none;
        }

        .language-dropdown {
            position: absolute;
            top: 45px;
            right: 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            display: none;
            min-width: 150px;
            animation: fadeDrop 0.3s ease-out forwards;
            z-index: 1001;
        }

        .language-dropdown ul {
            list-style: none;
            padding: 10px;
            margin: 0;
        }

        .language-dropdown ul li a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 5px 0;
            font-weight: 500;
        }

        .language-dropdown ul li a:hover {
            color: #007bff;
        }

        /* Menu icon */
        .menu-icon {
            cursor: pointer;
            padding: 10px;
            border-radius: 6px;
            display: flex; /* Always visible */
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
            width: 30px;
            height: 30px;
        }

        .menu-icon span {
            width: 100%;
            height: 3px;
            background-color: #333;
            border-radius: 2px;
        }

        /* Dropdown modal */
        .dropdown-modal {
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 15px 20px;
            display: none;
            animation: fadeDrop 0.3s ease-out forwards;
            z-index: 999;
            min-width: 180px;
        }

        .dropdown-modal ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .dropdown-modal ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: block;
            margin: 8px 0;
            transition: 0.2s;
        }

        .dropdown-modal ul li a:hover {
            color: #007bff;
        }

        /* Animation */
        @keyframes fadeDrop {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .main-nav {
                display: flex;
                justify-content: space-between;
                width: 100%;
                gap: 10px;
                flex-wrap: wrap;
            }

            .logo {
                justify-content: center;
                width: 100%;
            }

            .phone-btn {
                width: 100%;
                text-align: center;
            }

            .language-selector,
            .menu-icon {
                margin: 0;
            }

            .language-selector {
                order: 2;
                width: 50%;
                justify-content: center;
                display: flex;
            }

            .menu-icon {
                order: 3;
                justify-content: flex-end;
                width: 50%;
                display: flex;
            }
        }
    </style>
</head>
<body>
<div class="hero-section">
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="{{ route('dashboard') }}">
                    <img src="/logo/logo-dashboard.png" alt="Estora Logo">
                </a>
                <span class="logo-text">{{ __('REAL ESTATE AGENCY') }}</span>
            </div>

            <nav class="main-nav">
                <div class="contact-info">
                    <a href="tel:+998951606446" class="phone-btn">+998 95 160 64 46</a>
                </div>

                <div class="language-selector">
                    <div class="select-language" onclick="toggleLanguageDropdown()">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                        <i class="arrow-down"></i>
                    </div>
                    <div class="language-dropdown" id="languageDropdown">
                        <ul>
                            <li>
                                <a href="{{ route('lang.switch', 'en') }}">
                                    <span class="flag-icon flag-icon-us"></span> English
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lang.switch', 'uz') }}">
                                    <span class="flag-icon flag-icon-uz"></span> Uzbek
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lang.switch', 'ru') }}">
                                    <span class="flag-icon flag-icon-ru"></span> Russian
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="menu-icon" onclick="toggleDropdownModal()">
                    <i class="fas fa-bars fa-lg"></i>
                </div>

                <div class="dropdown-modal" id="dropdownModal">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-newspaper"></i> Yangiliklar</a></li>
                        <li><a href="#"><i class="fa-solid fa-circle-info"></i> Biz haqimizda</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="mobile-menu-overlay">
        <div class="mobile-menu">
            <button class="close-menu">&times;</button>
            <ul>
                <li><a href="#" class="mobile-login-btn">{{ __('Login') }}</a></li>
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
                        <option
                            value="sale" {{ $request->ad_type == 'sale' ? 'selected' : '' }}>{{ __('Sotish') }}</option> {{-- Tarjima qo'shildi --}}
                        <option
                            value="rent" {{ $request->ad_type == 'rent' ? 'selected' : '' }}>{{ __('Ijaraga') }}</option> {{-- Tarjima qo'shildi --}}
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="property_type">{{ __('Mulk turi') }}</label> {{-- Tarjima qo'shildi --}}
                    <select id="property_type" name="property_type">
                        <option value="">{{ __('Hammasi') }}</option> {{-- Tarjima qo'shildi --}}
                        <option
                            value="apartment" {{ $request->property_type == 'apartment' ? 'selected' : '' }}>{{ __('Kvartira') }}</option> {{-- Tarjima qo'shildi --}}
                        <option
                            value="house" {{ $request->property_type == 'house' ? 'selected' : '' }}>{{ __('Uy/Hovli') }}</option> {{-- Tarjima qo'shildi --}}
                        <option
                            value="land" {{ $request->property_type == 'land' ? 'selected' : '' }}>{{ __('Yer') }}</option> {{-- Tarjima qo'shildi --}}
                        <option
                            value="commercial" {{ $request->property_type == 'commercial' ? 'selected' : '' }}>{{ __('Tijorat binosi') }}</option> {{-- Tarjima qo'shildi --}}
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
                    <label for="rooms">{{ __('Xonalar soni') }}</label>
                    <select id="rooms" name="rooms">
                        <option value="">{{ __('Hammasi') }}</option>
                        <option value="1" {{ $request->rooms == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $request->rooms == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $request->rooms == '3' ? 'selected' : '' }}>3</option>
                        <option value="3+" {{ $request->rooms == '3+' ? 'selected' : '' }}>3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="floors">{{ __('Qavatlar soni') }}</label>
                    <select id="floors" name="floors">
                        <option value="">{{ __('Hammasi') }}</option>
                        <option value="1" {{ $request->floors == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $request->floors == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $request->floors == '3' ? 'selected' : '' }}>3</option>
                        <option value="3+" {{ $request->floors == '3+' ? 'selected' : '' }}>3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="budget">{{ __('Byudjet') }}</label>
                    <input type="text" id="budget" name="budget" placeholder="{{ __('Min - Max (USD)') }}"
                           value="{{ $request->budget ?? '' }}">
                </div>

                <button type="submit" class="search-button">
                    <i class="bi bi-search"></i> {{ __('Qidirish') }}
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
                <span>{{ __('REAL ESTATE AGENCY') }}</span>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">{{ __('BOSH SAHIFA') }}</a></li>
                    <li><a href="#">{{ __('BIZ HAQIMIZDA') }}</a></li>
                    <li><a href="#">{{ __('YANGLILIKLAR') }}</a></li>
                    <li><a href="{{route('login.index')}}">{{ __('Login') }}</a></li>
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
<script>
    function toggleDropdownModal() {
        const modal = document.querySelector('.dropdown-modal');
        modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
    }

    function toggleLanguageDropdown() {
        const langDropdown = document.querySelector('.language-dropdown');
        langDropdown.style.display = langDropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Agar boshqa joyga bosilsa dropdown'lar yopilsin
    document.addEventListener('click', function (event) {
        const langSelector = document.querySelector('.language-selector');
        const langDropdown = document.querySelector('.language-dropdown');
        const dropdownModal = document.querySelector('.dropdown-modal');

        if (!langSelector.contains(event.target)) {
            langDropdown.style.display = 'none';
        }

        if (!dropdownModal.contains(event.target) && !event.target.closest('.menu-icon')) {
            dropdownModal.style.display = 'none';
        }
    });
</script>



</body>
</html>
