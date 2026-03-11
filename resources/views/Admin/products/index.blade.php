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
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs nav-justified mb-4" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-success" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">
                        <i class="fas fa-check-circle me-1"></i> {{ __('Active') }} ({{ $activeProducts->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-warning" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">
                        <i class="fas fa-clock me-1"></i> {{ __('Pending') }} ({{ $pendingProducts->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-danger" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive" type="button" role="tab" aria-controls="inactive" aria-selected="false">
                        <i class="fas fa-times-circle me-1"></i> {{ __('Inactive') }} ({{ $inactiveProducts->count() }})
                    </button>
                </li>
            </ul>

            <div class="d-flex justify-content-end mb-3">
                <form action="{{ route('products.assign-manager') }}" method="POST" id="assignManagerForm">
                    @csrf
                    <div class="input-group" style="width: 350px;">
                        <select name="manager_id" class="form-select" required>
                            <option value="">{{ __('Manager tanlang') }}</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('{{ __('Tanlanganlarni biriktirasizmi?') }}')">{{ __('Biriktirish') }}</button>
                    </div>
                </form>
            </div>

            <!-- Tab Content -->
            <div class="tab-content" id="productTabsContent">
                <!-- Active Products -->
                <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                    @include('Admin.products._table', ['products' => $activeProducts, 'tableId' => 'activeTable', 'statusClass' => 'success'])
                </div>
                <!-- Pending Products -->
                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    @include('Admin.products._table', ['products' => $pendingProducts, 'tableId' => 'pendingTable', 'statusClass' => 'warning'])
                </div>
                <!-- Inactive Products -->
                <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                    @include('Admin.products._table', ['products' => $inactiveProducts, 'tableId' => 'inactiveTable', 'statusClass' => 'danger'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const tableIds = ['#activeTable', '#pendingTable', '#inactiveTable'];
            
            tableIds.forEach(function(id) {
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
                        "order": [[0, "desc"]],
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
            $(document).on('change', '#selectAll', function() {
                var isChecked = $(this).prop('checked');
                var activeTabTable = $('.tab-pane.active').find('table tbody');
                activeTabTable.find('.product-checkbox').prop('checked', isChecked);
            });

            // Prevent form submit if no checkboxes selected and append data
            $('#assignManagerForm').on('submit', function(e) {
                var checkedProducts = $('.tab-pane.active').find('.product-checkbox:checked');
                
                if (checkedProducts.length === 0) {
                    e.preventDefault();
                    alert('{{ __("Kamida bitta mahsulot tanlang!") }}');
                    return false;
                }
                
                // Clear old inputs if any
                $(this).find('input[name="product_ids[]"]').remove();
                
                // Append selected products as hidden inputs
                checkedProducts.each(function() {
                    $('#assignManagerForm').append('<input type="hidden" name="product_ids[]" value="' + $(this).val() + '">');
                });
            });
        });
    </script>
@endpush