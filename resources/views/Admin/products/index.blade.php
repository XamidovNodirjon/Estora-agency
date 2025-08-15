@extends('layouts.admin_layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">{{ __('list_title') }}</h5>
                <a href="{{ route('create-product') }}" class="btn btn-outline-success">
                    <i class="fa fa-plus-circle me-1"></i> {{ __('add_new') }}
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('Narxi') }}</th>
                            <th>{{ __('Telefon') }}</th>
                            <th>{{ __('square') }}</th>
                            <th>{{ __('rooms') }}</th>
                            <th>{{ __('Sotix') }}</th>
                            <th>{{ __('Amal') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, '.', ' ') }} $</td>
                                <td>{{ $product->phone }}</td>
                                <td>{{ $product->square }} m²</td>
                                <td>{{ $product->rooms }}</td>
                                <td>{{ $product->sotix }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="{{ __('Amallar') }}">
                                        <a href="{{ route('edit-product', $product->id) }}"
                                           class="btn btn-sm btn-light border text-primary"
                                           title="{{ __('edit') }}"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('show-products', $product->id) }}"
                                           class="btn btn-sm btn-light border text-info"
                                           title="{{ __('view') }}"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{route('delete.product',$product->id)}}"
                                              method="POST"
                                              onsubmit="return confirm('{{ __('Ishonchingiz komilmi?') }}')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-light border text-danger"
                                                    title="{{ __('delete') }}"
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
                                    {{ __('Hech qanday mahsulot topilmadi.') }}
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
