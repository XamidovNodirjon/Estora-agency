@extends('layouts.admin_layout')
@section('title', 'Leads')

@push('css')
    <link href="{{ asset('css/leads_list.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap"
        rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between py-4">
                <h4 class="leads-header-title mb-sm-0 font-size-24">{{ __('Leads Management') }}</h4>
                <div class="page-title-right">
                    <button type="button" class="btn-premium-add shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#createLeadModal">
                        <i class="bx bx-plus font-size-18"></i> {{ __('Add New Lead') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="leads-card">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert"
                            style="border-radius: 12px; background: #f0fdf4; color: #16a34a;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div id="bulk-action-bar" class="filter-bar mb-3 shadow-sm d-none animate__animated animate__fadeInDown"
                        style="background: white; border: 2px solid #6366f1; border-radius: 16px;">
                        <form id="bulk-assign-form" method="POST" action="{{ route('lisds.bulk-assign') }}">
                            @csrf
                            <div class="row align-items-center g-3">
                                <div class="col-md-auto">
                                    <div class="d-flex align-items-center gap-2 px-3">
                                        <div class="bg-soft-primary p-2 rounded-circle"
                                            style="background: #eef2ff; color: #6366f1;">
                                            <i class="bx bxs-check-shield font-size-20"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-main small line-height-1" id="selected-count">0 Leads
                                                Selected</div>
                                            <div class="text-muted" style="font-size: 0.7rem;">Batch Actions Available</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto ms-auto d-flex align-items-center gap-3 pe-3">
                                    <span class="text-muted small fw-medium">Assign to:</span>
                                    <select name="manager_id" class="form-select filter-select" style="min-width: 200px;"
                                        required>
                                        <option value="">Choose Manager...</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-premium-add py-2" style="background: #6366f1;">
                                        Apply Batch Assignment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="filter-bar">
                        <form method="GET" action="{{ route('lisds.index') }}">
                            <div class="row align-items-center g-3">
                                <div class="col-md-auto">
                                    <span class="text-muted small fw-medium px-2">{{ __('Filter by Assignment:') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <select name="filter_user_id" class="form-select filter-select"
                                        onchange="this.form.submit()">
                                        <option value="">{{ __('All Leads') }}</option>
                                        <option value="unassigned" {{ request('filter_user_id') == 'unassigned' ? 'selected' : '' }}>{{ __('Unassigned Leads') }}</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('filter_user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    @if(request('filter_user_id'))
                                        <a href="{{ route('lisds.index') }}"
                                            class="btn btn-link text-muted text-decoration-none small">
                                            <i class="bx bx-reset me-1"></i> {{ __('Clear Filters') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-custom align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th style="width: 60px;">#ID</th>
                                    <th>{{ __('Client Details') }}</th>
                                    <th>{{ __('Location / Address') }}</th>
                                    <th>{{ __('Assignment') }}</th>
                                    <th>{{ __('Date Added') }}</th>
                                    <th class="text-end" style="width: 120px;">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lisds as $lisd)
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input lead-checkbox" name="lead_ids[]"
                                                    value="{{ $lisd->id }}" form="bulk-assign-form">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td class="text-muted small">#{{ $lisd->id }}</td>
                                        <td>
                                            <div class="fw-bold text-main">{{ $lisd->name }}</div>
                                            <div class="text-muted small mt-1"><i class="bx bx-phone me-1"></i>
                                                {{ $lisd->phone }}</div>
                                        </td>
                                        <td>
                                            <div class="text-main small"
                                                style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                                title="{{ $lisd->address }}">
                                                <i class="bx bx-map-pin me-1 text-muted"></i> {{ $lisd->address }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($lisd->user)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs me-2">
                                                        <span class="avatar-title rounded-circle bg-soft-info text-info small"
                                                            style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
                                                            {{ substr($lisd->user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <span class="badge-premium badge-soft-success">{{ $lisd->user->name }}</span>
                                                </div>
                                            @else
                                                <span class="badge-premium badge-soft-warning"><i
                                                        class="bx bx-help-circle me-1"></i> {{ __('Unassigned') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-main small">{{ $lisd->created_at->format('d.m.Y') }}</div>
                                            <div class="text-muted" style="font-size: 0.7rem;">
                                                {{ $lisd->created_at->format('H:i') }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('lisds.edit', $lisd->id) }}"
                                                    class="btn-action btn-action-edit" title="{{ __('Edit') }}"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <form action="{{ route('lisds.destroy', $lisd->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-action-delete"
                                                        onclick="return confirm('{{ __('Are you sure?') }}')"
                                                        title="{{ __('Delete') }}" data-bs-toggle="tooltip">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 px-2">
                        {{ $lisds->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Lead Modal -->
    <div class="modal fade" id="createLeadModal" tabindex="-1" aria-labelledby="createLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLeadModalLabel">Add New Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('lisds.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Assign to User (Optional)</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">-- Unassigned --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->phone }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function () {
                const checkAll = $('#checkAll');
                const checkboxes = $('.lead-checkbox');
                const bulkActionBar = $('#bulk-action-bar');
                const selectedCount = $('#selected-count');

                function updateBulkUI() {
                    const checkedCount = $('.lead-checkbox:checked').length;
                    if (checkedCount > 0) {
                        bulkActionBar.removeClass('d-none');
                        selectedCount.text(checkedCount + ' Leads Selected');
                    } else {
                        bulkActionBar.addClass('d-none');
                        checkAll.prop('checked', false);
                    }
                }

                checkAll.on('click', function() {
                    checkboxes.prop('checked', this.checked);
                    updateBulkUI();
                });

                checkboxes.on('click', function() {
                    if (!this.checked) {
                        checkAll.prop('checked', false);
                    } else if (checkboxes.length === $('.lead-checkbox:checked').length) {
                        checkAll.prop('checked', true);
                    }
                    updateBulkUI();
                });

                $('#datatable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/uz.json', // Optional: Locale
                    },
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: true,
                    columnDefs: [
                        { orderable: false, targets: [0, 6] }
                    ]
                });
            });
        </script>
    @endpush
@endsection