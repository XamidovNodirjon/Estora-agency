@extends('layouts.admin_layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">{{ $user->name }} ning ko‘rgan maxulotlar</h5>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm "> <i class="bi bi-arrow-left"></i> Ortga </a>
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
                            <th>Ko‘rish ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $index => $productView)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $productView->product->name ?? '-' }}</td>
                                <td>{{ number_format($productView->product->price ?? 0, 0, '.', ' ') }} so'm</td>
                                <td>{{ $productView->product->phone ?? '-' }}</td>
                                <td>{{ $productView->product->square ?? '-' }} m²</td>
                                <td>{{ $productView->product->rooms ?? '-' }}</td>
                                <td>{{ $productView->id }}</td>
                                <td>
                                    <form action="{{ route('product-view.delete', $productView->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Haqiqatan ham bu ko‘rishni o‘chirmoqchimisiz?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Bu foydalanuvchi hech qanday mahsulot
                                    ko‘rmagan
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
