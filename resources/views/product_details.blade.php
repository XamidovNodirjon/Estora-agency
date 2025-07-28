<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency - {{ $product->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/product_details.css') }}">

</head>
<body>
<div class="hero-section hero-small">
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
            <button class="close-menu">&times;</button>
            <ul>
                <li><a href="#" class="mobile-login-btn">Login</a></li>
            </ul>
        </div>
    </div>
</div>

<section class="product-details-section">
    <div class="container">
        <div class="product-header">
            <h1>{{ $product->name }}</h1>
            <p class="product-id">ID: <strong>{{ $product->id }}</strong></p>
        </div>

        <div class="product-gallery">
            <div class="image-viewer-container" style="position: relative; max-width: 800px; margin: 0 auto;">
                {{-- `image_array` accessoridan foydalanamiz --}}
                @if(count($product->image_array) > 0)
                    <img src="{{ asset('storage/' . $product->image_array[0]) }}" alt="{{ $product->name }}" class="main-image">
                @else
                    <img src="https://placehold.co/800x600/CCCCCC/333333?text=Rasm+Yoq" alt="No Image" class="main-image">
                @endif
                <button class="nav-button prev-button" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background: #F7931E; color: white; border: none; padding: 10px 15px; border-radius: 50%; cursor: pointer; font-size: 1.5em; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="nav-button next-button" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: #F7931E; color: white; border: none; padding: 10px 15px; border-radius: 50%; cursor: pointer; font-size: 1.5em; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            <div class="thumbnail-images">
                @foreach($product->image_array as $index => $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Product thumbnail" class="thumbnail" data-index="{{ $index }}">
                @endforeach
            </div>
        </div>

        <div class="product-info-grid">
            <div class="info-block">
                <h4>Narxi</h4>
                <p class="price">{{ number_format($product->price, 0, '.', ' ') }} y.e.</p>
            </div>
            <div class="info-block">
                <h4>Manzil</h4>
                <p>{{ $product->region->name ?? 'Noma\'lum hudud' }}, {{ $product->city->name ?? 'Noma\'lum shahar' }}</p>
            </div>
            @if($product->rooms > 0)
                <div class="info-block">
                    <h4>Xonalar soni</h4>
                    <p>{{ $product->rooms }}</p>
                </div>
            @endif
            @if($product->floor > 0 || $product->building_floor > 0)
                <div class="info-block">
                    <h4>Qavat</h4>
                    <p>
                        @if($product->floor > 0) {{ $product->floor }} @endif
                        @if($product->floor > 0 && $product->building_floor > 0) / @endif
                        @if($product->building_floor > 0) {{ $product->building_floor }} @endif
                    </p>
                </div>
            @endif
            @if($product->square > 0)
                <div class="info-block">
                    <h4>Maydon</h4>
                    <p>{{ $product->square }} m²</p>
                </div>
            @endif
            @if($product->sotix > 0)
                <div class="info-block">
                    <h4>Sotix</h4>
                    <p>{{ $product->sotix }}</p>
                </div>
            @endif
            @if($product->repair)
                <div class="info-block">
                    <h4>Ta'mir holati</h4>
                    <p>{{ $product->repair }}</p>
                </div>
            @endif
            <div class="info-block">
                <h4>Kategoriya</h4>
                <p>
                    {{ $product->category->name ?? 'Noma\'lum' }}
                    @if($product->subcategory)
                        / {{ $product->subcategory->name }}
                    @endif
                </p>
            </div>
        </div>

        <div class="product-description">
            <h3>Tavsif</h3>
            <p>{{ $product->description ?? 'Tavsif mavjud emas.' }}</p>
        </div>

        <div class="product-actions-bottom">
            <button class="quick-contact-button" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                <i class="bi bi-headset"></i> Tezkor Bog'lanish
            </button>
            {{-- Oldingi filterlarni saqlagan holda qaytish --}}
            <a href="{{ route('products.filter', request()->query()) }}" class="back-to-results">
                <i class="bi bi-arrow-left"></i> Natijalarga qaytish
            </a>
        </div>
    </div>
</section>

<section class="related-listings-section">
    <div class="container">
        {{-- Joriy mahsulotning viloyati bo'yicha sarlavha --}}
        <h2>{{ $product->region->name ?? 'Noma\'lum hudud' }} viloyatidagi boshqa e'lonlar</h2>
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
            <div class="related-listings-grid">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="related-listing-card">
                        {{-- `image_array` accessoridan foydalanamiz --}}
                        <img src="{{ count($relatedProduct->image_array) > 0 ? asset('storage/' . $relatedProduct->image_array[0]) : 'https://placehold.co/600x400/CCCCCC/333333?text=Rasm+Yoq' }}"
                             alt="{{ $relatedProduct->name }}">
                        <h3>{{ $relatedProduct->name }}</h3>
                        <p class="related-price">{{ number_format($relatedProduct->price, 0, '.', ' ') }} y.e.</p>
                    </a>
                @endforeach
            </div>
        @else
            <p style="text-align: center; color: #666;">Ushbu hududda boshqa e'lonlar topilmadi.</p>
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
        <span class="close-button">&times;</span>
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
        const quickContactButton = document.querySelector('.quick-contact-button');
        const quickContactModal = document.getElementById('quickContactModal');
        const closeModalButton = quickContactModal.querySelector('.close-button');
        const modalProductName = quickContactModal.querySelector('.modal-product-name');
        const contactForm = quickContactModal.querySelector('#contactForm');

        if (quickContactButton) {
            quickContactButton.addEventListener('click', function () {
                const productName = this.dataset.productName;
                const productId = this.dataset.productId;

                modalProductName.textContent = `E'lon: ${productName} (ID: ${productId})`;
                const contactPhoneInput = quickContactModal.querySelector('#contactPhone');
                contactPhoneInput.value = ''; // Ensure phone input is always empty

                quickContactModal.style.display = 'flex';
            });
        }

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

        const mainImage = document.querySelector('.main-image');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const prevButton = document.querySelector('.prev-button');
        const nextButton = document.querySelector('.next-button');

        const allImages = [
            @foreach($product->image_array as $image)
                "{{ asset('storage/' . $image) }}",
            @endforeach
        ];
        let currentIndex = 0; 

        function updateMainImageAndThumbnails(newIndex) {
            if (mainImage && allImages.length > 0) {
                currentIndex = (newIndex + allImages.length) % allImages.length;
                if (currentIndex < 0) { 
                    currentIndex = allImages.length - 1;
                }

                mainImage.style.opacity = '0';

                setTimeout(() => {
                    mainImage.src = allImages[currentIndex];
                    mainImage.style.opacity = '1';
                }, 300);

                thumbnails.forEach((thumb, idx) => {
                    if (idx === currentIndex) {
                        thumb.style.borderColor = '#007bff';
                    } else {
                        thumb.style.borderColor = '#ddd';
                    }
                });
            }
        }

        if (allImages.length > 0) {
            updateMainImageAndThumbnails(0); 
        }

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                const clickedIndex = parseInt(this.dataset.index);
                updateMainImageAndThumbnails(clickedIndex);
            });
        });

        if (prevButton) {
            prevButton.addEventListener('click', function () {
                updateMainImageAndThumbnails(currentIndex - 1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', function () {
                updateMainImageAndThumbnails(currentIndex + 1);
            });
        }
    });
</script>
</body>
</html>
