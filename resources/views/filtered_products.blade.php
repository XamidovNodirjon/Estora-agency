<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency - Natijalar</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/filter_product.css') }}">

</head>
<body>
<header class="header">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('/logo/Estora Logo.png') }}" alt="Estora Logo">
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
        <button class="close-menu">×</button>
        <ul>
            <li><a href="#" class="mobile-login-btn">Login</a></li>
        </ul>
    </div>
</div>

<div class="search-form-card">
    <h2>Qidiruv Natijalari</h2>
    <form action="{{ route('products.filter') }}" method="GET">
        <div class="search-form-grid">
            <div class="form-group">
                <label for="type">E'lon turi:</label>
                <select name="type" id="type">
                    <option value="">Hammasi</option>
                    <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>Sotuv</option>
                    <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>Ijara</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Mulk turi:</label>
                <select name="category" id="category">
                    <option value="">Hammasi</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rooms">Xonalar soni:</label>
                <select name="rooms" id="rooms">
                    <option value="">Hammasi</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('rooms') == $i ? 'selected' : '' }}>{{ $i }} xona</option>
                    @endfor
                    <option value="5+" {{ request('rooms') == '5+' ? 'selected' : '' }}>5+ xona</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price_from">Narx (dan):</label>
                <input type="text" name="price_from" id="price_from" value="{{ request('price_from') }}"
                       placeholder="minimal narx">
            </div>
            <div class="form-group">
                <label for="price_to">Narx (gacha):</label>
                <input type="text" name="price_to" id="price_to" value="{{ request('price_to') }}"
                       placeholder="maksimal narx">
            </div>
            <div class="form-group">
                <label for="region">Hudud:</label>
                <select name="region" id="region">
                    <option value="">Hammasi</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="more-filters-hidden" style="display: none;">
                <div class="form-group">
                    <label for="floors">Qavatlar soni:</label>
                    <select name="floors" id="floors">
                        <option value="">Hammasi</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('floors') == $i ? 'selected' : '' }}>{{ $i }} qavat</option>
                        @endfor
                        <option value="6+" {{ request('floors') == '6+' ? 'selected' : '' }}>6+ qavat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="property_type">Uy turi:</label>
                    <select name="property_type" id="property_type">
                        <option value="">Hammasi</option>
                        <option value="apartment" {{ request('property_type') == 'apartment' ? 'selected' : '' }}>Kvartira</option>
                        <option value="house" {{ request('property_type') == 'house' ? 'selected' : '' }}>Uy / Yer</option>
                        <option value="commercial" {{ request('property_type') == 'commercial' ? 'selected' : '' }}>Tijorat binosi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="filter-actions">
            <button type="button" class="more-filters-btn">
                <i class="bi bi-funnel-fill"></i> Ko'proq filterlar
            </button>
            <div class="filter-buttons">
                <button type="button" class="map-view-btn">
                    <i class="bi bi-geo-alt-fill"></i> Xaritadan ko'rish
                </button>
                <button type="submit" class="show-ads-btn">
                    <i class="bi bi-search"></i> Ko'rish {{ $filteredProducts->total() }} e'lonlar
                </button>
            </div>
        </div>
    </form>
</div>

