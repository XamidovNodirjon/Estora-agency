@extends('layouts.admin_layout')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="text-gradient fw-bold mb-1">
                            <i class="fas fa-users me-2 text-primary"></i>
                            Foydalanuvchilar Boshqaruvi
                        </h3>
                        <p class="text-muted mb-0">{{ $users->count() }} ta foydalanuvchi ro'yxatda</p>
                    </div>

                    <!-- Action Bar -->
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Language Switcher -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                    id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-globe me-1"></i>
                                {{ strtoupper(app()->getLocale()) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="?lang=en">🇺🇸 ENGLISH</a></li>
                                <li><a class="dropdown-item" href="?lang=uz">🇺🇿 O'ZBEK</a></li>
                                <li><a class="dropdown-item" href="?lang=ru">🇷🇺 РУССКИЙ</a></li>
                            </ul>
                        </div>

                        <!-- Add Ball Button -->
                        <button class="btn btn-gradient-info btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#create-balls-modal">
                            <i class="fas fa-plus-circle me-1"></i>
                            Ball Berish
                        </button>

                        <!-- Add User Button -->
                        <button class="btn btn-gradient-success btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#create-modal">
                            <i class="fas fa-user-plus me-1"></i>
                            Yangi Foydalanuvchi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-0">
                <!-- Search and Filter Bar -->
                <div class="px-4 py-3 border-bottom bg-light rounded-top-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0"
                                       placeholder="Foydalanuvchi qidirish..." id="searchInput">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="positionFilter">
                                <option value="">Barcha lavozimlar</option>
                                @foreach ($positions as $position)
                                    @if ($position->name !== 'superAdmin')
                                        <option value="{{ $position->name }}">{{ $position->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100" onclick="resetFilters()">
                                <i class="fas fa-refresh me-1"></i>Tozalash
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="usersTable">
                        <thead class="table-dark sticky-top">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user me-2"></i>Ism
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-at me-2"></i>Login
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone me-2"></i>Telefon
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-id-card me-2"></i>Pasport
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-fingerprint me-2"></i>JShShIR
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-briefcase me-2"></i>Lavozim
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star me-2"></i>Ball
                                </div>
                            </th>
                            <th class="py-3 text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-cogs me-2"></i>Amal
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $index => $user)
                            @if ($user->position->name === 'superAdmin')
                                @continue
                            @endif
                            <tr class="user-row" data-position="{{ $user->position->name ?? '' }}">
                                <td class="px-4 py-3">
                                    <span class="badge bg-light text-dark rounded-pill">{{ $index + 1 }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill">
                                        {{ $user->username }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <a href="tel:{{ $user->phone }}" class="text-decoration-none">
                                        <i class="fas fa-phone-alt text-success me-1"></i>
                                        {{ $user->phone }}
                                    </a>
                                </td>
                                <td class="py-3">
                                    <span class="font-monospace text-muted">{{ $user->passport }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="font-monospace text-muted">{{ $user->jshshir }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-info-soft text-info px-3 py-2 rounded-pill">
                                        {{ $user->position->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <button class="btn btn-gradient-warning btn-sm position-relative edit-ball-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#edit-ball-modal"
                                            data-user-id="{{ $user->id }}"
                                            data-current-ball="{{ $user->balls->amount ?? 0 }}">
                                        <i class="fas fa-star me-1"></i>
                                        {{ $user->balls->amount ?? 0 }}
                                        @if(($user->balls->amount ?? 0) > 5)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                <i class="fas fa-fire"></i>
                                            </span>
                                        @endif
                                    </button>
                                </td>
                                <td class="py-3">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('user-edit', $user->id) }}"
                                           class="btn btn-outline-primary btn-sm" title="Tahrirlash">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('user.product.views', $user->id) }}"
                                           class="btn btn-outline-info btn-sm" title="Mahsulotlarni ko'rish">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger btn-sm delete-user-btn"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                title="O'chirish">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Foydalanuvchilar topilmadi</h5>
                                        <p class="text-muted mb-0">Hozircha hech qanday foydalanuvchi ro'yxatda yo'q</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form class="modal-content shadow-lg border-0 rounded-4" action="{{ route('store-users') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h4 class="modal-title text-gradient fw-bold" id="createModalLabel">
                            <i class="fas fa-user-plus me-2 text-success"></i>
                            Yangi Foydalanuvchi Yaratish
                        </h4>
                        <p class="text-muted mb-0 small">Ma'lumotlarni to'ldiring</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Ism" required>
                                <label for="name">
                                    <i class="fas fa-user me-2"></i>Ism <span class="text-danger">*</span>
                                </label>
                                <div id="name-feedback" class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Raqam kiritish mumkin emas.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                <label for="username">
                                    <i class="fas fa-at me-2"></i>Login <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Parol" required>
                                <label for="password">
                                    <i class="fas fa-lock me-2"></i>Parol <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefon" required>
                                <label for="phone">
                                    <i class="fas fa-phone me-2"></i>Telefon <span class="text-danger">*</span>
                                </label>
                                <div id="phone-feedback" class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Faqat raqam kiritish mumkin.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="passport" id="passport" class="form-control"
                                       placeholder="Pasport" pattern="[A-Z]{2}[0-9]{7}" required>
                                <label for="passport">
                                    <i class="fas fa-id-card me-2"></i>Pasport <span class="text-danger">*</span>
                                </label>
                                <div class="form-text">Namuna: AA1234567</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="jshshir" id="jshshir" class="form-control"
                                       placeholder="JShShIR" maxlength="14" minlength="14" required>
                                <label for="jshshir">
                                    <i class="fas fa-fingerprint me-2"></i>JShShIR <span class="text-danger">*</span>
                                </label>
                                <div id="jshshir-feedback" class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>14 raqam kiritish kerak.
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" name="position_id" id="position_id" required>
                                    <option value="" disabled selected>Lavozimni tanlang</option>
                                    @foreach ($positions as $position)
                                        @if ($position->name !== 'superAdmin')
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="position_id">
                                    <i class="fas fa-briefcase me-2"></i>Lavozim <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Bekor qilish
                    </button>
                    <button type="submit" class="btn btn-gradient-success px-4">
                        <i class="fas fa-plus me-1"></i>Yaratish
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Balls Modal -->
    <div class="modal fade" id="create-balls-modal" tabindex="-1" aria-labelledby="createBallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content shadow-lg border-0 rounded-4" action="{{ route('create-ball', $user->id ?? 0) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h4 class="modal-title text-gradient fw-bold">
                            <i class="fas fa-star me-2 text-warning"></i>Ball Berish
                        </h4>
                        <p class="text-muted mb-0 small">Foydalanuvchiga ball qo'shish</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="mb-4">
                        <div class="form-floating">
                            <select class="form-select" name="user_id" id="user_select" required>
                                <option value="" disabled selected>Foydalanuvchini tanlang</option>
                                @foreach ($users as $u)
                                    @if ($u->position->name !== 'superAdmin')
                                        <option value="{{ $u->id }}" data-current-ball="{{ $u->balls->amount ?? 0 }}">
                                            {{ $u->name }} ({{ $u->balls->amount ?? 0 }} ball)
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="user_select">
                                <i class="fas fa-user me-2"></i>Foydalanuvchi
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-floating">
                            <input class="form-control" type="number" name="amount" id="ball_amount"
                                   min="0" max="10" required>
                            <label for="ball_amount">
                                <i class="fas fa-plus-circle me-2"></i>Ball miqdori
                            </label>
                            <div class="form-text">Maksimal: 10 ball</div>
                        </div>
                    </div>
                    <div id="ball-preview" class="alert alert-info d-none">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-2"></i>
                            <span id="preview-text"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Bekor qilish
                    </button>
                    <button class="btn btn-gradient-warning px-4" type="submit">
                        <i class="fas fa-star me-1"></i>Ball Berish
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Ball Modal -->
    <div class="modal fade" id="edit-ball-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content shadow-lg border-0 rounded-4" id="edit-ball-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h4 class="modal-title text-gradient fw-bold">
                            <i class="fas fa-edit me-2 text-primary"></i>Ballni Tahrirlash
                        </h4>
                        <p class="text-muted mb-0 small">Ball miqdorini o'zgartirish</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="fas fa-cog me-2"></i>Amal turi
                        </label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="action" id="set" value="set" checked>
                            <label class="btn btn-outline-primary" for="set">
                                <i class="fas fa-equals me-1"></i>O'rnatish
                            </label>
                            <input type="radio" class="btn-check" name="action" id="inc" value="increment">
                            <label class="btn btn-outline-success" for="inc">
                                <i class="fas fa-plus me-1"></i>Qo'shish
                            </label>
                            <input type="radio" class="btn-check" name="action" id="dec" value="decrement">
                            <label class="btn btn-outline-warning" for="dec">
                                <i class="fas fa-minus me-1"></i>Ayirish
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-floating">
                            <input class="form-control" type="number" name="amount" id="edit_ball_amount"
                                   min="0" max="10" required>
                            <label for="edit_ball_amount">
                                <i class="fas fa-hashtag me-2"></i>Miqdor
                            </label>
                            <div class="form-text">0 dan 10 gacha</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Bekor qilish
                    </button>
                    <button class="btn btn-gradient-primary px-4" type="submit">
                        <i class="fas fa-save me-1"></i>Saqlash
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h4 class="modal-title text-danger fw-bold">
                            <i class="fas fa-trash-alt me-2"></i>Foydalanuvchini O'chirish
                        </h4>
                        <p class="text-muted mb-0 small">Bu amalni ortga qaytarib bo'lmaydi</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                        <div>
                            <strong>Diqqat!</strong><br>
                            <span id="delete-user-name"></span> nomli foydalanuvchini o'chirishni tasdiqlaysizmi?
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Bekor qilish
                    </button>
                    <form id="delete-form" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-trash me-1"></i>Ha, o'chirish
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --info-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        }

        .btn-gradient-success {
            background: var(--success-gradient);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 242, 254, 0.3);
            color: white;
        }

        .btn-gradient-info {
            background: var(--info-gradient);
            border: none;
            color: #333;
            transition: all 0.3s ease;
        }

        .btn-gradient-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(168, 237, 234, 0.4);
            color: #333;
        }

        .btn-gradient-warning {
            background: var(--warning-gradient);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(250, 112, 154, 0.4);
            color: white;
        }

        .btn-gradient-primary {
            background: var(--primary-gradient);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .avatar-circle {
            width: 45px;
            height: 45px;
            background: var(--primary-gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .bg-primary-soft {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .bg-info-soft {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .empty-state {
            padding: 2rem;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #6f42c1;
        }

        .form-floating > .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.15);
        }

        .sticky-top {
            z-index: 10;
        }

        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
            }

            .btn-group .btn {
                border-radius: 0.375rem !important;
                margin-bottom: 0.25rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Edit Ball Modal
            document.querySelectorAll('.edit-ball-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.dataset.userId;
                    const currentBall = button.dataset.currentBall;
                    const form = document.getElementById('edit-ball-form');
                    form.action = `/users/${userId}/balls`;
                    document.getElementById('edit_ball_amount').value = currentBall;
                });
            });

            // Delete User Modal
            document.querySelectorAll('.delete-user-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.dataset.userId;
                    const userName = button.dataset.userName;
                    const form = document.getElementById('delete-form');
                    form.action = `/users/${userId}`;
                    document.getElementById('delete-user-name').textContent = userName;
                    new bootstrap.Modal(document.getElementById('delete-modal')).show();
                });
            });

            // Form Validation
            const nameInput = document.getElementById('name');
            const nameFeedback = document.getElementById('name-feedback');
            const phoneInput = document.getElementById('phone');
            const phoneFeedback = document.getElementById('phone-feedback');
            const jshshirInput = document.getElementById('jshshir');
            const jshshirFeedback = document.getElementById('jshshir-feedback');

            // Name validation (no numbers)
            nameInput.addEventListener('input', function() {
                const hasNumbers = /\d/.test(this.value);
                this.classList.toggle('is-invalid', hasNumbers);
                nameFeedback.style.display = hasNumbers ? 'block' : 'none';
            });

            // Phone validation (numbers only)
            phoneInput.addEventListener('input', function() {
                const isValidPhone = /^\+?[0-9\s\-\(\)]+$/.test(this.value) && this.value.trim() !== '';
                this.classList.toggle('is-invalid', !isValidPhone);
                phoneFeedback.style.display = isValidPhone ? 'none' : 'block';
            });

            // JShShIR validation (14 digits only)
            jshshirInput.addEventListener('input', function() {
                const isValidJshshir = /^\d{14}$/.test(this.value);
                this.classList.toggle('is-invalid', !isValidJshshir);
                jshshirFeedback.style.display = isValidJshshir ? 'none' : 'block';
            });

            // Passport formatting
            const passportInput = document.getElementById('passport');
            passportInput.addEventListener('input', function() {
                let value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                if (value.length > 2) {
                    value = value.substring(0, 2) + value.substring(2, 9);
                }
                this.value = value;
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const positionFilter = document.getElementById('positionFilter');
            const userRows = document.querySelectorAll('.user-row');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedPosition = positionFilter.value.toLowerCase();

                userRows.forEach(row => {
                    const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const username = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const phone = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const position = row.dataset.position.toLowerCase();

                    const matchesSearch = name.includes(searchTerm) ||
                        username.includes(searchTerm) ||
                        phone.includes(searchTerm);
                    const matchesPosition = selectedPosition === '' || position.includes(selectedPosition);

                    row.style.display = matchesSearch && matchesPosition ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterUsers);
            positionFilter.addEventListener('change', filterUsers);

            // Ball preview in create modal
            const userSelect = document.getElementById('user_select');
            const ballAmountInput = document.getElementById('ball_amount');
            const ballPreview = document.getElementById('ball-preview');
            const previewText = document.getElementById('preview-text');

            function updateBallPreview() {
                const selectedUser = userSelect.selectedOptions[0];
                const ballAmount = parseInt(ballAmountInput.value) || 0;

                if (selectedUser && ballAmount > 0) {
                    const currentBall = parseInt(selectedUser.dataset.currentBall) || 0;
                    const newTotal = currentBall + ballAmount;

                    previewText.textContent = `${selectedUser.textContent.split(' (')[0]} ning yangi ball miqdori: ${newTotal} ball`;
                    ballPreview.classList.remove('d-none');
                } else {
                    ballPreview.classList.add('d-none');
                }
            }

            userSelect.addEventListener('change', updateBallPreview);
            ballAmountInput.addEventListener('input', updateBallPreview);

            // Form submission validation
            const userForm = document.querySelector('#create-modal form');
            if (userForm) {
                userForm.addEventListener('submit', function(event) {
                    const hasInvalidFields = this.querySelectorAll('.is-invalid').length > 0;
                    if (hasInvalidFields) {
                        event.preventDefault();
                        // Show toast notification
                        showToast('Iltimos, barcha maydonlarni to\'g\'ri to\'ldiring!', 'error');
                    }
                });
            }

            // Language switcher functionality
            const languageItems = document.querySelectorAll('.dropdown-item[href*="lang="]');
            languageItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = new URL(window.location);
                    const lang = this.href.split('lang=')[1];
                    url.searchParams.set('lang', lang);
                    window.location.href = url.toString();
                });
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert:not(.alert-danger):not(.alert-info)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(100%)';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });

            // Smooth scroll for mobile
            if (window.innerWidth <= 768) {
                document.querySelector('.table-responsive').style.scrollBehavior = 'smooth';
            }
        });

        // Reset filters function
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('positionFilter').value = '';
            document.querySelectorAll('.user-row').forEach(row => {
                row.style.display = '';
            });
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : type} border-0 position-fixed`;
            toast.style.top = '20px';
            toast.style.right = '20px';
            toast.style.zIndex = '9999';
            toast.setAttribute('role', 'alert');

            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            document.body.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        // Add loading spinner to form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Yuklanmoqda...';

                    // Re-enable after 10 seconds as fallback
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 10000);
                }
            });
        });

        // Add copy to clipboard functionality for JShShIR and Passport
        document.querySelectorAll('.font-monospace').forEach(element => {
            element.style.cursor = 'pointer';
            element.title = 'Nusxalash uchun bosing';

            element.addEventListener('click', async function() {
                try {
                    await navigator.clipboard.writeText(this.textContent.trim());
                    showToast('Nusxalandi!', 'success');

                    // Visual feedback
                    const original = this.style.backgroundColor;
                    this.style.backgroundColor = '#d4edda';
                    this.style.transition = 'background-color 0.3s';

                    setTimeout(() => {
                        this.style.backgroundColor = original;
                    }, 500);
                } catch (err) {
                    console.error('Nusxalashda xatolik:', err);
                }
            });
        });

        // Enhanced mobile responsiveness
        function handleResize() {
            const table = document.querySelector('.table-responsive');
            const cards = document.querySelectorAll('.card');

            if (window.innerWidth <= 768) {
                // Mobile optimizations
                table.style.fontSize = '0.875rem';
                cards.forEach(card => {
                    card.style.margin = '0.5rem 0';
                });
            } else {
                // Desktop view
                table.style.fontSize = '';
                cards.forEach(card => {
                    card.style.margin = '';
                });
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Call on load
    </script>
@endsection
