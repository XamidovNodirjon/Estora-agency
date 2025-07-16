@extends('layouts.admin_layout')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 fw-semibold text-dark">User Reservations</h2>

        <!-- Search Form -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('reservations.search') }}" method="GET" class="d-flex gap-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by Product ID or Phone" value="{{ $query ?? '' }}">
                    <button type="submit" class="btn btn-outline-dark">Search</button>
                </form>
            </div>
        </div>

        <!-- Search Result -->
        @isset($searchedProduct)
            <div class="card border-start border-3 border-dark-subtle shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $searchedProduct->name }}</h5>
                        <small class="text-muted">Product ID: {{ $searchedProduct->id }} | Available: {{ $searchedProduct->quantity }}</small>
                    </div>
                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#reserveModal">+ New Reservation</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="reserveModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-0 shadow-sm">
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <div class="modal-header bg-white">
                                <h5 class="modal-title">Create Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="product_id" value="{{ $searchedProduct->id }}">
                                <input type="hidden" name="phone" value="{{ $query }}">

                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" min="1" max="{{ $searchedProduct->quantity }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <select name="user_id" class="form-select" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->phone }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="datetime-local" name="reserved_at" class="form-control" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="datetime-local" name="reserved_until" class="form-control" min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Notes (optional)</label>
                                    <textarea name="notes" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark">Save Reservation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endisset

    <!-- Reservations Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase">
                            <th>Product</th>
                            <th>User</th>
                            <th>Phone</th>
                            <th>Qty</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reservations as $reservation)
                            <tr class="border-top">
                                <td class="fw-semibold">{{ $reservation->product->name }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>{{ $reservation->quantity }}</td>
                                <td>{{ $reservation->reserved_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $reservation->reserved_until->format('Y-m-d H:i') }}</td>
                                <td>
                                    @if($reservation->reserved_until->isPast())
                                        <span class="badge bg-light text-muted">Expired</span>
                                    @elseif($reservation->reserved_at->isFuture())
                                        <span class="badge bg-light text-dark">Upcoming</span>
                                    @else
                                        <span class="badge bg-dark text-white">Active</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-secondary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No reservations found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
