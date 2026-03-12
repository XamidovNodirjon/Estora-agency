@extends('layouts.admin_layout')

@section('content')
    <style>
        .client-profile-header {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            border-radius: 16px;
            color: white;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 31, 63, 0.1);
        }

        .client-initial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: #FFD700;
            color: #001f3f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 800;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        .info-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
        }

        .product-grid-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .product-grid-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.1);
        }

        .product-img-wrapper {
            position: relative;
            height: 180px;
            background: #f8fafc;
        }

        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            backdrop-filter: blur(4px);
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: #003366;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-sold {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Back Button -->
        <a href="{{ route('clients') }}" class="btn btn-outline-dark rounded-pill mb-4">
            <i class="fas fa-arrow-left me-2"></i> Orqaga qaytish
        </a>

        <!-- Header Section -->
        <div class="client-profile-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="client-initial-avatar">
                        {{ strtoupper(substr($client->name, 0, 1)) }}
                    </div>
                </div>
                <div class="col">
                    <h1 class="mb-1 fw-bold">{{ $client->name }}</h1>
                    <div class="d-flex flex-wrap gap-4 mt-2">
                        <span class="d-flex align-items-center opacity-75">
                            <i class="fas fa-phone-alt me-2"></i> {{ $client->phone ?? '-' }}
                        </span>
                        <span class="d-flex align-items-center opacity-75">
                            <i class="fas fa-envelope me-2"></i> {{ $client->email ?? '-' }}
                        </span>
                        <span class="d-flex align-items-center opacity-75">
                            <i class="fas fa-calendar-alt me-2"></i> Ro'yxatdan o'tdi:
                            {{ $client->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bg-white bg-opacity-10 p-4 rounded-4 text-center">
                        <div class="text-white-50 small text-uppercase fw-bold mb-1">E'lonlar soni</div>
                        <div class="h2 mb-0 fw-bold">{{ $client->products->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Section -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-label">Pasport Ma'lumotlari</div>
                    <div class="info-value">{{ $client->passport ?? 'Kiritilmagan' }}</div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-label">JShShIR</div>
                    <div class="info-value">{{ $client->jshshir ?? 'Kiritilmagan' }}</div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="info-label">Akkaunt Holati</div>
                        <div class="info-value text-success">
                            <i class="fas fa-check-circle me-1"></i> Faol
                        </div>
                    </div>
                    <button class="btn btn-sm btn-outline-warning rounded-pill px-3">Tahrirlash</button>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <h3 class="fw-bold mb-4 d-flex align-items-center text-dark">
            <span class="bg-primary rounded-pill me-3" style="width: 8px; height: 32px; display: inline-block;"></span>
            Mijozning e'lonlari
        </h3>

        @if($client->products->count() > 0)
            <div class="row g-4">
                @foreach($client->products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-grid-card">
                            <div class="product-img-wrapper">
                                @php
                                    $firstImg = $product->productImages->first() ? $product->productImages->first()->path : 'https://placehold.co/400x300?text=No+Image';
                                @endphp
                                <img src="{{ asset('storage/' . $firstImg) }}" alt="{{ $product->name }}"
                                    onerror="this.src='https://placehold.co/400x300?text=Rasm+yo\'q'">
                                <span class="product-badge status-active">
                                    {{ $product->status ?? 'Faol' }}
                                </span>
                            </div>
                            <div class="p-4">
                                <div class="text-muted small mb-1">{{ $product->category->name ?? 'Kategoriyasiz' }}</div>
                                <h5 class="fw-bold mb-3 text-truncate">{{ $product->name }}</h5>
                                <div class="d-flex align-items-center mb-4 text-muted small">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    {{ $product->region->name ?? '-' }}, {{ $product->city->name ?? '-' }}
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div class="product-price">{{ number_format($product->price, 0, '.', ' ') }} $</div>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary rounded-circle p-2"
                                        style="width: 38px; height: 38px;">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-2130356-1800917.png" alt="Empty"
                    style="width: 280px; opacity: 0.6;">
                <p class="text-muted mt-4 fs-5">Mijoz hozircha hech qanday e'lon bermagan.</p>
            </div>
        @endif
    </div>
@endsection