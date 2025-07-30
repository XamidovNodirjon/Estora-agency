@extends('layouts.admin_layout')
@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Mahsulot Tafsilotlari</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Id:</strong> {{ $product->id }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Name:</strong> {{ $product->name }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Kategoriya:</strong> {{ $product->category->name ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Subkategoriya:</strong> {{ $product->subcategory->name ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Hudud:</strong> {{ $product->region->name ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Shahar/Tuman:</strong> {{ $product->city->name ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Narx:</strong> {{ number_format($product->price, 0, ',', ' ') }} so'm
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Telefon:</strong>
                        @if($product->isPhoneVisibleTo(auth()->user()))
                            {{ $product->phone }}
                        @else
                            <span class="text-muted">Ruxsat yo‘q (telefon raqam yashirin)</span>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Qavat:</strong> {{ $product->floor }}/{{ $product->building_floor }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Maydon:</strong> {{ $product->square }} m<sup>2</sup>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Xonalar soni:</strong> {{ $product->rooms }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Ta'mir holati:</strong> {{ $product->repair }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Sotix:</strong> {{ $product->sotix }}
                    </div>
                </div>

                <div class="mt-3">
                    <strong>Izoh:</strong>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>

        @if($product->images)
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Rasmlar</h5>
                    <div class="row">
                        @foreach (json_decode($product->images, true) as $image)
                            <div class="col-md-3 mb-3">
                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded border shadow-sm"
                                     alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
