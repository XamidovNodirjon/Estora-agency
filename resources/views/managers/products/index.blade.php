<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcha e'lonlar | Menejer Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }

        .container-fluid {
            padding: 20px;
        }

        /* Yangi ranglar */
        .bg-dark-green {
            background-color: #013220;
        }

        .text-dark-green {
            color: #013220;
        }

        .bg-gold {
            background-color: #B9952F;
        }

        .text-gold {
            color: #B9952F;
        }

        .bg-dark-blue {
            background-color: #001F3F;
        }

        .text-dark-blue {
            color: #001F3F;
        }

        .bg-custom-red {
            background-color: #A30808;
        }

        .text-custom-red {
            color: #A30808;
        }

        .product-card {
            display: flex;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            background-color: #fff;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-image-wrapper {
            width: 300px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px 0 0 16px;
        }

        .card-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(1, 50, 32, 0.7); /* Dark green with opacity */
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1rem;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .overlay-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .overlay-profession {
            font-size: 0.9rem;
            font-weight: 400;
        }

        .card-img-nav {
            background: rgba(185, 149, 47, 0.7); /* Gold with opacity */
            color: #FFFFFF;
            border: none;
            padding: 8px;
            cursor: pointer;
            z-index: 10;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .card-img-nav.prev {
            left: 10px;
        }

        .card-img-nav.next {
            right: 10px;
        }

        .card-body {
            flex-grow: 1;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #010101; /* Black */
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 600;
            color: #B9952F; /* Gold */
            margin-bottom: 1rem;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.95rem;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
        }

        .meta-item i {
            margin-right: 8px;
            color: #001F3F; /* Dark blue */
        }

        .product-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .info-item {
            font-size: 0.9rem;
            color: #718096;
        }

        .info-item .label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.25rem;
        }

        .product-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: auto;
            padding-top: 1rem;
        }

        .phone-button {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            background-color: #013220; /* Dark green */
            color: #FFFFFF;
            border: none;
            transition: background-color 0.3s ease;
        }

        .phone-button:hover {
            background-color: #001F3F; /* Dark blue */
        }

        .phone-number {
            font-size: 1rem;
            color: #010101; /* Black */
            font-weight: 600;
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }

        .phone-number i {
            margin-right: 8px;
            color: #013220; /* Dark green */
        }

        .telegram-link {
            font-size: 1rem;
            color: #001F3F; /* Dark blue */
            font-weight: 600;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .telegram-link:hover {
            color: #013220; /* Dark green */
        }

        .telegram-link i {
            margin-right: 8px;
        }

        .btn-outline-primary {
            color: #013220; /* Dark green */
            border-color: #013220;
        }

        .btn-outline-primary:hover {
            background-color: #013220;
            color: #FFFFFF;
        }

        .card-images-container {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
        }

        .card-image {
            scroll-snap-align: start;
            flex: 0 0 auto;
        }

        .text-primary {
            color: #013220 !important; /* Dark green */
        }

        .alert-info {
            background-color: #e6f3ff; /* Light blue */
            border-color: #001F3F; /* Dark blue */
            color: #001F3F;
        }

        .alert-warning {
            background-color: #fff8e6; /* Light gold */
            border-color: #B9952F; /* Gold */
            color: #B9952F;
        }

        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
            }

            .card-image-wrapper {
                width: 100%;
                height: 250px;
                border-radius: 16px 16px 0 0;
            }

            .card-image {
                border-radius: 16px 16px 0 0;
            }

            .product-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .phone-number, .telegram-link {
                justify-content: center;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
@extends('layouts.managers_layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">Barcha e'lonlar</h5>
                        <a href="{{ route('manager-create-product') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus-circle me-1"></i> Yangi e'lon
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <span class="badge bg-light border text-dark p-2">Sizda mavjud ball:
                                    <strong class="text-gold">{{ $user->balls->amount ?? '0' }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('manager-products') }}" class="d-flex">
                                    <input type="text"
                                           name="search"
                                           class="form-control me-2"
                                           placeholder="ID yoki nom bo'yicha qidiring..."
                                           value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('manager-products') }}"
                                           class="btn btn-outline-secondary ms-1">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>

                        @if($products->isEmpty())
                            @if(request('search'))
                                <div class="alert alert-info text-center">
                                    "<strong>{{ request('search') }}</strong>" bo'yicha hech narsa topilmadi.
                                    <br>
                                    <a href="{{ route('manager-products') }}"
                                       class="btn btn-sm btn-outline-primary mt-2">
                                        Barcha e'lonlarni ko'rish
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning text-center">E'lonlar mavjud emas.</div>
                            @endif
                        @else
                            <div class="row g-4">
                                @foreach ($products as $product)
                                    <div class="col-12">
                                        <div class="product-card"
                                             onclick="window.location='{{ route('show-product', $product->id) }}'">
                                            <div class="card-image-wrapper" data-images='@json($product->images)'>
                                                <div class="card-images-container"
                                                     style="display: flex; width: 100%; height: 100%;">
                                                    @php
                                                        $images = json_decode($product->images, true) ?? [];
                                                    @endphp

                                                    @if(count($images))
                                                        @foreach($images as $image)
                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                 alt="{{ $product->name }}"
                                                                 class="card-image"
                                                                 style="width: 100%; height: 100%; flex-shrink: 0; object-fit: cover;">
                                                        @endforeach
                                                    @else
                                                        <img
                                                            src="https://placehold.co/600x400/CCCCCC/333333?text=Rasm+Yo%27q"
                                                            alt="No image"
                                                            class="card-image"
                                                            style="width: 100%; height: 100%;">
                                                    @endif
                                                </div>

                                                <div class="card-image-overlay">
                                                    <span class="overlay-name">ID: {{ $product->id }}</span>
                                                    <span class="overlay-profession">
                                                        @if($product->user) {{ $product->user->name }} @else N/A @endif
                                                    </span>
                                                </div>

                                                @if(count($images) > 1)
                                                    <button class="card-img-nav prev"><i
                                                            class="fas fa-chevron-left"></i></button>
                                                    <button class="card-img-nav next"><i
                                                            class="fas fa-chevron-right"></i></button>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <h5 class="product-title text-truncate">{{ $product->name ?? 'N/A' }}</h5>
                                                <div class="product-price">
                                                    ${{ number_format($product->price, 0, '.', ' ') }} USD
                                                </div>
                                                <div class="product-meta">
                                                    <div class="meta-item">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        {{ $product->region->name ?? 'N/A' }}
                                                        , {{ $product->city->name ?? 'N/A' }}
                                                    </div>
                                                    <div class="meta-item">
                                                        <i class="fas fa-bed"></i>{{ $product->rooms ?? '-' }} xona
                                                    </div>
                                                    <div class="meta-item">
                                                        <i class="fas fa-building"></i>
                                                        {{ $product->floor ?? '-' }}
                                                        /{{ $product->building_floor ?? '-' }} qavat
                                                    </div>
                                                    <div class="meta-item">
                                                        <i class="fas fa-ruler-combined"></i>{{ $product->square ?? '-' }}
                                                        m²
                                                    </div>
                                                </div>
                                                <div class="product-meta">
                                                    <div class="meta-item">
                                                        Kategoriya: {{ $product->category->name ?? 'N/A' }}
                                                        / {{ $product->subcategory->name ?? 'N/A' }}
                                                    </div>
                                                    <div class="meta-item">Qo'shimcha ma'lumotlar:
                                                        @if($product->repair) <span class="badge bg-secondary">Ta'mir bor</span> @endif
                                                        @if($product->sotix) <span class="badge bg-secondary">{{ $product->sotix }} sotix</span> @endif
                                                    </div>
                                                </div>

                                                <div class="product-actions mt-auto">
                                                    @if($product->isPhoneVisibleTo(auth()->user()))
                                                        <a href="tel:{{ $product->phone }}"
                                                           class="phone-number text-decoration-none me-3">
                                                            <i class="fas fa-phone"></i>{{ $product->phone }}
                                                        </a>
                                                    @else
                                                        <form action="{{ route('manager.reveal-phone', $product->id) }}"
                                                              method="POST"
                                                              class="d-inline w-100"
                                                              onclick="event.stopPropagation();">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-sm phone-button w-100">
                                                                <i class="fas fa-eye me-1"></i>
                                                                Telefon ko'rish (-1 ball)
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="https://t.me/{{ $product->telegram_username ?? '' }}"
                                                       class="telegram-link" target="_blank">
                                                        <i class="fab fa-telegram-plane"></i>Telegram
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if(method_exists($products, 'links'))
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.product-card').forEach(card => {
                const imgContainer = card.querySelector('.card-image-wrapper');
                if (!imgContainer) return;

                const imagesContainer = imgContainer.querySelector('.card-images-container');
                const images = Array.from(imagesContainer.querySelectorAll('.card-image'));
                const prevBtn = imgContainer.querySelector('.card-img-nav.prev');
                const nextBtn = imgContainer.querySelector('.card-img-nav.next');

                let currentImageIndex = 0;

                function showImage(index) {
                    images.forEach((img, i) => {
                        img.style.display = i === index ? 'block' : 'none';
                    });
                }

                // Boshlang'ich holatda faqat birinchi rasmni ko'rsatamiz
                showImage(currentImageIndex);

                if (prevBtn && nextBtn && images.length > 1) {
                    prevBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                        showImage(currentImageIndex);
                    });

                    nextBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        currentImageIndex = (currentImageIndex + 1) % images.length;
                        showImage(currentImageIndex);
                    });
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            // Rasm slaydshou funksiyasi
            document.querySelectorAll('.product-card').forEach(card => {
                const imgContainer = card.querySelector('.card-image-wrapper');
                if (!imgContainer) return;

                const prevBtn = card.querySelector('.card-img-nav.prev');
                const nextBtn = card.querySelector('.card-img-nav.next');
                const img = imgContainer.querySelector('.card-image');

                try {
                    const images = JSON.parse(imgContainer.dataset.images) || [];
                    let currentImageIndex = 0;

                    function updateImage() {
                        if (images.length > 0 && images[currentImageIndex]) {
                            const imagePath = images[currentImageIndex];
                            if (imagePath.startsWith('http://') || imagePath.startsWith('https://') || imagePath.startsWith('data:image/')) {
                                img.src = imagePath;
                            } else {
                                img.src = "{{ asset('storage/') }}/" + imagePath;
                            }
                        } else {
                            img.src = "https://placehold.co/600x400/CCCCCC/333333?text=Rasm+Yo%27q";
                        }
                    }

                    // Faqat bir nechta rasmlar bo'lsa navigatsiya tugmalarini ko'rsatish
                    if (images.length > 1) {
                        if (prevBtn) prevBtn.style.display = 'flex';
                        if (nextBtn) nextBtn.style.display = 'flex';
                    }

                    if (prevBtn && nextBtn) {
                        prevBtn.addEventListener('click', function (e) {
                            e.stopPropagation();
                            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                            updateImage();
                        });

                        nextBtn.addEventListener('click', function (e) {
                            e.stopPropagation();
                            currentImageIndex = (currentImageIndex + 1) % images.length;
                            updateImage();
                        });
                    }
                } catch (e) {
                    console.error("Rasmlarni yuklashda xatolik:", e);
                }
            });
        });
    </script>
@endsection
</body>
</html>
