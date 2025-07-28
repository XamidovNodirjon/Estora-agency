@extends('layouts.admin_layout')
@section('content')
    <div class="card p-4 shadow-sm rounded">
        <h4 class="mb-4 text-center fw-bold">Edit {{ $user->name }}</h4>
        <form action="{{ route('update-users', $user->id) }}" method="post" novalidate>
        @csrf
        @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="John"
                           value="{{ old($user->name) }}" required>
                    <div id="name-feedback" class="invalid-feedback">
                        Faqat harflar kiritish mumkin.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="username"
                           value="{{ old('username', $user->username) }}" required>
                    <div id="username-feedback" class="invalid-feedback">
                        Faqat harflar va raqamlar kiritish mumkin.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" >
                    <small class="form-text text-muted">Leave blank if you don't want to change password</small>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone" class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="+998901234567"
                           value="{{ old('phone', $user->phone) }}" required>
                    <div id="phone-feedback" class="invalid-feedback">
                        Faqat raqam kiritish mumkin.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="passport" class="form-label fw-semibold">Passport</label>
                    <input type="text" name="passport" id="passport" class="form-control" placeholder="AA1234567"
                           value="{{ old('passport', $user->passport) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="jshshir" class="form-label fw-semibold">Jshshir</label>
                    <input type="text" name="jshshir" id="jshshir" class="form-control" placeholder="12345678901234" maxlength="14" minlength="14"
                           value="{{ old('jshshir', $user->jshshir) }}" required>
                    <div id="jshshir-feedback" class="invalid-feedback">
                        Faqat raqam kiritish mumkin 14 tadan kam bo'lmasligi kerak.
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="position" class="form-label fw-semibold">Position</label>
                    <select name="position_id" id="position" class="form-select" required>
                        <option value="" disabled> Select Position </option>
                        @foreach ($positions as $position)
                            @if ($position->name === 'superAdmin')
                                @continue
                            @endif
                            <option value="{{ $position->id }}" {{ old('position_id', $user->position_id) == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-pill">Update User</button>
            </div>
        </form>
    </div>
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
        });
    </script>
@endsection
