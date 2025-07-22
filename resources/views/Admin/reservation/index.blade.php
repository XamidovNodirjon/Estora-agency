@extends('layouts.admin_layout') {{-- Admin layoutingizni chaqiramiz --}}

@section('title', 'User Reservations - Admin Panel') {{-- Sahifa sarlavhasi --}}

@section('content')
    <div class="container-fluid py-4 px-4"> {{-- Kengroq container va padding --}}
        <h2 class="mb-4 fw-bold text-primary">
            <i class="bi bi-bookmark-check-fill me-2"></i> User Reservations
        </h2>

        {{-- Xabarlar (Success/Error) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Search Form --}}
        <div class="card border-0 shadow-lg mb-4 rounded-4"> {{-- Katta soya va yumaloq qirralar --}}
            <div class="card-body p-4">
                <form action="{{ route('reservations.search') }}" method="GET" class="d-flex align-items-center gap-3">
                    <div class="flex-grow-1">
                        <input type="text" name="query" class="form-control form-control-lg rounded-pill border-primary"
                               placeholder="Search by Product ID or Phone Number..."
                               value="{{ request('query') }}">
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                        <i class="bi bi-search me-2"></i> Search
                    </button>
                    @if(request('query'))
                        <a href="{{ route('reservations') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            <i class="bi bi-x-circle me-2"></i> Clear Search
                        </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Search Result and New Reservation Button --}}
        @isset($searchedProduct)
            <div class="card border-start border-5 border-success shadow-lg mb-4 rounded-4 animate__animated animate__fadeIn"> {{-- Success rang, animatsiya --}}
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 text-dark fw-bold">
                            <i class="bi bi-box-seam me-2"></i> Found Product: {{ $searchedProduct->name }}
                        </h5>
                        <small class="text-muted">
                            <i class="bi bi-tag me-1"></i> Product ID: <span class="fw-semibold">{{ $searchedProduct->id }}</span> |
                            <i class="bi bi-telephone-fill me-1"></i> Phone: <span class="fw-semibold">{{ $searchedProduct->phone }}</span>
                        </small>
                    </div>
                    <button class="btn btn-success rounded-pill px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#reserveModal">
                        <i class="bi bi-plus-circle me-2"></i> New Reservation
                    </button>
                </div>
            </div>

            {{-- New Reservation Modal --}}
            <div class="modal fade" id="reserveModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Kattaroq modal va markazda ochiladi --}}
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <div class="modal-header bg-success text-white rounded-top-4 p-4"> {{-- Header rangi va padding --}}
                                <h5 class="modal-title fw-bold">
                                    <i class="bi bi-calendar-plus me-2"></i> Create New Reservation
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4"> {{-- Padding oshirildi --}}
                                {{-- Mahsulot IDsi va telefon raqami yashirin maydonlari --}}
                                <input type="hidden" name="product_id" value="{{ $searchedProduct->id }}">
                                <input type="hidden" name="phone" value="{{ $searchedProduct->phone }}">

                                <div class="mb-3">
                                    <label for="user_id" class="form-label fw-semibold text-muted">
                                        <i class="bi bi-person-fill me-1"></i> Select User for Reservation
                                    </label>
                                    <select id="user_id" name="user_id" class="form-select form-select-lg" required>
                                        <option value="">Choose a User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->phone }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <div class="text-danger small mt-1 animate__animated animate__fadeInLeft">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="reserved_at" class="form-label fw-semibold text-muted">
                                            <i class="bi bi-calendar-event me-1"></i> Reservation Start Time
                                        </label>
                                        <input type="datetime-local" id="reserved_at" name="reserved_at" class="form-control form-control-lg"
                                               min="{{ now()->format('Y-m-d\TH:i') }}" required
                                               value="{{ old('reserved_at') }}">
                                        @error('reserved_at') <div class="text-danger small mt-1 animate__animated animate__fadeInLeft">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="reserved_until" class="form-label fw-semibold text-muted">
                                            <i class="bi bi-calendar-x me-1"></i> Reservation End Time
                                        </label>
                                        <input type="datetime-local" id="reserved_until" name="reserved_until" class="form-control form-control-lg"
                                               min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" required
                                               value="{{ old('reserved_until') }}">
                                        @error('reserved_until') <div class="text-danger small mt-1 animate__animated animate__fadeInLeft">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="notes" class="form-label fw-semibold text-muted">
                                        <i class="bi bi-journal-text me-1"></i> Additional Notes (optional)
                                    </label>
                                    <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Any special requests or details...">{{ old('notes') }}</textarea>
                                    @error('notes') <div class="text-danger small mt-1 animate__animated animate__fadeInLeft">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="modal-footer bg-light border-0 rounded-bottom-4 justify-content-end p-3">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-success rounded-pill px-4 py-2 shadow-sm">
                                    <i class="bi bi-check-circle me-2"></i> Save Reservation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endisset

        {{-- Reservations Table --}}
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-primary text-white">
                        <tr class="small text-uppercase">
                            <th class="py-3 ps-4">Product</th>
                            <th class="py-3">User</th>
                            <th class="py-3">Phone</th>
                            <th class="py-3">Qty</th> {{-- Quantity column hali ham mavjud --}}
                            <th class="py-3">Start</th>
                            <th class="py-3">End</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-end py-3 pe-4">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reservations as $reservation)
                            <tr class="border-top">
                                <td class="fw-semibold ps-4 py-3 text-dark">{{ $reservation->product->name ?? 'N/A'}}</td> {{-- Agar product null bo'lsa --}}
                                <td class="py-3">{{ $reservation->user->name ?? 'N/A'}}</td> {{-- Agar user null bo'lsa --}}
                                <td class="py-3">{{ $reservation->phone }}</td>
                                <td class="py-3">{{ $reservation->quantity }}</td>
                                <td class="py-3">
                                    {{ $reservation->reserved_at?->format('Y-m-d H:i') ?: 'N/A' }}
                                </td>
                                <td class="py-3">
                                    {{ $reservation->reserved_until?->format('Y-m-d H:i') ?: 'N/A' }}
                                </td>
                                <td class="text-center py-3">
                                    @if ($reservation->reserved_until && $reservation->reserved_until->isPast())
                                        <span class="badge bg-secondary text-white rounded-pill px-3 py-2 animate__animated animate__pulse">
                                            <i class="bi bi-hourglass-bottom me-1"></i> Expired
                                        </span>
                                    @elseif ($reservation->reserved_at && $reservation->reserved_at->isFuture())
                                        <span class="badge bg-info text-dark rounded-pill px-3 py-2 animate__animated animate__fadeIn">
                                            <i class="bi bi-hourglass-split me-1"></i> Upcoming
                                        </span>
                                    @elseif ($reservation->reserved_at && $reservation->reserved_until)
                                        <span class="badge bg-success text-white rounded-pill px-3 py-2 animate__animated animate__bounceIn">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 animate__animated animate__wobble">
                                            <i class="bi bi-question-circle me-1"></i> Unknown
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-trash-fill me-1"></i> Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-search d-block mb-3 h1 text-primary"></i>
                                    <p class="fw-bold">No reservations found for your search criteria or currently.</p>
                                    <p class="text-secondary">Try searching with a different product ID or phone number.</p>
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
        // Modal ochilganda min va max sanalarni yangilash
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var minDate = today.toISOString().slice(0, 16); // Bugungi sana va vaqt
            document.getElementById('reserved_at').setAttribute('min', minDate);
            document.getElementById('reserved_until').setAttribute('min', minDate);

            // reserved_at o'zgarganda reserved_until ni yangilash
            document.getElementById('reserved_at').addEventListener('change', function() {
                var startDateTime = new Date(this.value);
                startDateTime.setHours(startDateTime.getHours() + 1); // Boshlanish vaqtidan 1 soat keyin
                var minUntilDate = startDateTime.toISOString().slice(0, 16);
                document.getElementById('reserved_until').setAttribute('min', minUntilDate);

                // Agar reserved_until reserved_at dan oldin bo'lsa, uni ham yangilash
                if (new Date(document.getElementById('reserved_until').value) < startDateTime) {
                    document.getElementById('reserved_until').value = minUntilDate;
                }
            });
        });

        // Agar validatsiya xatoliklari bo'lsa, modalni ochib turish
        @if ($errors->any() && isset($searchedProduct))
        var reserveModal = new bootstrap.Modal(document.getElementById('reserveModal'));
        reserveModal.show();
        @endif
    </script>
@endpush
