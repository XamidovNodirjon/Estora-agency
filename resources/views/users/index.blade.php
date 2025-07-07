@extends('layouts.admin_layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary text-end" data-bs-toggle="modal"
                                    data-bs-target="#create-modal">
                                <i class="fa fa-plus-circle"></i> Create users
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary text-end" data-bs-toggle="modal"
                                    data-bs-target="#create-balls-modal">
                                <i class="fa fa-plus-circle"></i> Create ball
                            </button>
                        </div>
                    </div>
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
                                <th>Balls</th>
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
                                        <button type="button" class="btn btn-sm btn-outline-primary edit-ball-btn"
                                                data-bs-toggle="modal" data-bs-target="#edit-ball-modal"
                                                data-user-id="{{ $user->id }}"
                                                data-current-ball="{{ $user->balls->amount ?? 0 }}">
                                            {{ $user->balls->amount ?? '0' }}
                                        </button>
                                    </td>
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
                                    <td colspan="9" class="text-center">No users found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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

    <div id="create-balls-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" action="{{route('create-ball',$user->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select class="form-control" name="user_id" id="user_id" required>
                                <option value="" disabled selected>Choose user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ballsize" class="form-label">Ball</label>
                            <input class="form-control" type="number" name="amount" id="ballsize"
                                   min="0" max="10" required placeholder="Kiriting">
                            <div id="ballsize-error" class="invalid-feedback" style="display: none;">
                                10 dan katta va 0 dan kichik ball kiritish mumkin emas!
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Berish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-ball-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" id="edit-ball-form" method="post">
                    @csrf
                    @method('PUT')
                    <!-- user_id ni yashirin maydon sifatida emas, balki URLda yuborish kerak -->

                        <div class="mb-3">
                            <label class="form-label">Amal turi</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="action" id="action_set" value="set" checked>
                                <label class="btn btn-outline-primary" for="action_set">O'rnatish</label>

                                <input type="radio" class="btn-check" name="action" id="action_increment"
                                       value="increment">
                                <label class="btn btn-outline-success" for="action_increment">Oshirish</label>

                                <input type="radio" class="btn-check" name="action" id="action_decrement"
                                       value="decrement">
                                <label class="btn btn-outline-warning" for="action_decrement">Kamaytirish</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_ball_amount" class="form-label">Miqdor</label>
                            <input class="form-control" type="number" name="amount" id="edit_ball_amount"
                                   min="0" max="10" required placeholder="Miqdorni kiriting">
                            <div id="edit-ball-error" class="invalid-feedback" style="display: none;">
                                10 dan katta va 0 dan kichik ball kiritish mumkin emas!
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Amalni bajaring</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editBallButtons = document.querySelectorAll('.edit-ball-btn');

            editBallButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-user-id');
                    const currentBall = this.getAttribute('data-current-ball');

                    // Form action URL ni o'rnatish
                    const form = document.getElementById('edit-ball-form');
                    form.action = `/users/${userId}/balls`;

                    // Ball qiymatini o'rnatish
                    document.getElementById('edit_ball_amount').value = currentBall;
                });
            });
        });
    </script>
@endsection
