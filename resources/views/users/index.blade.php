@extends('layouts.admin_layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary text-end" data-bs-toggle="modal"
                            data-bs-target="#signup-modal">Create user
                    </button>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Passport</th>
                                <th>Jshshir</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->passport }}</td>
                                    <td>{{ $user->jshshir }}</td>
                                    <td>{{ $user->position->name ?? '-' }}</td>
                                    <td>
                                        <a href="{{route('user-edit',$user->id)}}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{route('delete-user',$user->id)}}" method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($users->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">No users found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" action="{{ route('store-users') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" id="name" required placeholder="John">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" name="username" id="username" required
                                   placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password" required
                                   placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="text" name="phone" id="phone" required
                                   placeholder="+998901234567">
                        </div>
                        <div class="mb-3">
                            <label for="passport" class="form-label">Passport</label>
                            <input class="form-control" type="text" name="passport" id="passport" required
                                   placeholder="AA1234567">
                        </div>
                        <div class="mb-3">
                            <label for="jshshir" class="form-label">Jshshir</label>
                            <input class="form-control" type="text" name="jshshir" id="jshshir" required
                                   placeholder="12345678901234" maxlength="14" minlength="14">
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select class="form-control" name="position_id" id="position" required>
                                <option value="" disabled selected></option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Create user</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
