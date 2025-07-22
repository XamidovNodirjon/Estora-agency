<!DOCTYPE html>
<html lang="en">
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
                <img src="https://via.placeholder.com/100x40?text=Estora" alt="Estora Logo">
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
            <div class="search-card">
                <div class="input-group">
                    <label for="ad-type">E'LON TURI</label>
                    <select id="ad-type">
                        <option value="">Tanlang</option>
                        <option value="sale">Sotish</option>
                        <option value="rent">Ijaraga</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group">
                    <label for="regions">HUDUDLAR BO'YICHA</label>
                    <select id="regions">
                        <option value="">Tanlang</option>
                        <option value="tashkent">Toshkent</option>
                        <option value="samarkand">Samarqand</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group">
                    <label for="rooms">XONALAR SONI</label>
                    <select id="rooms">
                        <option value="">Tanlang</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group">
                    <label for="floors">QAVATLAR SONI</label>
                    <select id="floors">
                        <option value="">Tanlang</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3+</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="input-group text-input">
                    <label for="budget">BUDJETINGIZ (y.e.da)</label>
                    <input type="text" id="budget" placeholder="Masalan: 50000 - 100000">
                </div>
                <div class="input-group">
                    <label for="property-type">UY TURI</label>
                    <select id="property-type">
                        <option value="">Tanlang</option>
                        <option value="apartment">Kvartira</option>
                        <option value="house">Uy</option>
                        <option value="land">Yer</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <button class="search-button">
                    <i class="bi bi-search"></i> QIDIRUV
                </button>
            </div>
        </div>
    </div>
</div>

<section class="categories-section">
    <div class="container">
        <div class="category-cards">
            <div class="card">
                <div class="icon-box">
                    <i class="bi bi-key"></i>
                </div>
                <span>IJARA</span>
            </div>
            <div class="card">
                <div class="icon-box">
                    <i class="bi bi-house"></i>
                </div>
                <span>SOTUV</span>
            </div>
            <div class="card">
                <div class="icon-box">
                    <i class="bi bi-laptop"></i>
                </div>
                <span>OFIS</span>
            </div>
            <div class="card">
                <div class="icon-box">
                    <i class="bi bi-door-open"></i>
                </div>
                <span>XONA</span>
            </div>
            <div class="card">
                <div class="icon-box">
                    <i class="bi bi-globe"></i>
                </div>
                <span>EXPATS</span>
            </div>
            <div class="card">
                <div class="icon-box">
                    <i class="bi bi-briefcase"></i>
                </div>
                <span>BUSINESS SPACE</span>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-background">
        <div class="container footer-content">
            <div class="footer-logo">
                <img src="https://via.placeholder.com/100x40?text=Estora" alt="Estora Logo">
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

<script src="js/script.js"></script>
</body>
</html>
