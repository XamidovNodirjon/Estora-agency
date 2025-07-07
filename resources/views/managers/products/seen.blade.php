@extends('layouts.managers_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-eye me-1"></i> Ko‘rilgan mahsulotlar
                    </h5>
                    <a href="{{ route('manager') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Orqaga
                    </a>
                </div>

                <div class="card-body">
                    @if($products->isEmpty())
                        <div class="alert alert-warning text-center">
                            Hali hech qanday mahsulot ko‘rilmagan
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle text-center">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nomi</th>
                                    <th>Narxi (UZS)</th>
                                    <th>Telefon</th>
                                    <th>Maydoni (m²)</th>
                                    <th>Xonalar</th>
                                    <th>Hudud</th>
                                    <th>Manzil</th>
                                    <th>Holati</th>
                                    <th>Batafsil</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 0, '.', ' ') }}</td>
                                        <td class="text-success">{{ $product->phone }}</td>
                                        <td>{{ $product->square }}</td>
                                        <td>{{ $product->rooms }}</td>
                                        <td>{{ $product->region->name ?? '-' }}</td>
                                        <td>{{ $product->city->name ?? '-' }}</td>
                                        <td>{{ ucfirst($product->repair) }}</td>
                                        <td>
                                            <a href="{{ route('show-product', $product->id) }}"
                                               class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-eye"></i> Ko‘rish
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
