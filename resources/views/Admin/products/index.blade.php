@extends('layouts.admin_layout')

@push('css')
    <link href="{{ asset('css/product_list.css') }}" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4" style="background: #f8fafc; min-height: 100vh;">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="product-header-title mb-1">{{ __('Products List') }}</h1>
                    <p class="text-muted mb-0">{{ __('Manage and track all your property listings') }}</p>
                </div>
                <a href="{{ route('create-product') }}" class="btn btn-primary px-4 py-2"
                    style="border-radius: 12px; font-weight: 600; background: var(--primary-gradient); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                    <i class="fa fa-plus-circle me-2"></i> {{ __('New Product') }}
                </a>
            </div>
        </div>

        <div class="card product-card">
            <div class="card-body p-4">
                <!-- Nav Pills -->
                <ul class="nav nav-pills nav-pills-custom mb-4" id="productTabs" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                            type="button" role="tab">
                            <i class="fas fa-check-circle me-2"></i> {{ __('Active') }} <span
                                class="badge bg-white text-dark ms-1"
                                style="border-radius: 6px; font-size: 0.7rem;">{{ $activeProducts->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                            type="button" role="tab">
                            <i class="fas fa-clock me-2"></i> {{ __('Pending') }} <span
                                class="badge bg-light text-dark ms-1"
                                style="border-radius: 6px; font-size: 0.7rem;">{{ $pendingProducts->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive"
                            type="button" role="tab">
                            <i class="fas fa-times-circle me-2"></i> {{ __('Inactive') }} <span
                                class="badge bg-light text-dark ms-1"
                                style="border-radius: 6px; font-size: 0.7rem;">{{ $inactiveProducts->count() }}</span>
                        </button>
                    </li>
                </ul>

                <div class="assign-bar mb-4 d-flex align-items-center justify-content-between">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i> {{ __('Select products and assign to a manager') }}
                    </div>
                    <form action="{{ route('products.assign-manager') }}" method="POST" id="assignManagerForm"
                        class="d-flex align-items-center">
                        @csrf
                        <div class="d-flex gap-2">
                            <select name="manager_id" class="form-select"
                                style="width: 250px; border-radius: 10px; border: 1px solid #e2e8f0;" required>
                                <option value="">{{ __('Select Manager') }}</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-dark px-4" style="border-radius: 10px; font-weight: 600;"
                                onclick="return confirm('{{ __('Assign selected products?') }}')">
                                {{ __('Assign') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="productTabsContent">
                    <!-- Active Products -->
                    <div class="tab-pane fade show active" id="active" role="tabpanel">
                        @include('Admin.products._table', ['products' => $activeProducts, 'tableId' => 'activeTable', 'statusClass' => 'success'])
                    </div>
                    <!-- Pending Products -->
                    <div class="tab-pane fade" id="pending" role="tabpanel">
                        @include('Admin.products._table', ['products' => $pendingProducts, 'tableId' => 'pendingTable', 'statusClass' => 'warning'])
                    </div>
                    <!-- Inactive Products -->
                    <div class="tab-pane fade" id="inactive" role="tabpanel">
                        @include('Admin.products._table', ['products' => $inactiveProducts, 'tableId' => 'inactiveTable', 'statusClass' => 'danger'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            const tableIds = ['#activeTable', '#pendingTable', '#inactiveTable'];

            tableIds.forEach(function (id) {
                if ($(id).length && !$.fn.DataTable.isDataTable(id)) {
                    $(id).DataTable({
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
                        "order": [[1, "desc"]],
                        "columnDefs": [
                            { "orderable": false, "targets": [0, 2, 7] }
                        ],
                        "pageLength": 10,
                        "stateSave": true
                    });
                }
            });

            function initTooltips() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }
            initTooltips();

            // Re-init tooltips on tab change
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                initTooltips();
            });

            // Handle "Select All" functionality
            $(document).on('change', '#selectAll', function () {
                var isChecked = $(this).prop('checked');
                var activeTabTable = $('.tab-pane.active').find('table tbody');
                activeTabTable.find('.product-checkbox').prop('checked', isChecked);
            });

            // Prevent form submit if no checkboxes selected and append data
            $('#assignManagerForm').on('submit', function (e) {
                var checkedProducts = $('.tab-pane.active').find('.product-checkbox:checked');

                if (checkedProducts.length === 0) {
                    e.preventDefault();
                    alert('{{ __("Kamida bitta mahsulot tanlang!") }}');
                    return false;
                }

                // Clear old inputs if any
                $(this).find('input[name="product_ids[]"]').remove();

                // Append selected products as hidden inputs
                checkedProducts.each(function () {
                    $('#assignManagerForm').append('<input type="hidden" name="product_ids[]" value="' + $(this).val() + '">');
                });
            });
        });
    </script>
@endpush