@extends('layouts.admin_layout')

@section('content')
    <style>
        /* Premium Modern Table Styling */
        .clients-header-bg {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            border-radius: 16px 16px 0 0;
        }

        .clients-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            overflow: hidden;
        }

        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #e2e8f0;
            border-top: none;
        }

        .table-custom tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .table-custom tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.95rem;
            border-top: none;
            border-bottom: 1px solid #f1f5f9;
        }

        .client-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
            color: #001f3f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px rgba(255, 215, 0, 0.3);
        }

        .client-name {
            font-weight: 600;
            color: #0f172a;
        }

        .client-email {
            font-size: 0.85rem;
            color: #64748b;
        }

        .badge-premium {
            padding: 0.35em 0.8em;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .badge-active {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
            border: none;
        }

        .btn-view {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .btn-view:hover {
            background-color: #0284c7;
            color: white;
        }

        .btn-edit {
            background-color: #fef3c7;
            color: #d97706;
        }

        .btn-edit:hover {
            background-color: #d97706;
            color: white;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background-color: #dc2626;
            color: white;
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #64748b;
            font-size: 1.1rem;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="clients-card">
            <!-- Header -->
            <div class="clients-header-bg p-4 px-5 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 text-white fw-bold">Mijozlar</h4>
                    <p class="mb-0 text-white-50 small">Tizimdagi barcha mijozlar ro'yxati</p>
                </div>
                <div>
                    <!-- Odatda mijozlar saytdan ro'yxatdan o'tishadi, lekin admin xohlasa qo'shishi mumkin -->
                    <button class="btn btn-warning fw-bold px-4 rounded-pill shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#create-client-modal">
                        <i class="fas fa-plus-circle me-2"></i> Yangi Mijoz
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Mijoz</th>
                            <th width="15%">Telefon</th>
                            <th width="15%">Pasport / JShShIR</th>
                            <th width="10%">Holat</th>
                            <th width="15%" class="text-end">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $index => $client)
                            <tr>
                                <td>
                                    <span class="text-muted fw-bold">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="client-avatar me-3">
                                            {{ strtoupper(substr($client->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="client-name">{{ $client->name }}</div>
                                            <div class="client-email">{{ $client->email ?? 'Email yo\'q' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone-alt text-muted me-2 small"></i>
                                        <span class="fw-medium">{{ $client->phone ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($client->passport || $client->jshshir)
                                        <div class="small fw-medium">{{ $client->passport ?? '-' }}</div>
                                        <div class="text-muted small">{{ $client->jshshir ?? '-' }}</div>
                                    @else
                                        <span class="text-muted fst-italic">Kiritilmagan</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-premium badge-active">
                                        <i class="fas fa-check-circle me-1"></i> Faol
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn-action btn-view"
                                            title="Ko'rish" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user-edit', $client->id) }}" class="btn-action btn-edit"
                                            title="Tahrirlash" data-bs-toggle="tooltip">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('delete-user', $client->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="O'chirish"
                                                data-bs-toggle="tooltip"
                                                onclick="return confirm('Mijozni o\'chirishga ishonchingiz komilmi?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-users-slash"></i>
                                        <h5 class="mt-3 text-dark fw-bold">Mijozlar topilmadi</h5>
                                        <p>Tizimda hozircha hech qanday mijoz ro'yxatdan o'tmagan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($clients->count() > 0)
                <!-- Footer / Pagination placeholder -->
                <div class="p-4 border-top bg-light d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Jami <strong>{{ $clients->count() }}</strong> ta mijoz
                        ko'rsatilmoqda</span>
                </div>
            @endif
        </div>
    </div>

    {{-- YANGI MIJOZ QO'SHISH MODALI (Soddalashtirilgan) --}}
    <div class="modal fade" id="create-client-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content border-0 shadow-lg" style="border-radius: 16px;"
                action="{{ route('store-client') }}" method="POST">
                @csrf
                <!-- Mijoz ekanligini bildirish uchun type yuboramiz -->
                <input type="hidden" name="type" value="client">
                <input type="hidden" name="position_id" value="">

                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary"><i class="fas fa-user-plus me-2"></i>Yangi Mijoz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium text-secondary">F.I.O <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3"
                            placeholder="To'liq ismni kiriting" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium text-secondary">Telefon raqam <span
                                class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control form-control-lg rounded-3"
                            placeholder="+998901234567" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium text-secondary">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg rounded-3"
                            placeholder="mijoz@example.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary">Parol <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control form-control-lg rounded-3"
                            placeholder="Parol o'rnating" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Bekor
                        qilish</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i> Saqlash
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection