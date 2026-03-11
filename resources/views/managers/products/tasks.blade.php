@extends('layouts.managers_layout')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary"><i class="fas fa-tasks me-2"></i>{{ __('Mening vazifalarim (Uylar)') }}</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle w-100 mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#ID</th>
                            <th>{{ __('Obyekt nomi') }}</th>
                            <th>{{ __('Manzil') }}</th>
                            <th>{{ __('Xonalar') }}</th>
                            <th>{{ __('Holat (Status)') }}</th>
                            <th class="text-center pe-4">{{ __('Amal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $product->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; margin-right: 12px; background: #eee;">
                                            @php $images = $product->productImages->pluck('path')->toArray(); @endphp
                                            @if(count($images) > 0)
                                                <img src="{{ asset('storage/' . $images[0]) }}" alt="img" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <i class="fas fa-home text-secondary d-flex justify-content-center align-items-center h-100"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                                            <div class="text-muted small">${{ number_format($product->price, 0, '.', ' ') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark">{{ $product->region->name ?? '-' }}</div>
                                    <div class="text-muted small">{{ $product->city->name ?? '-' }}</div>
                                </td>
                                <td>{{ $product->rooms ?? '-' }} xona</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            \App\Constants::STATUS_ACTIVE => 'success',
                                            \App\Constants::STATUS_PENDING => 'warning',
                                            \App\Constants::STATUS_INACTIVE => 'danger',
                                        ];
                                        $color = $statusColors[$product->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} px-3 py-2 rounded-pill">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td class="text-center pe-4">
                                    <form action="{{ route('manager.tasks.status', $product->id) }}" method="POST" class="d-flex align-items-center justify-content-end gap-2">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm" style="width: 130px;">
                                            <option value="{{ \App\Constants::STATUS_ACTIVE }}" {{ $product->status == \App\Constants::STATUS_ACTIVE ? 'selected' : '' }}>Active</option>
                                            <option value="{{ \App\Constants::STATUS_PENDING }}" {{ $product->status == \App\Constants::STATUS_PENDING ? 'selected' : '' }}>Pending</option>
                                            <option value="{{ \App\Constants::STATUS_INACTIVE }}" {{ $product->status == \App\Constants::STATUS_INACTIVE ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <a href="{{ route('show-product', $product->id) }}" class="btn btn-sm btn-light border" title="Ko'rish">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-clipboard-list fs-1 mb-3 opacity-25"></i>
                                    <p class="mb-0">Hozircha sizga biriktirilgan vazifalar yo'q.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
            <div class="card-footer bg-white border-0 pt-4 pb-3">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
