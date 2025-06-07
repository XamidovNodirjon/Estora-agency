@extends('layouts.admin_layout')
@section('content')
    <div class="card p-4 shadow-sm rounded">
        <h4 class="mb-4 text-center fw-bold">Edit User</h4>
        <form action="{{ route('update-users', $user->id) }}" method="post" novalidate>
        @csrf
        @method('PUT') <!-- Update uchun method -->

            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="John"
                           value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Username -->
                <div class="col-md-6">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="username"
                           value="{{ old('username', $user->username) }}" required>
                </div>

                <!-- Password -->
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
                </div>

                <!-- Passport -->
                <div class="col-md-6">
                    <label for="passport" class="form-label fw-semibold">Passport</label>
                    <input type="text" name="passport" id="passport" class="form-control" placeholder="AA1234567"
                           value="{{ old('passport', $user->passport) }}" required>
                </div>

                <!-- Jshshir -->
                <div class="col-md-6">
                    <label for="jshshir" class="form-label fw-semibold">Jshshir</label>
                    <input type="text" name="jshshir" id="jshshir" class="form-control" placeholder="12345678901234" maxlength="14" minlength="14"
                           value="{{ old('jshshir', $user->jshshir) }}" required>
                </div>

                <!-- Position -->
                <div class="col-md-12">
                    <label for="position" class="form-label fw-semibold">Position</label>
                    <select name="position_id" id="position" class="form-select" required>
                        <option value="" disabled>-- Select Position --</option>
                        @foreach ($positions as $position)
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
@endsection
