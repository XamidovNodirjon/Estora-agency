@extends('layouts.client_layout')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title m-0">Barcha e'lonlar</h1>
</div>

<div class="row g-4">
    @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-decoration-none">
                <a href="{{ url('/products/' . $product->id) }}" target="_blank" class="d-block w-100 position-relative bg-light" style="height: 200px;">
                    @if($product->productImages->count() > 0)
                        <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                            <i class="bi bi-image" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-success shadow-sm">{{ $product->category->name ?? 'N/A' }}</span>
                    </div>
                </a>
                
                <div class="card-body p-3">
                    <h5 class="card-title text-truncate fw-bold mb-1" style="color: #1e293b; font-size: 16px;">
                        {{ $product->name }}
                    </h5>
                    <p class="text-muted small mb-2 text-truncate">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                        {{ $product->region->name ?? '' }}, {{ $product->city->name ?? '' }}
                    </p>
                    <div class="d-flex align-items-center gap-3 small text-muted mb-3">
                        <span><i class="bi bi-textarea-resize me-1"></i>{{ $product->square ?? 0 }} m²</span>
                        <span><i class="bi bi-door-open me-1"></i>{{ $product->rooms ?? 0 }} Xona</span>
                    </div>
                    
                    <div class="fw-bold fs-5 text-dark mt-auto">
                        ${{ number_format((float) $product->price, 0, '.', ' ') }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 py-5 text-center text-muted">
            <i class="bi bi-folder-x fs-1 mb-3 d-block"></i>
            Hozircha e'lonlar mavjud emas
        </div>
    @endforelse
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection
