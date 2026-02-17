@extends('layouts.admin_layout')
@section('title', 'Edit Lead')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                <h4 class="mb-sm-0 font-size-18">Edit Lead</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('lisds.update', $lisd->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $lisd->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $lisd->phone }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3"
                                required>{{ $lisd->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Assign to User (Optional)</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">-- Unassigned --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $lisd->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Lead</button>
                        <a href="{{ route('lisds.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection