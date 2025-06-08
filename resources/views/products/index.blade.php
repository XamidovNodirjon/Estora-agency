@extends('layouts.admin_layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('create-product')}}"  type="button" class="btn btn-primary text-end">Create product
                    </a>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>price</th>
                                <th>phone</th>
                                <th>square</th>
                                <th>rooms</th>
                                <th>sotix</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->phone}}</td>
                                        <td>{{ $product->square}}</td>
                                        <td>{{ $product->rooms}}</td>
                                        <td>{{ $product->sotix}}</td>
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
                                @if($products->isEmpty())
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
@endsection
