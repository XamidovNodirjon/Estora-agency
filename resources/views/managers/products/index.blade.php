@extends('layouts.managers_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Barcha eʼlonlar</h5>
                    <a href="{{ route('manager-create-product') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus-circle me-1"></i> Yangi eʼlon
                    </a>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-light border text-dark p-2">Sizda mavjud ball:
                            <strong class="text-success">{{ $user->balls->amount ?? '0' }}</strong>
                        </span>
                    </div>

                    @if($products->isEmpty())
                        <div class="alert alert-warning text-center">Eʼlonlar mavjud emas.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle text-center">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nomi</th>
                                    <th>Narxi (UZS)</th>
                                    <th>Telefon</th>
                                    <th>Maydoni (m²)</th>
                                    <th>Xonalar</th>
                                    <th>Sotix</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $index => $product)
                                    <tr class="clickable-row" style="cursor: pointer;"
                                        onclick="window.location='{{ route('show-product', $product->id) }}'">
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 0, '.', ' ') }}</td>
                                        <td>
                                            @if($product->isPhoneVisibleTo(auth()->user()))
                                                <span class="text-success fw-semibold">{{ $product->phone }}</span>
                                            @else
                                                <form action="{{ route('manager.reveal-phone', $product->id) }}"
                                                      method="POST" onClick="event.stopPropagation();">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning">
                                                        Ko‘rish (–1)
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{ $product->square }}</td>
                                        <td>{{ $product->rooms }}</td>
                                        <td>{{ $product->sotix }}</td>
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
