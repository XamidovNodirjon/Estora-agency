@extends('layouts.admin_layout')

@push('css')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 15px;
        }
        .table-responsive {
            padding: 10px 0;
        }
    </style>
@endpush

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
                <table id="productsTable" class="table table-hover align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('Narxi') }}</th>
                            <th>{{ __('Telefon') }}</th>
                            <th>{{ __('square') }}</th>
                            <th>{{ __('rooms') }}</th>
                            <th>{{ __('Sotix') }}</th>
                            <th class="text-center">{{ __('Amal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, '.', ' ') }} $</td>
                                <td>{{ $product->phone }}</td>
                                <td>{{ $product->square }} m²</td>
                                <td>{{ $product->rooms }}</td>
                                <td>{{ $product->sotix }}</td>
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
                        @empty
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // DataTable-ni ishga tushirish
            if (!$.fn.DataTable.isDataTable('#productsTable')) {
                $('#productsTable').DataTable({
                    "language": {
                        "search": "Qidirish:",
                        "lengthMenu": "Ko'rsatish _MENU_ tadan",
                        "info": "_START_ dan _END_ gacha ko'rsatilyapti. Jami: _TOTAL_",
                        "infoEmpty": "Ma'lumot topilmadi",
                        "zeroRecords": "Mos keladigan ma'lumot topilmadi",
                        "paginate": {
                            "next": "Keyingi",
                            "previous": "Oldingi"
                        }
                    },
                    "order": [[0, "desc"]], // ID bo'yicha kamayish
                    "pageLength": 10,
                    "stateSave": true // Sahifa yangilansa ham holatni (sahifa raqami, qidiruv) saqlaydi
                });
            }

            // Bootstrap Tooltip-ni qayta ishga tushirish (DataTable sahifalari almashganda kerak bo'ladi)
            function initTooltips() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }
            initTooltips();
        });
    </script>
@endpush