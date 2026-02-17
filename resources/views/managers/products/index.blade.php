@extends('layouts.managers_layout')

@section('content')
    <style>
        :root {
            --primary-color: #013220;
            /* Dark Green */
            --secondary-color: #B9952F;
            /* Gold */
            --dark-blue: #001F3F;
            --light-bg: #f8f9fa;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --card-hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f4f7f6;
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        .container-fluid {
            padding: 1.5rem;
        }

        /* --- Page Header & Stats --- */
        .page-header {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-title h4 {
            font-weight: 700;
            margin: 0;
            color: var(--dark-blue);
        }

        .header-title p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .balance-card {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(1, 50, 32, 0.3);
        }

        .balance-card i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            color: var(--secondary-color);
        }

        .balance-info {
            display: flex;
            flex-direction: column;
        }

        .balance-label {
            font-size: 0.75rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .balance-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        /* --- Search & Filter --- */
        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background-color: #fff;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(185, 149, 47, 0.1);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
        }

        .btn-new-product {
            background-color: var(--secondary-color);
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-new-product:hover {
            background-color: #a38125;
            transform: translateY(-2px);
            color: #fff;
            box-shadow: 0 4px 10px rgba(185, 149, 47, 0.3);
        }

        /* --- Product Card --- */
        .product-card-horizontal {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            display: flex;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .product-card-horizontal:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }

        .card-image-section {
            width: 300px;
            min-height: 220px;
            position: relative;
            background-color: #eee;
        }

        .card-img-slider,
        .card-img-single {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-img-single {
            display: block;
        }

        .slider-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s;
            color: var(--dark-blue);
            z-index: 2;
        }

        .card-image-section:hover .slider-nav-btn {
            opacity: 1;
        }

        .slider-prev {
            left: 10px;
        }

        .slider-next {
            right: 10px;
        }

        .id-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0, 31, 63, 0.85);
            /* Dark blue */
            color: #fff;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
            z-index: 1;
        }

        .card-content-section {
            flex: 1;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .product-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin: 0;
            line-height: 1.4;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--secondary-color);
            background: rgba(185, 149, 47, 0.1);
            padding: 4px 10px;
            border-radius: 8px;
            white-space: nowrap;
        }

        .product-location {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #555;
            background: #f8f9fa;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .feature-item i {
            color: var(--primary-color);
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 1rem;
        }

        .btn-reveal-phone {
            background-color: #e9ecef;
            color: var(--dark-blue);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .btn-reveal-phone:hover {
            background-color: var(--dark-blue);
            color: #fff;
        }

        .phone-display {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .btn-telegram {
            color: #0088cc;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-telegram:hover {
            color: #006699;
            text-decoration: underline;
        }

        .badge-repair {
            background-color: rgba(1, 50, 32, 0.1);
            color: var(--primary-color);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* --- Responsive --- */
        @media (max-width: 991px) {
            .product-card-horizontal {
                flex-direction: column;
            }

            .card-image-section {
                width: 100%;
                height: 250px;
            }

            .features-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .balance-card,
            .search-container {
                width: 100%;
                max-width: none;
            }

            .card-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-reveal-phone,
            .btn-telegram {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Header Section -->
        <div class="page-header">
            <div class="header-title">
                <h4>Barcha E'lonlar</h4>
                <p>Jami {{ $products->total() }} ta e'lon topildi</p>
            </div>

            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <form action="{{ route('manager-products') }}" method="GET">
                    <input type="text" name="search" class="search-input" placeholder="ID yoki nom bo'yicha qidiring..."
                        value="{{ request('search') }}">
                </form>
            </div>

            <div class="balance-card">
                <i class="fas fa-coins"></i>
                <div class="balance-info">
                    <span class="balance-label">Hisobingiz</span>
                    <span class="balance-amount">{{ $user->balls->amount ?? '0' }} ball</span>
                </div>
            </div>

            <a href="{{ route('manager-create-product') }}" class="btn-new-product">
                <i class="fas fa-plus"></i> Yangi E'lon
            </a>
        </div>

        <!-- Products List -->
        <div class="products-list">
            @forelse($products as $product)
                <div class="product-card-horizontal" onclick="window.location='{{ route('show-product', $product->id) }}'"
                    style="cursor: pointer;">
                    <!-- Image Section with Slider -->
                    <div class="card-image-section" onclick="event.stopPropagation();">
                        <span class="id-badge">ID: {{ $product->id }}</span>

                        @php
                            // Get images from relation or fallback to empty array
                            $images = $product->productImages->pluck('path')->toArray();
                            $hasMultiple = count($images) > 1;
                        @endphp

                        @if(count($images) > 0)
                            <div class="slider-wrapper" style="width: 100%; height: 100%; position: relative;">
                                <img src="{{ asset('storage/' . $images[0]) }}" class="card-img-single active-slide" data-index="0"
                                    alt="{{ $product->name }}">

                                {{-- Hidden images for JS logic --}}
                                @foreach($images as $index => $img)
                                    @if($index > 0)
                                        <img src="{{ asset('storage/' . $img) }}" class="card-img-single" style="display: none;"
                                            data-index="{{ $index }}" alt="{{ $product->name }}">
                                    @endif
                                @endforeach

                                @if($hasMultiple)
                                    <button class="slider-nav-btn slider-prev" onclick="changeSlide(this, -1, event)"><i
                                            class="fas fa-chevron-left"></i></button>
                                    <button class="slider-nav-btn slider-next" onclick="changeSlide(this, 1, event)"><i
                                            class="fas fa-chevron-right"></i></button>
                                @endif
                            </div>
                        @else
                            <img src="https://placehold.co/600x400/CCCCCC/333333?text=Rasm+Yo%27q" class="card-img-single"
                                alt="No image">
                        @endif
                    </div>

                    <!-- Content Section -->
                    <div class="card-content-section">
                        <div>
                            <div class="card-header-row">
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <div class="product-price">${{ number_format($product->price, 0, '.', ' ') }}</div>
                            </div>

                            <p class="product-location">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                                {{ $product->region->name ?? '-' }}, {{ $product->city->name ?? '-' }}
                            </p>

                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="fas fa-bed"></i> {{ $product->rooms ?? '-' }} xona
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-building"></i> {{ $product->floor }}/{{ $product->building_floor }} qavat
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-ruler-combined"></i> {{ $product->square ?? '-' }} m²
                                </div>
                                @if($product->repair)
                                    <div class="feature-item">
                                        <i class="fas fa-paint-roller"></i> Ta'mir bor
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-actions">
                            <div>
                                @if($product->isPhoneVisibleTo(auth()->user()))
                                    <a href="tel:{{ $product->phone }}" class="phone-display text-decoration-none"
                                        onclick="event.stopPropagation();">
                                        <i class="fas fa-phone-alt me-2 text-success"></i> {{ $product->phone }}
                                    </a>
                                @else
                                    <form action="{{ route('manager.reveal-phone', $product->id) }}" method="POST" class="d-inline"
                                        onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit" class="btn-reveal-phone">
                                            <i class="fas fa-eye"></i> Raqamni ko'rish (-1 ball)
                                        </button>
                                    </form>
                                @endif
                            </div>

                            @if(!empty($product->telegram_username))
                                <a href="https://t.me/{{ $product->telegram_username }}" target="_blank" class="btn-telegram"
                                    onclick="event.stopPropagation();">
                                    <i class="fab fa-telegram-plane fa-lg"></i> Telegram
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png"
                        alt="No products" style="max-width: 200px; opacity: 0.7;">
                    <h5 class="mt-3 text-muted">Hozircha e'lonlar mavjud emas</h5>
                    @if(request('search'))
                        <p class="text-muted">Qidiruv bo'yicha hech narsa topilmadi. <a
                                href="{{ route('manager-products') }}">Barchasini ko'rish</a></p>
                    @endif
                </div>
            @endforelse

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        function changeSlide(btn, direction, event) {
            event.stopPropagation();
            const wrapper = btn.closest('.slider-wrapper');
            const slides = wrapper.querySelectorAll('.card-img-single');
            let activeIndex = -1;

            slides.forEach((slide, index) => {
                if (slide.style.display !== 'none' && !slide.classList.contains('active-slide')) {
                    // This creates a failsafe if class logic fails, but relying on display
                }
                if (slide.style.display !== 'none') {
                    activeIndex = index;
                }
            });

            // Find currently visible slide
            for (let i = 0; i < slides.length; i++) {
                if (slides[i].style.display !== 'none') {
                    activeIndex = i;
                    break;
                }
            }

            let newIndex = activeIndex + direction;
            if (newIndex >= slides.length) newIndex = 0;
            if (newIndex < 0) newIndex = slides.length - 1;

            slides.forEach(slide => slide.style.display = 'none');
            slides[newIndex].style.display = 'block';
        }
    </script>
@endsection