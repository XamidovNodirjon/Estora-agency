<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-custom align-middle w-100">
        <thead>
            <tr>
                <th style="width: 40px;"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                <th style="width: 60px;">#</th>
                <th style="width: 80px;">{{ __('Photo') }}</th>
                <th>{{ __('Property Info') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Contact') }}</th>
                <th>{{ __('Manager') }}</th>
                <th class="text-end" style="width: 140px;">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox form-check-input"></td>
                    <td class="text-muted small">#{{ $product->id }}</td>
                    <td>
                        @php $images = $product->image_array; @endphp
                        @if(!empty($images))
                            <img src="{{ asset('storage/' . $images[0]) }}" class="product-thumb" alt="thumb">
                        @else
                            <div class="product-thumb bg-light d-flex align-items-center justify-content-center text-muted">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold text-main">{{ $product->name }}</div>
                        <div class="text-muted small">
                            {{ $product->rooms }} {{ __('rooms') }} • {{ $product->square }} m² • {{ $product->sotix }} {{ __('sotix') }}
                        </div>
                        <div class="mt-1">
                            <span class="badge bg-light text-{{ $statusClass }} border border-{{ $statusClass }} px-2" style="font-size: 0.65rem; border-radius: 4px;">
                                <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> {{ ucfirst($product->status) }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="price-tag text-primary">{{ number_format($product->price, 0, '.', ' ') }} $</div>
                    </td>
                    <td>
                        <div class="text-main fw-medium">{{ $product->phone }}</div>
                        <div class="text-muted small">{{ $product->user ? $product->user->name : '-' }}</div>
                    </td>
                    <td>
                        @if($product->manager)
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded-circle bg-soft-info text-info small" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem;">
                                        {{ substr($product->manager->name, 0, 1) }}
                                    </span>
                                </div>
                                <span class="small">{{ $product->manager->name }}</span>
                            </div>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('show-products', $product->id) }}"
                               class="btn-action btn-action-view"
                               title="{{ __('view') }}" data-bs-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('edit-product', $product->id) }}"
                               class="btn-action btn-action-edit"
                               title="{{ __('edit') }}" data-bs-toggle="tooltip">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('delete.product', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('{{ __('Are you sure?') }}')"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-action-delete"
                                        title="{{ __('delete') }}" data-bs-toggle="tooltip">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
