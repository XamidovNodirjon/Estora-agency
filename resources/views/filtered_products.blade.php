<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency - Natijalar</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/filter_product.css') }}">
    <style>
        /* Bu yerda avvalgi CSS uslublari joylashgan */
        .ads-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .ad-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .view-ad-button {
            flex-grow: 1;
            padding: 12px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        .view-ad-button:hover {
            background-color: #218838;
        }

        .contact-buttons-container {
            display: flex;
            gap: 10px;
        }

        .phone-contact-button {
            background-color: #007bff;
        }

        .telegram-share-button {
            background-color: #0088cc;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .modal-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .modal-product-info {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .modal .close-button {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            color: #aaa;
            cursor: pointer;
            line-height: 1;
            transition: color 0.3s ease;
        }

        .modal .close-button:hover {
            color: #333;
        }

        .modal .form-group {
            margin-bottom: 20px;
        }

        .modal .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .modal .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .modal .form-group input:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.2);
        }

        .submit-contact-button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-contact-button:hover {
            background-color: #218838;
        }

        .success-content {
            text-align: center;
            padding: 40px;
        }

        .success-icon {
            margin: 0 auto 20px;
            width: 80px;
            height: 80px;
        }
        
        .checkmark-circle {
            display: block;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #28a745;
            padding: 10px;
            box-sizing: border-box;
            transform: rotate(-90deg);
        }

        .checkmark-circle.animate {
            animation: rotate 1s ease-in-out;
        }

        .checkmark {
            width: 100%;
            height: 100%;
            display: block;
            transform: rotate(45deg);
        }

        .checkmark-circle-path {
            stroke: #fff;
            stroke-width: 4;
            stroke-dasharray: 157;
            stroke-dashoffset: 157;
            animation: stroke 1s linear forwards;
        }

        .checkmark-check {
            stroke: #fff;
            stroke-width: 4;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            opacity: 0;
            animation: stroke-check 0.8s ease-in-out 0.8s forwards;
        }

        @keyframes stroke {
            to {
                stroke-dashoffset: 0;
            }
        }
        @keyframes stroke-check {
            from {
                stroke-dashoffset: 48;
                opacity: 0;
            }
            to {
                stroke-dashoffset: 0;
                opacity: 1;
            }
        }
        @keyframes rotate {
            from { transform: rotate(-90deg); }
            to { transform: rotate(270deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('/logo/Estora Logo.png') }}" alt="Estora Logo">
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
        <button class="close-menu">×</button>
        <ul>
            <li><a href="#" class="mobile-login-btn">{{ __('Login') }}</a></li>
        </ul>
    </div>
</div>

<div class="search-form-card">
    <h2>{{ __('Qidiruv natijalari') }}</h2>
    <form action="{{ route('products.filter') }}" method="GET">
        <div class="search-form-grid">
            <div class="form-group">
                <label for="type">{{ __("E'lon turi") }}</label>
                <select name="type" id="type">
                    <option value="">{{ __('Hammasi') }}</option>
                    <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>{{ __('Sotish') }}</option>
                    <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>{{ __('Ijaraga') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">{{ __('Mulk turi') }}</label>
                <select name="category" id="category">
                    <option value="">{{ __('Hammasi') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rooms">{{ __('Xonalar soni') }}</label>
                <select name="rooms" id="rooms">
                    <option value="">{{ __('Hammasi') }}</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('rooms') == $i ? 'selected' : '' }}>{{ $i }} {{ __('xona') }}</option>
                    @endfor
                    <option value="5+" {{ request('rooms') == '5+' ? 'selected' : '' }}>5+ {{ __('xona') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price_from">{{ __('Narx (dan)') }}</label>
                <input type="text" name="price_from" id="price_from" value="{{ request('price_from') }}"
                       placeholder="{{ __('minimal narx') }}">
            </div>
            <div class="form-group">
                <label for="price_to">{{ __('Narx (gacha)') }}</label>
                <input type="text" name="price_to" id="price_to" value="{{ request('price_to') }}"
                       placeholder="{{ __('maksimal narx') }}">
            </div>
            <div class="form-group">
                <label for="region">{{ __('Hudud') }}</label>
                <select name="region" id="region">
                    <option value="">{{ __('Hammasi') }}</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="more-filters-hidden" style="display: none;">
                <div class="form-group">
                    <label for="floors">{{ __('Qavatlar soni') }}</label>
                    <select name="floors" id="floors">
                        <option value="">{{ __('Hammasi') }}</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('floors') == $i ? 'selected' : '' }}>{{ $i }} {{ __('qavat') }}</option>
                        @endfor
                        <option value="6+" {{ request('floors') == '6+' ? 'selected' : '' }}>6+ {{ __('qavat') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="property_type">{{ __('Uy turi') }}</label>
                    <select name="property_type" id="property_type">
                        <option value="">{{ __('Hammasi') }}</option>
                        <option value="apartment" {{ request('property_type') == 'apartment' ? 'selected' : '' }}>{{ __('Kvartira') }}</option>
                        <option value="house" {{ request('property_type') == 'house' ? 'selected' : '' }}>{{ __('Uy / Yer') }}</option>
                        <option value="commercial" {{ request('property_type') == 'commercial' ? 'selected' : '' }}>{{ __('Tijorat binosi') }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="filter-actions">
            <button type="button" class="more-filters-btn">
                <i class="bi bi-funnel-fill"></i> {{ __('Ko\'proq filterlar') }}
            </button>
            <div class="filter-buttons">
                <button type="button" class="map-view-btn">
                    <i class="bi bi-geo-alt-fill"></i> {{ __('Xaritadan ko\'rish') }}
                </button>
                <button type="submit" class="show-ads-btn">
                    <i class="bi bi-search"></i> {{ __('Ko\'rish') }} {{ $filteredProducts->total() }} {{ __('e\'lonlar') }}
                </button>
            </div>
        </div>
    </form>
</div>

<section class="ads-listing-section">
    <div class="container">
        <h2>{{ __('Topilgan e\'lonlar') }}</h2>
        @if($filteredProducts->isEmpty())
            <p class="no-results">{{ __('Hech qanday e\'lon topilmadi. Boshqa filterlarni sinab ko\'ring.') }}</p>
        @else
            <div class="ads-grid">
                @foreach($filteredProducts as $product)
                    <div class="ad-card" data-images="{{ json_encode($product->image_array) }}">
                        <div class="image-gallery-card-container">
                            @php
                                $firstImage = count($product->image_array) > 0 ? $product->image_array[0] : null;
                            @endphp
                            <img src="{{ $firstImage ? asset('storage/' . $firstImage) : 'https://placehold.co/600x400/CCCCCC/333333?text=Rasm+Yoq' }}"
                                 alt="{{ $product->name }}"
                                 class="ad-image">
                            <button class="nav-button-card prev-button-card">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="nav-button-card next-button-card">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                        <div class="ad-info">
                            <h3>{{ $product->name }}</h3>
                            <p class="ad-price">{{ number_format($product->price, 0, '.', ' ') }} {{ __('y.e.') }}</p>
                            <p class="ad-location"><i class="bi bi-geo-alt-fill"></i> {{ $product->region->name ?? __('Noma\'lum hudud') }}</p>
                            <div class="ad-details">
                                @if($product->rooms > 0)
                                    <span><i class="bi bi-grid-fill"></i> {{ $product->rooms }} {{ __('xona') }}</span>
                                @endif
                                @if($product->building_floor > 0)
                                    <span><i class="bi bi-building"></i> {{ $product->floor }}/{{ $product->building_floor }} {{ __('qavat') }}</span>
                                @endif
                                @if($product->square > 0)
                                    <span><i class="bi bi-rulers"></i> {{ $product->square }} {{ __('m²') }}</span>
                                @endif
                                @if($product->sotix > 0)
                                    <span><i class="bi bi-bounding-box"></i> {{ $product->sotix }} {{ __('sotix') }}</span>
                                @endif
                            </div>
                            <p class="ad-category">
                                {{ __('Kategoriya:') }} {{ $product->category->name ?? __('Noma\'lum') }}
                                @if($product->subcategory)
                                    / {{ $product->subcategory->name }}
                                @endif
                            </p>
                            <p class="product-id">ID: <strong>{{ $product->id }}</strong></p>
                            <div class="ad-actions">
                                <button class="view-ad-button open-contact-modal" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">{{ __('Batafsil') }}</button>
                                <div class="contact-buttons-container">
                                    <p>+998 95 160 64 46</p>
                                    <a href="https://t.me/+998951606446" class="telegram-contact" target="_blank">
                                        <i class="bi bi-telegram"></i> Telegram
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-links">
                <div class="pagination-info">
                    {{ $filteredProducts->firstItem() }} {{ __('dan') }} {{ $filteredProducts->lastItem() }} {{ __('gacha,') }}
                    {{ __('jami') }} {{ $filteredProducts->total() }} {{ __('natija') }}
                </div>
                <nav aria-label="Pagination">
                    @if ($filteredProducts->onFirstPage())
                        <span class="page-link disabled" aria-disabled="true">
                            <i class="bi bi-chevron-left"></i> {{ __('Oldingi') }}
                        </span>
                    @else
                        <a href="{{ $filteredProducts->previousPageUrl() }}" class="page-link">
                            <i class="bi bi-chevron-left"></i> {{ __('Oldingi') }}
                        </a>
                    @endif

                    @php
                        $start = max(1, $filteredProducts->currentPage() - 2);
                        $end = min($filteredProducts->lastPage(), $filteredProducts->currentPage() + 2);
                        if ($end - $start < 4) {
                            if ($start == 1) {
                                $end = min($start + 4, $filteredProducts->lastPage());
                            } else {
                                $start = max(1, $end - 4);
                            }
                        }
                    @endphp

                    @if ($start > 1)
                        <a href="{{ $filteredProducts->url(1) }}" class="page-link">1</a>
                        @if ($start > 2)
                            <span class="page-link dots">...</span>
                        @endif
                    @endif

                    @foreach (range($start, $end) as $page)
                        <a href="{{ $filteredProducts->url($page) }}"
                           class="page-link {{ $page == $filteredProducts->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if ($end < $filteredProducts->lastPage())
                        @if ($end < $filteredProducts->lastPage() - 1)
                            <span class="page-link dots">...</span>
                        @endif
                        <a href="{{ $filteredProducts->url($filteredProducts->lastPage()) }}"
                           class="page-link">{{ $filteredProducts->lastPage() }}</a>
                    @endif

                    @if ($filteredProducts->hasMorePages())
                        <a href="{{ $filteredProducts->nextPageUrl() }}" class="page-link">
                            {{ __('Keyingi') }} <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span class="page-link disabled" aria-disabled="true">
                            {{ __('Keyingi') }} <i class="bi bi-chevron-right"></i>
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </div>
</section>

<footer class="footer">
    <div class="footer-background">
        <div class="container footer-content">
            <div class="footer-logo">
                <img src="{{ asset('/logo/logo-white.png') }}" alt="Estora Logo">
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

<div id="quickContactModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeContactModal">×</span>
        <div class="modal-header">
            <h3>{{ __('Tezkor Murojaat') }}</h3>
            <p class="modal-product-info">{{ __('E\'lon:') }} <span id="modalProductName"></span> (ID: <span id="modalProductId"></span>)</p>
        </div>
        <form id="contactForm">
            <div class="form-group">
                <label for="contactName">{{ __('Ismingiz:') }}</label>
                <input type="text" id="contactName" name="name" placeholder="{{ __('Ismingizni kiriting') }}" required>
            </div>
            <div class="form-group">
                <label for="contactPhone">{{ __('Telefon raqamingiz:') }}</label>
                <input type="tel" id="contactPhone" name="phone" placeholder="+998 (XX) XXX-XX-XX" required>
            </div>
            <button type="submit" class="submit-contact-button">{{ __('Yuborish') }}</button>
        </form>
    </div>
</div>

<div id="successModal" class="modal">
    <div class="modal-content success-content">
        <span class="close-button" id="closeSuccessModal">×</span>
        <div class="success-icon">
            <div class="checkmark-circle">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark-circle-path" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
        </div>
        <h3>{{ __('Murojaatingiz qabul qilindi!') }}</h3>
        <p>{{ __('Tez orada siz bilan bog\'lanamiz.') }}</p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

<script>
    $(document).ready(function(){
        $('#contactPhone').inputmask({
            "mask": "+998 (99) 999-99-99",
            "clearIncomplete": true,
            "showMaskOnHover": false,
            "onBeforePaste": function(pastedValue, opts) {
                return pastedValue.replace(/^\+998/, '');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.menu-toggle');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        const closeMenuButton = document.querySelector('.close-menu');

        if (menuToggle && mobileMenuOverlay && closeMenuButton) {
            menuToggle.addEventListener('click', function () {
                mobileMenuOverlay.classList.add('active');
            });
            closeMenuButton.addEventListener('click', function () {
                mobileMenuOverlay.classList.remove('active');
            });
            mobileMenuOverlay.addEventListener('click', function (event) {
                if (event.target === mobileMenuOverlay) {
                    mobileMenuOverlay.classList.remove('active');
                }
            });
        }
        
        const TELEGRAM_BOT_TOKEN = '8324622390:AAHTibxtx1NfrBz-P6NREXKZEboIqx8VxQI';
        const TELEGRAM_CHAT_ID = '-1002718251790'; 

        const contactModal = document.getElementById('quickContactModal');
        const successModal = document.getElementById('successModal');
        const openContactModalButtons = document.querySelectorAll('.open-contact-modal');
        const closeContactModal = contactModal.querySelector('.close-button');
        const closeSuccessModal = successModal.querySelector('.close-button');
        const contactForm = document.getElementById('contactForm');
        const modalProductName = document.getElementById('modalProductName');
        const modalProductId = document.getElementById('modalProductId');

        openContactModalButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productName = this.dataset.productName;
                const productId = this.dataset.productId;
                modalProductName.textContent = productName;
                modalProductId.textContent = productId;
                contactModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        });

        closeContactModal.addEventListener('click', function () {
            contactModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        closeSuccessModal.addEventListener('click', function () {
            successModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        window.addEventListener('click', function (event) {
            if (event.target === contactModal) {
                contactModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
            if (event.target === successModal) {
                successModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        contactForm.addEventListener('submit', function (event) {
            event.preventDefault();
            
            const name = document.getElementById('contactName').value;
            const phone = document.getElementById('contactPhone').value;
            const productId = modalProductId.textContent;
            const productName = modalProductName.textContent;
            if (phone.length < "+998 (99) 999-99-99".length) {
                alert("Iltimos, telefon raqamini to'liq kiriting.");
                return;
            }
            
            const message = `Yangi murojaat!\n\nIsmi: ${name}\nTelefon raqami: ${phone}\nQiziqish bildirgan e'lon: ${productName}\nE'lon ID: ${productId}`;
            
            const submitButton = contactForm.querySelector('.submit-contact-button');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="bi bi-arrow-clockwise rotate-animation"></i> {{ __('Yuborilmoqda...') }}';

            fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/sendMessage`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    chat_id: TELEGRAM_CHAT_ID,
                    text: message,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                contactModal.style.display = 'none';
                successModal.style.display = 'flex';
                
                const checkmark = successModal.querySelector('.checkmark-circle');
                checkmark.classList.remove('animate');
                void checkmark.offsetWidth;
                checkmark.classList.add('animate');
                
                contactForm.reset();
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Murojaat yuborishda xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = '{{ __('Yuborish') }}';
            });
        });

    });
        
        const moreFiltersBtn = document.querySelector('.more-filters-btn');
        const moreFiltersHidden = document.querySelector('.more-filters-hidden');

        if (moreFiltersBtn && moreFiltersHidden) {
            moreFiltersBtn.addEventListener('click', function () {
                if (moreFiltersHidden.style.display === 'none' || moreFiltersHidden.style.display === '') {
                    moreFiltersHidden.style.display = 'grid';
                    moreFiltersBtn.innerHTML = '<i class="bi bi-funnel-fill"></i> {{ __('Kamroq filterlar') }}';
                } else {
                    moreFiltersHidden.style.display = 'none';
                    moreFiltersBtn.innerHTML = '<i class="bi bi-funnel-fill"></i> {{ __('Ko\'proq filterlar') }}';
                }
            });
        }
        
        document.querySelectorAll('.ad-card').forEach(card => {
            const adImage = card.querySelector('.ad-image');
            const prevButton = card.querySelector('.prev-button-card');
            const nextButton = card.querySelector('.next-button-card');
            const allImagesData = card.dataset.images;

            let allImages = [];
            if (allImagesData) {
                try {
                    allImages = JSON.parse(allImagesData);
                } catch (e) {
                    console.error("Error parsing images data:", e);
                }
            }
            let currentIndex = 0;
            function updateCardImage(newIndex) {
                if (adImage && allImages.length > 0) {
                    currentIndex = (newIndex + allImages.length) % allImages.length;
                    if (currentIndex < 0) {
                        currentIndex = allImages.length - 1;
                    }
                    adImage.style.opacity = '0';
                    setTimeout(() => {
                        adImage.src = "{{ asset('storage/') }}/" + allImages[currentIndex];
                        adImage.style.opacity = '1';
                    }, 300);
                }
            }
            if (allImages.length > 0) {
                updateCardImage(0);
            }
            if (prevButton) {
                prevButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    updateCardImage(currentIndex - 1);
                });
            }
            if (nextButton) {
                nextButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    updateCardImage(currentIndex + 1);
                });
            }
        });
        const langSwitcher = document.getElementById('language-switcher');
        if (langSwitcher) {
            langSwitcher.addEventListener('change', function () {
                const selectedLang = this.value;
                window.location.href = `/lang/${selectedLang}`;
            });
        }
</script>

</body>
</html>