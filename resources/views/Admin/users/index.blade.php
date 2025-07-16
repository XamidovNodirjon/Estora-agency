@extends('layouts.admin_layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">Foydalanuvchilar ro‘yxati</h5>
                <div>
                    <button class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#create-modal">
                        <i class="fa fa-user-plus me-1"></i> Yangi foydalanuvchi
                    </button>
                    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-balls-modal">
                        <i class="fa fa-plus-circle me-1"></i> Ball berish
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ism</th>
                            <th>Login</th>
                            <th>Telefon</th>
                            <th>Pasport</th>
                            <th>JShShIR</th>
                            <th>Lavozim</th>
                            <th>Ball</th>
                            <th>Amal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->passport }}</td>
                                <td>{{ $user->jshshir }}</td>
                                <td>{{ $user->position->name ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary edit-ball-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#edit-ball-modal"
                                            data-user-id="{{ $user->id }}"
                                            data-current-ball="{{ $user->balls->amount ?? 0 }}">
                                        {{ $user->balls->amount ?? 0 }}
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('user-edit', $user->id) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('user.product.views', $user->id) }}"
                                       class="btn btn-sm btn-outline-info me-1" title="Mahsulotlar ko‘rish">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ route('delete-user', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Ishonchingiz komilmi?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Foydalanuvchilar topilmadi</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Create User Modal --}}
    <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('store-users') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Yangi foydalanuvchi yaratish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body">
                    @foreach (['name', 'username', 'password', 'phone', 'passport', 'jshshir'] as $field)
                        <div class="mb-3">
                            <label class="form-label">{{ ucfirst($field) }}</label>
                            <input type="{{ $field === 'password' ? 'password' : 'text' }}"
                                   name="{{ $field }}"
                                   class="form-control"
                                   placeholder="{{ ucfirst($field) }}"
                                   {{ in_array($field, ['jshshir']) ? 'maxlength=14 minlength=14' : '' }}
                                   required>
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label class="form-label">Lavozim</label>
                        <select class="form-select" name="position_id" required>
                            <option value="" disabled selected>Tanlang</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Yaratish</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Create Ball Modal --}}
    <div class="modal fade" id="create-balls-modal" tabindex="-1" aria-labelledby="createBallLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('create-ball', $user->id ?? 0) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ball qo‘shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Foydalanuvchi</label>
                        <select class="form-select" name="user_id" required>
                            <option value="" disabled selected>Tanlang</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ball miqdori</label>
                        <input class="form-control" type="number" name="amount" min="0" max="10" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success w-100" type="submit">Berish</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Ball Modal --}}
    <div class="modal fade" id="edit-ball-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="edit-ball-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Ballni tahrirlash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Amal turi</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="action" id="set" value="set" checked>
                            <label class="btn btn-outline-primary" for="set">O‘rnatish</label>

                            <input type="radio" class="btn-check" name="action" id="inc" value="increment">
                            <label class="btn btn-outline-success" for="inc">Qo‘shish</label>

                            <input type="radio" class="btn-check" name="action" id="dec" value="decrement">
                            <label class="btn btn-outline-warning" for="dec">Ayirish</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Miqdor</label>
                        <input class="form-control" type="number" name="amount" id="edit_ball_amount"
                               min="0" max="10" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary w-100" type="submit">Saqlash</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.edit-ball-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.dataset.userId;
                    const currentBall = button.dataset.currentBall;
                    const form = document.getElementById('edit-ball-form');
                    form.action = `/users/${userId}/balls`;
                    document.getElementById('edit_ball_amount').value = currentBall;
                });
            });
        });
    </script>
@endsection
