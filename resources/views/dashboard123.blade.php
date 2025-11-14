<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        :root {
            --primary: #1a3c34;
            --secondary: #F7931E;
            --accent: #007bff;
            --success: #28a745;
            --light: #f8f9fa;
            --gray: #6c757d;
            --dark: #343a40;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f5f6f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
        .header {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo img {
            height: 40px;
        }

        .logo span {
            font-weight: 700;
            color: var(--primary);
        }

        .phone-btn {
            background: var(--secondary);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .phone-btn:hover {
            background: #e07b00;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        /* Hero + Filter */
        .search-hero {
            position: relative;
            height: 400px;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/dashboard.png') }}') center/cover no-repeat;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 80px;
        }

        .search-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .search-form-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2rem;
            margin: -80px auto 2rem;
            max-width: 1100px;
            position: relative;
            z-index: 10;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            font-size: 0.9375rem;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }

        .filter-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.3s;
        }

        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: #0056b3; }

        .btn-secondary { background: var(--secondary); color: white; }
        .btn-secondary:hover { background: #e07b00; }

        .btn-outline {
            background: transparent;
            color: var(--accent);
            border: 1px solid var(--accent);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: white;
        }

        /* Ads Grid */
        .ads-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .ad-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .ad-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .image-gallery {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .ad-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s;
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
        }

        .ad-card:hover .nav-btn { opacity: 1; }

        .prev-btn { left: 10px; }
        .next-btn { right: 10px; }

        .ad-info {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .ad-price {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--success);
            margin-bottom: 0.5rem;
        }

        .ad-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .ad-location {
            font-size: 0.875rem;
            color: #666;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-bottom: 0.75rem;
        }

        .ad-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .detail-item {
            background: #f1f1f1;
            padding: 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .ad-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
        }

        .btn-view {
            flex: 1;
            background: var(--accent);
            color: white;
        }

        .btn-contact {
            flex: 1;
            background: var(--secondary);
            color: white;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(8px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            position: relative;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.75rem;
            color: #aaa;
            cursor: pointer;
        }

        .success-icon svg {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header .container { flex-direction: column; gap: 1rem; }
            .menu-icon { display: block; }
            .form-grid { grid-template-columns: 1fr; }
            .filter-actions { flex-direction: column; }
            .ad-details { grid-template-columns: 1fr 1fr; }
            .ad-actions { flex-direction: column; }
        }
    </style>
</head>
<body>

@include('layouts.header')

<!-- HERO + FILTER (ALOHIDA) -->
<div class="search-hero">
    <div class="container">
        <h1>{{ __('Jami natijalar') }}: {{ $filteredProducts->total() }}</h1>
        <p>{{ __('Qayerda yashashni emas, qanday yashashni birga tanlaymiz.') }}</p>
    </div>
</div>

<div class="container">
    <div class="search-form-card">
        <h2 class="text-xl font-bold mb-6 text-center">{{ __('Qidiruv filtrlari') }}</h2>
        <form action="{{ route('products.filter') }}" method="GET">
            <div class="form-grid">
                <div class="form-group">
                    <label for="ad_type">{{ __('E\'lon turi') }}</label>
                    <select name="ad_type" id="ad_type" class="form-control">
                        <option value="All">{{ __('Hammasi') }}</option>
                        <option value="sale" {{ request('ad_type') == 'sale' ? 'selected' : '' }}>{{ __('Sotish') }}</option>
                        <option value="rent" {{ request('ad_type') == 'rent' ? 'selected' : '' }}>{{ __('Ijaraga') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="property_type">{{ __('Mulk turi') }}</label>
                    <select name="property_type" id="property_type" class="form-control">
                        <option value="All">{{ __('Hammasi') }}</option>
                        <option value="apartment" {{ request('property_type') == 'apartment' ? 'selected' : '' }}>{{ __('Kvartira') }}</option>
                        <option value="house" {{ request('property_type') == 'house' ? 'selected' : '' }}>{{ __('Uy/Hovli') }}</option>
                        <option value="land" {{ request('property_type') == 'land' ? 'selected' : '' }}>{{ __('Yer') }}</option>
                        <option value="commercial" {{ request('property_type') == 'commercial' ? 'selected' : '' }}>{{ __('Tijorat') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rooms">{{ __('Xonalar') }}</label>
                    <select name="rooms" id="rooms" class="form-control">
                        <option value="All">{{ __('Hammasi') }}</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{ $i }}" {{ request('rooms') == $i ? 'selected' : '' }}>{{ $i }} xona</option>
                        @endfor
                        <option value="5+" {{ request('rooms') == '5+' ? 'selected' : '' }}>5+</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price_from">{{ __('Narxdan') }}</label>
                    <input type="number" name="price_from" id="price_from" class="form-control" placeholder="0" value="{{ request('price_from') }}">
                </div>
                <div class="form-group">
                    <label for="price_to">{{ __('Nargacha') }}</label>
                    <input type="number" name="price_to" id="price_to" class="form-control" placeholder="∞" value="{{ request('price_to') }}">
                </div>
                <div class="form-group">
                    <label for="region">{{ __('Hudud') }}</label>
                    <select name="region" id="region" class="form-control" onchange="fetchCities()">
                        <option value="All">{{ __('Hammasi') }}</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="city">{{ __('Shahar') }}</label>
                    <select name="city" id="city" class="form-control">
                        <option value="All">{{ __('Hammasi') }}</option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button type="button" class="btn btn-outline" id="moreFiltersBtn">
                    <i class="bi bi-funnel"></i> {{ __('Yana filterlar') }}
                </button>
                <div class="flex gap-3">
                    <button type="button" class="btn btn-outline">
                        <i class="bi bi-geo-alt"></i> {{ __('Xarita') }}
                    </button>
                    <button type="submit" class="btn btn-secondary">
                        <i class="bi bi-search"></i> {{ __('Qidirish') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ADS LISTING (ALOHIDA) -->
<section class="container py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">{{ __('Topilgan e\'lonlar') }}</h2>

    @if($filteredProducts->isEmpty())
        <p class="text-center text-gray-500 py-10">{{ __('Hech narsa topilmadi. Boshqa sozlamalarni sinab ko\'ring.') }}</p>
    @else
        <div class="ads-grid">
            @foreach($filteredProducts as $product)
                <article class="ad-card" x-data="{ images: @json($product->image_array ?? []), index: 0 }">
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="image-gallery">
                            <template x-for="(img, i) in images">
                                <img :src="'{{ asset('storage') }}/' + img" class="ad-image" x-show="index === i" x-transition>
                            </template>
                            @if(empty($product->image_array))
                                <img src="https://placehold.co/400x300?text=No+Image" class="ad-image">
                            @endif

                            <button @click.prevent="index = (index - 1 + images.length) % images.length" class="nav-btn prev-btn" x-show="images.length > 1">‹</button>
                            <button @click.prevent="index = (index + 1) % images.length" class="nav-btn next-btn" x-show="images.length > 1">›</button>
                        </div>
                    </a>

                    <div class="ad-info">
                        <div class="ad-price">{{ number_format($product->price) }} USD</div>
                        <h3 class="ad-title">{{ $product->name }}</h3>
                        <p class="ad-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            {{ $product->region->name ?? '' }}, {{ $product->city->name ?? '' }}
                        </p>

                        <div class="ad-details">
                            @if($product->rooms > 0)
                                <span class="detail-item"><i class="bi bi-door-open"></i> {{ $product->rooms }} xona</span>
                            @endif
                            @if($product->square > 0)
                                <span class="detail-item"><i class="bi bi-rulers"></i> {{ $product->square }} m²</span>
                            @endif
                            @if($product->floor > 0)
                                <span class="detail-item"><i class="bi bi-building"></i> {{ $product->floor }}/{{ $product->building_floor }}</span>
                            @endif
                        </div>

                        <div class="ad-actions">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-view">
                                {{ __('Batafsil') }}
                            </a>
                            <button class="btn btn-contact open-contact-modal"
                                    data-product-name="{{ $product->name }}"
                                    data-product-id="{{ $product->id }}">
                                {{ __('Aloqa' ) }}
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $filteredProducts->links() }}
        </div>
    @endif
</section>

<!-- MODALS -->
@include('modals.contact')
@include('modals.success')

<script>
    // Fetch cities
    function fetchCities() {
        const regionId = document.getElementById('region').value;
        const citySelect = document.getElementById('city');
        citySelect.innerHTML = '<option value="All">{{ __("Yuklanmoqda...") }}</option>';
        citySelect.disabled = true;

        if (regionId && regionId !== 'All') {
            fetch(`/get-cities/${regionId}`)
                .then(r => r.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="All">{{ __("Hammasi") }}</option>';
                    data.forEach(c => {
                        const opt = new Option(c.name, c.id);
                        if ('{{ request("city") }}' == c.id) opt.selected = true;
                        citySelect.add(opt);
                    });
                    citySelect.disabled = false;
                });
        } else {
            citySelect.innerHTML = '<option value="All">{{ __("Hammasi") }}</option>';
            citySelect.disabled = true;
        }
    }

    document.addEventListener('DOMContentLoaded', fetchCities);
</script>

</body>
</html>