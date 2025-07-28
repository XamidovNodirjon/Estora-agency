@extends('layouts.admin_layout')

@section('title', 'User Reservations - Admin Panel')

@section('content')
    <div class="container py-4">
        {{-- Page Title & Search --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">
                <i class="bi bi-bookmark-check-fill me-2"></i> User Reservations
            </h2>

            <form action="{{ route('reservations.search') }}" method="GET" class="d-flex align-items-center">
                <input type="text" name="query" class="form-control me-2" placeholder="Search by ID or Phone..." value="{{ request('query') }}">
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>

                @if(request('query'))
                    <a href="{{ route('reservations') }}" class="btn btn-outline-secondary ms-2">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Reservations Table --}}
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-primary text-white">
                        <tr class="text-uppercase small">
                            <th class="ps-4 py-3">Product</th>
                            <th class="py-3">User</th>
                            <th class="py-3">Phone</th>
                            <th class="py-3">Qty</th>
                            <th class="py-3">Start</th>
                            <th class="py-3">End</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-end pe-4 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reservations as $reservation)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $reservation->product->name ?? 'N/A' }}</td>
                                <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>{{ $reservation->quantity }}</td>
                                <td>{{ $reservation->reserved_at?->format('Y-m-d H:i') ?? 'N/A' }}</td>
                                <td>{{ $reservation->reserved_until?->format('Y-m-d H:i') ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if ($reservation->reserved_until && $reservation->reserved_until->isPast())
                                        <span class="badge bg-secondary px-3 py-2">
                                            <i class="bi bi-hourglass-bottom me-1"></i> Expired
                                        </span>
                                    @elseif ($reservation->reserved_at && $reservation->reserved_at->isFuture())
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            <i class="bi bi-hourglass-split me-1"></i> Upcoming
                                        </span>
                                    @elseif ($reservation->reserved_at && $reservation->reserved_until)
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="bi bi-question-circle me-1"></i> Unknown
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <form method="POST" action="{{ route('reservations.destroy', $reservation->id) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this reservation?');"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                    <button class="btn btn-sm btn-outline-info ms-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $reservation->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal (you can expand this modal if needed) --}}
                            <div class="modal fade" id="editModal{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Reservation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- Form contents here --}}
                                            <p>Form not yet implemented</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-search h1 d-block mb-2 text-primary"></i>
                                    <p class="fw-bold">No reservations found.</p>
                                    <p class="text-secondary">Try another search.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reservedAt = document.getElementById('reserved_at');
            const reservedUntil = document.getElementById('reserved_until');

            if (reservedAt && reservedUntil) {
                const now = new Date().toISOString().slice(0, 16);
                reservedAt.setAttribute('min', now);
                reservedUntil.setAttribute('min', now);

                reservedAt.addEventListener('change', () => {
                    const start = new Date(reservedAt.value);
                    start.setHours(start.getHours() + 1);
                    const minEnd = start.toISOString().slice(0, 16);
                    reservedUntil.setAttribute('min', minEnd);
                    if (new Date(reservedUntil.value) < start) {
                        reservedUntil.value = minEnd;
                    }
                });
            }
        });
    </script>
@endpush
