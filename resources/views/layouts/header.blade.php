<header class="header-container bg-white shadow-md">
    <div class="top-bar flex justify-between items-center px-4 py-2 md:px-8 lg:px-16 border-b">
        <div class="social-icons flex gap-4">
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <div class="contact-info flex items-center gap-4 text-gray-600">
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

    <div class="main-header flex justify-between items-center px-4 py-4 md:px-8 lg:px-16">
        <div class="flex items-center gap-4">
            <button id="mobile-menu-toggle" class="mobile-menu-toggle text-gray-600 hover:text-gray-800 md:hidden">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="logo-container">
                <img src="/logo/logo-dashboard.png" alt="Estora Logo" class="h-10">
            </a>
        </div>

        @guest
            <nav class="desktop-nav hidden md:flex space-x-6">
            <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Ijara</a>
            <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Sotib olish</a>
            <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">NoBroker</a>
            <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Expats</a>
            <a href="#" class="nav-link text-gray-700 hover:text-yellow-600">Business Space</a>
        </nav>
        @endguest
        @auth
            
        @endauth
        

        <div class="header-actions flex items-center gap-4 lg:gap-6">

            @guest
                <div class="action-item flex items-center gap-2 text-gray-600 hover:text-yellow-600">
                <i class="fas fa-heart"></i>
                <span>Favourites</span>
            </div>

            <div class="currency-selector relative">
                <div class="action-item flex items-center gap-1 text-gray-600 hover:text-yellow-600 cursor-pointer">
                    <span class="font-medium">UZS</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
                <div class="currency-menu absolute right-0 mt-2 w-16 bg-white shadow-lg rounded hidden">
                    <a href="#" class="currency-option block px-2 py-1 text-gray-700 hover:bg-gray-100">USD</a>
                    <a href="#" class="currency-option block px-2 py-1 text-gray-700 hover:bg-gray-100">RUB</a>
                </div>
            </div>
            @endguest
            @auth
                
            @endauth

            <!-- <a href="{{ route('login.index') }}" class="post-ad-btn flex items-center gap-2 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                <i class="fas fa-plus"></i>
                <span>E'lon joylashtirish</span>
            </a> -->

            @guest
            <a href="{{ route('login.index') }}" class="user-action flex items-center gap-2 text-gray-600 hover:text-yellow-600">
                <i class="fas fa-user-circle text-2xl"></i>
                <span>Login</span>
            </a>
            @endguest
            @auth
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-action flex items-center gap-2 text-gray-600 hover:text-yellow-600">
                <i class="fas fa-sign-out-alt text-2xl"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
            
            <div class="language-selector relative">
                <div class="language-btn flex items-center gap-1 text-gray-600 hover:text-yellow-600 cursor-pointer">
                    <span class="flag-icon flag-icon-{{ app()->getLocale() === 'en' ? 'gb' : app()->getLocale() }}"></span>
                    <span>{{ strtoupper(app()->getLocale()) }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
                <div class="language-menu absolute right-0 mt-2 w-28 bg-white shadow-lg rounded hidden">
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

<div id="mobile-menu" class="mobile-menu fixed inset-0 bg-white z-50 hidden">
    <div class="mobile-menu-content h-full flex flex-col">
        <div class="mobile-menu-header p-4 border-b">
            <button id="close-menu-toggle" class="close-menu-btn text-2xl">&times;</button>
        </div>
        <nav class="mobile-nav flex-1 p-4">
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Bosh Sahifa</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Biz Haqimizda</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Yangiliklar</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Ijara</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Sotib olish</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">NoBroker</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Expats</a>
            <a href="#" class="mobile-nav-link block py-2 text-gray-700 hover:text-yellow-600">Business Space</a>
        </nav>
        <div class="mobile-actions p-4 border-t">
            @guest
            <a href="{{ route('login.index') }}" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-yellow-600">
                <i class="fas fa-user-circle"></i>
                <span>Login</span>
            </a>
            @endguest
            @auth
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-yellow-600">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            @endauth
            <a href="#" class="mobile-action-item flex items-center gap-2 py-2 text-gray-700 hover:text-yellow-600">
                <i class="fas fa-heart"></i>
                <span>Favourites</span>
            </a>
            <div class="mobile-action-item flex items-center gap-2 py-2 text-gray-700">
                <i class="fas fa-phone-alt"></i>
                <span>+998 (95) 160 64 46</span>
            </div>
            <div class="mobile-action-item flex items-center gap-2 py-2 text-gray-700">
                <i class="fas fa-envelope"></i>
                <span>info@estora.uz</span>
            </div>
        </div>
    </div>
</div>
