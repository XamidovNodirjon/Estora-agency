<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-hover align-middle w-100">
        <thead class="table-light">
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>#</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('Narxi') }}</th>
                <th>{{ __('Telefon') }}</th>
                <th>{{ __('square') }}</th>
                <th>{{ __('rooms') }}</th>
                <th>{{ __('Sotix') }}</th>
                <th>{{ __('Manager') }}</th>
                <th class="text-center">{{ __('Amal') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox"></td>
                    <td>{{ $product->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-{{ $statusClass }} p-1 me-2" style="width: 10px; height: 10px; border-radius: 50%;"> </span>
                            {{ $product->name }}
                        </div>
                    </td>
                    <td>{{ number_format($product->price, 0, '.', ' ') }} $</td>
                    <td>{{ $product->phone }}</td>
                    <td>{{ $product->square }} m²</td>
                    <td>{{ $product->rooms }}</td>
                    <td>{{ $product->sotix }}</td>
                    <td>{{ $product->manager ? $product->manager->name : '-' }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('edit-product', $product->id) }}"
                               class="btn btn-sm btn-light border text-primary"
                               title="{{ __('edit') }}" data-bs-toggle="tooltip">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="{{ route('show-products', $product->id) }}"
                               class="btn btn-sm btn-light border text-info"
                               title="{{ __('view') }}" data-bs-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('delete.product', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('{{ __('Ishonchingiz komilmi?') }}')"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger"
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
