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
                            @if ($user->position->name === 'superAdmin')
                                @continue
                            @endif
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

   <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content border-radius-20px" action="{{ route('store-users') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Yangi foydalanuvchi yaratish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="Name"
                               required>
                        <div id="name-feedback" class="invalid-feedback">
                            Raqam kiritish mumkin emas.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username <span style="color: red;">*</span></label>
                        <input type="text"
                               name="username"
                               id="username"
                               class="form-control"
                               placeholder="Username"
                               required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control"
                               placeholder="Password"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone <span style="color: red;">*</span></label>
                        <input type="text"
                               name="phone"
                               id="phone"
                               class="form-control"
                               placeholder="Phone"
                               required>
                            <div id="phone-feedback" class="invalid-feedback">
                                Faqat raqam kiritish mumkin.
                            </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="passport" class="form-label">Passport <span style="color: red;">*</span></label>
                        <input type="text"
                               name="passport"
                               id="passport"
                               class="form-control"
                               placeholder="Passport"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="jshshir" class="form-label">Jshshir <span style="color: red;">*</span></label>
                        <input type="text"
                               name="jshshir"
                               id="jshshir"
                               class="form-control"
                               placeholder="Jshshir"
                               maxlength="14"
                               minlength="14"
                               required>
                            <div id="jshshir-feedback" class="invalid-feedback">
                                Faqat raqam kiritish mumkin 14 tadan kam bo'lmasligi kerak.
                            </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="position_id" class="form-label">Lavozim <span style="color: red;">*</span></label>
                    <select class="form-select" name="position_id" id="position_id" required>
                        <option value="" disabled selected>Tanlang</option>
                        @foreach ($positions as $position)
                            @if ($position->name !== 'superAdmin')
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endif
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
                            @if ($u->position->name !== 'superAdmin')
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endif
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const nameFeedback = document.getElementById('name-feedback');
        const phoneInput = document.getElementById('phone');
        const phoneFeedback = document.getElementById('phone-feedback');
        const jshshirInput = document.getElementById('jshshir');
        const jshshirFeedback = document.getElementById('jshshir-feedback');

        nameInput.addEventListener('input', function() {
            if (/\d/.test(this.value)) { 
                this.classList.add('is-invalid'); 
                nameFeedback.style.display = 'block'; 
            } else {
                this.classList.remove('is-invalid'); 
                nameFeedback.style.display = 'none'; 
            }
        });
        
        phoneInput.addEventListener('input', function() {
            if (!/^\d+$/.test(this.value)) { 
                this.classList.add('is-invalid'); 
                phoneFeedback.style.display = 'block'; 
            } else {
                this.classList.remove('is-invalid'); 
                phoneFeedback.style.display = 'none'; 
            }
        });
        jshshirInput.addEventListener('input', function() {
            if (!/^\d+$/.test(this.value) || this.value.length !== 14) { 
                this.classList.add('is-invalid'); 
                jshshirFeedback.style.display = 'block'; 
            } else {
                this.classList.remove('is-invalid'); 
                jshshirFeedback.style.display = 'none'; 
            }
        });

        const userForm = document.querySelector('#create-modal form');
        if (userForm) {
            userForm.addEventListener('submit', function(event) {
                if (/\d/.test(nameInput.value)) {
                    event.preventDefault(); 
                    nameInput.classList.add('is-invalid');
                    nameFeedback.style.display = 'block';
                    
                }
            });
        }
    });
</script>
@endsection
