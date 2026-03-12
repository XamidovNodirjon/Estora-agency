@extends('layouts.client_layout')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title m-0">Mening e'lonlarim</h1>
    <a href="{{ route('client.products.create') }}" class="btn btn-primary fw-bold px-4 py-2" style="background-color: var(--sidebar-navy); border: none;">
        Yangi e'lon
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light">
            <tr class="text-muted small uppercase fw-bold">
                <th class="ps-3 py-3">E'lon</th>
                <th class="py-3">Holat</th>
                <th class="py-3 text-end pe-3">Narx</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="ps-3 py-3 font-semibold text-dark">
                        {{ $product->name }}
                        <div class="small text-muted fw-normal">{{ $product->city->name ?? 'Namangan' }}</div>
                    </td>
                    <td class="py-3">
                        <span class="badge {{ $product->status === 'published' ? 'bg-success' : 'bg-warning' }}">
                            {{ strtoupper($product->status) }}
                        </span>
                    </td>
                    <td class="py-3 text-end pe-3 fw-bold text-dark">
                        ${{ number_format($product->price) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted">
                        Hech narsa topilmadi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
