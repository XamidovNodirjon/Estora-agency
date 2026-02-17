@extends('layouts.admin_layout')
@section('title', 'Leads')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                <h4 class="mb-sm-0 font-size-18">Leads</h4>
                <div class="page-title-right">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#createLeadModal">
                        <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add Lead
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="GET" action="{{ route('lisds.index') }}" class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <select name="filter_user_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">Filter by Assigned User</option>
                                    <option value="" {{ request('filter_user_id') == '' ? 'selected' : '' }}>All Leads</option>
                                    <option value="unassigned" {{ request('filter_user_id') == 'unassigned' ? 'selected' : '' }}>Unassigned Leads</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('filter_user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                @if(request('filter_user_id'))
                                    <a href="{{ route('lisds.index') }}" class="btn btn-outline-secondary">
                                        <i class="bx bx-reset"></i> Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Assigned User</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lisds as $lisd)
                                <tr>
                                    <td>{{ $lisd->id }}</td>
                                    <td>{{ $lisd->name }}</td>
                                    <td>{{ $lisd->phone }}</td>
                                    <td>{{ $lisd->address }}</td>
                                    <td>
                                        @if($lisd->user)
                                            <span class="badge bg-success">{{ $lisd->user->name }}</span>
                                        @else
                                            <span class="badge bg-warning">Unassigned</span>
                                        @endif
                                    </td>
                                    <td>{{ $lisd->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('lisds.edit', $lisd->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('lisds.destroy', $lisd->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
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
                $('#datatable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/uz.json', // Optional: Locale
                    },
                    responsive: true
                });
            });
        </script>
    @endpush
@endsection