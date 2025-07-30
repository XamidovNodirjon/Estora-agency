@extends('layouts.admin_layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">Mahsulotlar ro'yxati</h5>
                <a href="{{ route('create-product') }}" class="btn btn-outline-success">
                    <i class="fa fa-plus-circle me-1"></i> Yangi mahsulot
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Narxi</th>
                            <th>Telefon</th>
                            <th>Maydoni (m²)</th>
                            <th>Xonalar</th>
                            <th>Sotix</th>
                            <th>Amallar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, '.', ' ') }} so'm</td>
                                <td>{{ $product->phone }}</td>
                                <td>{{ $product->square }} m²</td>
                                <td>{{ $product->rooms }}</td>
                                <td>{{ $product->sotix }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{ route('edit-product', $product->id) }}"
                                           class="btn btn-sm btn-light border text-primary"
                                           title="Tahrirlash"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('show-products', $product->id) }}"
                                           class="btn btn-sm btn-light border text-info"
                                           title="Ko‘rish"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{route('delete.product',$product->id)}}"
                                              method="POST"
                                              onsubmit="return confirm('Ishonchingiz komilmi?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-light border text-danger"
                                                    title="O‘chirish"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Hech qanday mahsulot topilmadi.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

@endsection
