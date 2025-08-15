@extends('layouts.admin_layout')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">{{ __('Product Details') }}</h2>
            <div>
                <a href="{{ route('edit-product', $product->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-2"></i>{{ __('Edit') }}
                </a>
                <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('Back to List') }}
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-primary">{{ $product->name }}</h4>
                <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </div>

            <div class="card-body">
                <!-- Images Gallery -->
                @if($product->images)
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="main-image-container mb-3">
                                @php $images = json_decode($product->images, true); @endphp
                                <img src="{{ asset('storage/' . $images[0]) }}"
                                     class="img-fluid rounded-3 border shadow-sm"
                                     id="mainImage"
                                     alt="{{ __('Main Product Image') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail-container d-flex flex-column">
                                @foreach(array_slice($images, 0, 3) as $key => $image)
                                    <div class="thumbnail-item mb-2 {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image) }}"
                                             class="img-thumbnail cursor-pointer"
                                             onclick="changeMainImage(this)"
                                             alt="{{ __('Product Thumbnail') }}">
                                    </div>
                                @endforeach
                                @if(count($images) > 3)
                                    <div class="thumbnail-item position-relative">
                                        <img src="{{ asset('storage/' . $images[3]) }}"
                                             class="img-thumbnail"
                                             alt="{{ __('Product Thumbnail') }}">
                                        <div class="more-images-overlay">
                                            +{{ count($images) - 3 }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

            <!-- Basic Info Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-primary">
                                <i class="fas fa-info-circle me-2"></i>{{ __('Basic Information') }}
                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Category') }}:</span>
                                    <span class="info-value">{{ $product->category->name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Subcategory') }}:</span>
                                    <span class="info-value">{{ $product->subcategory->name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Type') }}:</span>
                                    <span class="info-value text-capitalize">{{ $product->name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Status') }}:</span>
                                    <span class="info-value badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-primary">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ __('Location') }}
                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Region') }}:</span>
                                    <span class="info-value">{{ $product->region->name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('City/District') }}:</span>
                                    <span class="info-value">{{ $product->city->name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Address') }}:</span>
                                    <span class="info-value">{{ $product->address ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Published') }}:</span>
                                    <span class="info-value">{{ $product->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price and Contact Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-success">
                                <i class="fas fa-tag me-2"></i>{{ __('Pricing') }}
                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Price') }}:</span>
                                    <span class="info-value fw-bold text-success">
                                        {{ number_format($product->price, 0, ',', ' ') }} {{ __('sum') }}
                                    </span>
                                </div>
                                @if($product->sotix)
                                    <div class="info-item">
                                        <span class="info-label">{{ __('Sotix') }}:</span>
                                        <span class="info-value">{{ $product->sotix }}</span>
                                    </div>
                                @endif
                                <div class="info-item">
                                    <span class="info-label">{{ __('Payment Options') }}:</span>
                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                        @if($product->exchange)
                                            <span class="badge bg-info">{{ __('Exchange') }}</span>
                                        @endif
                                        @if($product->pay_in_installments)
                                            <span class="badge bg-info">{{ __('Installments') }}</span>
                                        @endif
                                        @if($product->credit)
                                            <span class="badge bg-info">{{ __('Credit') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-info">
                                <i class="fas fa-phone-alt me-2"></i>{{ __('Contact') }}
                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Phone') }}:</span>
                                    <span class="info-value">
                                        @if($product->isPhoneVisibleTo(auth()->user()))
                                            <a href="tel:{{ $product->phone }}" class="text-decoration-none">
                                                {{ $product->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">{{ __('Hidden') }}</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Contact Name') }}:</span>
                                    <span class="info-value">{{ $product->contact_name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">{{ __('Email') }}:</span>
                                    <span class="info-value">
                                        @if($product->email)
                                            <a href="mailto:{{ $product->email }}" class="text-decoration-none">
                                                {{ $product->email }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details Section -->
                <div class="info-card mb-4">
                    <h5 class="info-card-header bg-light-warning">
                        <i class="fas fa-home me-2"></i>{{ __('Property Details') }}
                    </h5>
                    <div class="info-card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Floor') }}:</span>
                                    <span class="info-value">{{ $product->floor }}/{{ $product->building_floor }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Square') }}:</span>
                                    <span class="info-value">{{ $product->square }} m<sup>2</sup></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Rooms') }}:</span>
                                    <span class="info-value">{{ $product->rooms }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Repair') }}:</span>
                                    <span class="info-value text-capitalize">{{ $product->repair }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Year Built') }}:</span>
                                    <span class="info-value">{{ $product->year_built ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label">{{ __('Condition') }}:</span>
                                    <span class="info-value">{{ $product->condition ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="info-card mb-4">
                    <h5 class="info-card-header bg-light-secondary">
                        <i class="fas fa-align-left me-2"></i>{{ __('Description') }}
                    </h5>
                    <div class="info-card-body">
                        <div class="info-item">
                            <p class="info-description">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Features Section -->
                @if($product->features)
                    <div class="info-card">
                        <h5 class="info-card-header bg-light-info">
                            <i class="fas fa-star me-2"></i>{{ __('Features') }}
                        </h5>
                        <div class="info-card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(json_decode($product->features, true) as $feature)
                                    <span class="badge bg-primary">{{ $feature }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Main Card Styling */
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        /* Image Gallery Styling */
        .main-image-container {
            height: 350px;
            overflow: hidden;
            border-radius: 8px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image-container img {
            max-height: 100%;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        .thumbnail-container {
            height: 350px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .thumbnail-item {
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 6px;
            overflow: hidden;
        }

        .thumbnail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .thumbnail-item.active {
            border: 2px solid var(--bs-primary);
        }

        .thumbnail-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .more-images-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Info Card Styling */
        .info-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            height: 100%;
        }

        .info-card-header {
            padding: 12px 16px;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .bg-light-primary {
            background-color: rgba(13,110,253,0.1);
            color: #0d6efd;
        }

        .bg-light-success {
            background-color: rgba(25,135,84,0.1);
            color: #198754;
        }

        .bg-light-info {
            background-color: rgba(13,202,240,0.1);
            color: #0dcaf0;
        }

        .bg-light-warning {
            background-color: rgba(255,193,7,0.1);
            color: #ffc107;
        }

        .bg-light-secondary {
            background-color: rgba(108,117,125,0.1);
            color: #6c757d;
        }

        .info-card-body {
            padding: 16px;
        }

        .info-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #eee;
        }

        .info-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            display: inline-block;
            min-width: 120px;
        }

        .info-value {
            color: #333;
        }

        .info-description {
            white-space: pre-line;
            line-height: 1.6;
            color: #444;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-image-container {
                height: 250px;
            }

            .thumbnail-container {
                height: auto;
                flex-direction: row !important;
                overflow-x: auto;
                overflow-y: hidden;
                padding-bottom: 8px;
            }

            .thumbnail-item {
                min-width: 80px;
                height: 80px;
                margin-right: 8px;
                margin-bottom: 0;
            }

            .thumbnail-item img {
                height: 80px;
            }
        }
    </style>

    <script>
        function changeMainImage(element) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.classList.remove('active');
            });
            element.parentElement.classList.add('active');
        }
    </script>
@endsection
