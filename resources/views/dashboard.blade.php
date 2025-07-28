<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency</title>
    <link rel="stylesheet" href="css/style.css"> {{-- Sizning alohida style.css faylingiz --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="hero-section">
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="/logo/Estora Logo.png" alt="Estora Logo">
                <span>REAL ESTATE AGENCY</span>
            </div>
            <nav class="main-nav">
                <div class="contact-info">
                    <a href="tel:+998951606446">+998 95 160 64 46</a>
                </div>
                <div class="language-selector">
                    <select>
                        <option value="en">ENGLISH</option>
                        <option value="uz">UZBEK</option>
                        <option value="ru">RUSSIAN</option>
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
                <li><a href="#" class="mobile-login-btn">Login</a></li>
            </ul>
        </div>
    </div>

    <div class="search-section">
        <div class="container">
            <form action="{{ route('products.filter') }}" method="POST" class="search-card">
                @csrf 
                <div class="input-group">
                    <label for="ad-type">E'LON TURI</label>
                    <select id="ad-type" name="ad_type"> 
                        <option value="">Tanlang</option>
                        <option value="sale">Sotish</option>
                        <option value="rent">Ijaraga</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group">
                    <label for="regions">HUDUDLAR BO'YICHA</label>
                    <select id="regions" name="region"> 
                        <option value="">Tanlang</option>
                        {{-- @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach --}}
                        <option value="tashkent">Toshkent</option>
                        <option value="samarkand">Samarqand</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group">
                    <label for="rooms">XONALAR SONI</label>
                    <select id="rooms" name="rooms"> {{-- name atributi qo'shildi --}}
                        <option value="">Tanlang</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3+">3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group">
                    <label for="floors">QAVATLAR SONI</label>
                    <select id="floors" name="floors"> {{-- name atributi qo'shildi --}}
                        <option value="">Tanlang</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3+">3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group text-input">
                    <label for="budget">BUDJETINGIZ (y.e.da)</label>
                    <input type="text" id="budget" name="budget" placeholder="Masalan: 50000 - 100000"> {{-- name atributi qo'shildi --}}
                </div>
                <div class="input-group">
                    <label for="property-type">UY TURI</label>
                    <select id="property-type" name="property_type"> {{-- name atributi qo'shildi --}}
                        <option value="">Tanlang</option>
                        <option value="apartment">Kvartira</option>
                        <option value="house">Uy</option>
                        <option value="land">Yer</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <button type="submit" class="search-button"> {{-- type="submit" qo'shildi --}}
                    <i class="bi bi-search"></i> QIDIRUV
                </button>
            </form>
        </div>
    </div>
</div>

<div class="search-section">
        <div class="container">
            <form action="{{ route('products.filter') }}" method="GET" class="search-card">
                <div class="input-group">
                    <label for="ad_type">E'lon Turi</label>
                    <select id="ad_type" name="ad_type">
                        <option value="">Hammasi</option>
                        <option value="sale" {{ $request->ad_type == 'sale' ? 'selected' : '' }}>Sotish</option>
                        <option value="rent" {{ $request->ad_type == 'rent' ? 'selected' : '' }}>Ijaraga berish</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="property_type">Mulk turi</label>
                    <select id="property_type" name="property_type">
                        <option value="">Hammasi</option>
                        <option value="apartment" {{ $request->property_type == 'apartment' ? 'selected' : '' }}>Kvartira</option>
                        <option value="house" {{ $request->property_type == 'house' ? 'selected' : '' }}>Uy/Hovli</option>
                        <option value="land" {{ $request->property_type == 'land' ? 'selected' : '' }}>Yer</option>
                        <option value="commercial" {{ $request->property_type == 'commercial' ? 'selected' : '' }}>Tijorat binosi</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="region">Hudud</label>
                    <select id="region" name="region">
                        <option value="">Tanlang</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ $request->region == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="rooms">Xonalar soni</label>
                    <select id="rooms" name="rooms">
                        <option value="">Hammasi</option>
                        <option value="1" {{ $request->rooms == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $request->rooms == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $request->rooms == '3' ? 'selected' : '' }}>3</option>
                        <option value="3+" {{ $request->rooms == '3+' ? 'selected' : '' }}>3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="floors">Qavatlar soni</label>
                    <select id="floors" name="floors">
                        <option value="">Hammasi</option>
                        <option value="1" {{ $request->floors == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $request->floors == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $request->floors == '3' ? 'selected' : '' }}>3</option>
                        <option value="3+" {{ $request->floors == '3+' ? 'selected' : '' }}>3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>

                <div class="input-group">
                    <label for="budget">Byudjet</label>
                    <input type="text" id="budget" name="budget" placeholder="Min - Max (USD)" value="{{ $request->budget ?? '' }}">
                </div>

                <button type="submit" class="search-button">
                    <i class="bi bi-search"></i> Qidirish
                </button>
            </form>
        </div>
    </div>
    
</div>

<footer class="footer">
    <div class="footer-background">
        <div class="container footer-content">
            <div class="footer-logo">
                <img src="/logo/Estora Logo.png" alt="Estora Logo">
                <span>REAL ESTATE AGENCY</span>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">BOSH SAHIFA</a></li>
                    <li><a href="#">BIZ HAQIMIZDA</a></li>
                    <li><a href="#">YANGLILIKLAR</a></li>
                    <li><a href="{{route('login.index')}}">LOGIN</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <p>ALOQA UCHUN</p>
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
            <p>© 2025 Estora. Barcha huquqlar himoyalangan</p>
        </div>
    </div>
</footer>

<script src="js/script.js"></script> {{-- Sizning alohida script.js faylingiz --}}
</body>
</html>  