<section class="ads-listing-section">
    <div class="container">
        <h2>Topilgan e'lonlar</h2>
        @if($filteredProducts->isEmpty())
            <p class="no-results">Hech qanday e'lon topilmadi. Boshqa filterlarni sinab ko'ring.</p>
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
                            <p class="ad-price">{{ number_format($product->price, 0, '.', ' ') }} y.e.</p>
                            <p class="ad-location"><i
                                    class="bi bi-geo-alt-fill"></i> {{ $product->region->name ?? 'Noma\'lum hudud' }}
                            </p>
                            <div class="ad-details">
                                @if($product->rooms > 0)
                                    <span><i class="bi bi-grid-fill"></i> {{ $product->rooms }} xona</span>
                                @endif
                                @if($product->building_floor > 0)
                                    <span><i class="bi bi-building"></i> {{ $product->floor }}/{{ $product->building_floor }} qavat</span>
                                @endif
                                @if($product->square > 0)
                                    <span><i class="bi bi-rulers"></i> {{ $product->square }} m²</span>
                                @endif
                                @if($product->sotix > 0)
                                    <span><i class="bi bi-bounding-box"></i> {{ $product->sotix }} sotix</span>
                                @endif
                            </div>
                            <p class="ad-category">
                                Kategoriya: {{ $product->category->name ?? 'Noma\'lum' }}
                                @if($product->subcategory)
                                    / {{ $product->subcategory->name }}
                                @endif
                            </p>
                            <p class="product-id">ID: <strong>{{ $product->id }}</strong></p>
                            <div class="ad-actions">
                                <a href="{{ route('products.show', $product->id) }}" class="view-ad-button">Batafsil</a>
                                <button class="quick-contact-button" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}">
                                    <i class="bi bi-headset"></i> Tezkor Bog'lanish
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-links">
                <div class="pagination-info">
                    {{ $filteredProducts->firstItem() }} dan {{ $filteredProducts->lastItem() }} gacha,
                    jami {{ $filteredProducts->total() }} natija
                </div>
                <nav aria-label="Pagination">
                    @if ($filteredProducts->onFirstPage())
                        <span class="page-link disabled" aria-disabled="true">
                                <i class="bi bi-chevron-left"></i> Oldingi
                            </span>
                    @else
                        <a href="{{ $filteredProducts->previousPageUrl() }}" class="page-link">
                            <i class="bi bi-chevron-left"></i> Oldingi
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
                            Keyingi <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span class="page-link disabled" aria-disabled="true">
                                Keyingi <i class="bi bi-chevron-right"></i>
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
                <img src="{{ asset('/logo/Estora Logo.png') }}" alt="Estora Logo">
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

<div id="quickContactModal" class="modal">
    <div class="modal-content">
        <span class="close-button">×</span>
        <h3>Tezkor Bog'lanish</h3>
        <p class="modal-product-name"></p>
        <form id="contactForm">
            <div class="form-group">
                <label for="contactName">Ismingiz:</label>
                <input type="text" id="contactName" name="name" required>
            </div>
            <div class="form-group">
                <label for="contactPhone">Telefon raqamingiz:</label>
                <input type="tel" id="contactPhone" name="phone" placeholder="+998 XX YYY ZZ ZZ" required>
            </div>
            <button type="submit" class="submit-contact-button">Yuborish</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile Menu Toggle
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

        // Quick Contact Modal
        const quickContactButtons = document.querySelectorAll('.quick-contact-button');
        const quickContactModal = document.getElementById('quickContactModal');
        const closeModalButton = quickContactModal.querySelector('.close-button');
        const modalProductName = quickContactModal.querySelector('.modal-product-name');
        const contactForm = quickContactModal.querySelector('#contactForm');

        quickContactButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productName = this.dataset.productName;
                const productId = this.dataset.productId;

                modalProductName.textContent = `E'lon: ${productName} (ID: ${productId})`;
                const contactPhoneInput = quickContactModal.querySelector('#contactPhone');
                contactPhoneInput.value = ''; // Ensure phone input is always empty

                quickContactModal.style.display = 'flex';
            });
        });

        closeModalButton.addEventListener('click', function () {
            quickContactModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target == quickContactModal) {
                quickContactModal.style.display = 'none';
            }
        });

        contactForm.addEventListener('submit', function (event) {
            event.preventDefault();
            console.log('Murojaatingiz yuborildi! Tez orada siz bilan bog\'lanamiz.'); 
            quickContactModal.style.display = 'none';
            contactForm.reset();
        });

        // More Filters Toggle
        const moreFiltersBtn = document.querySelector('.more-filters-btn');
        const moreFiltersHidden = document.querySelector('.more-filters-hidden');

        if (moreFiltersBtn && moreFiltersHidden) {
            moreFiltersBtn.addEventListener('click', function () {
                if (moreFiltersHidden.style.display === 'none' || moreFiltersHidden.style.display === '') {
                    moreFiltersHidden.style.display = 'grid';
                    moreFiltersBtn.innerHTML = '<i class="bi bi-funnel-fill"></i> Kamroq filterlar';
                } else {
                    moreFiltersHidden.style.display = 'none';
                    moreFiltersBtn.innerHTML = '<i class="bi bi-funnel-fill"></i> Ko\'proq filterlar';
                }
            });
        }

        // Image Gallery Navigation for each ad card
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

                    adImage.style.opacity = '0'; // Fade out

                    setTimeout(() => {
                        adImage.src = "{{ asset('storage/') }}/" + allImages[currentIndex];
                        adImage.style.opacity = '1'; // Fade in
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
    });
</script>
</body>
</html>
