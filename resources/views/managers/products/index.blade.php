@extends('layouts.managers_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('manager-create-product')}}" type="button" class="btn btn-primary text-end">Create
                        product
                    </a>
                    <p>Your balls = {{$user->balls->amount}}</p>
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
                                    <td>
                                        @if($product->isPhoneVisibleTo(auth()->user()) ?? '')
                                            {{ $product->phone }}
                                        @else
                                            <form action="{{ route('manager.reveal-phone', $product->id) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    Reveal phone (–1 ball)
                                                </button>
                                            </form>
                                        @endif
                                    </td>

                                    <td>{{ $product->square}}</td>
                                    <td>{{ $product->rooms}}</td>
                                    <td>{{ $product->sotix}}</td>
                                    <td class="text-nowrap" style="width: 180px;">
                                        <div class="d-flex gap-2">
                                            <a href="{{route('edit-product',$product->id)}}"
                                               class="btn btn-sm btn-primary"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href=""
                                               class="btn btn-sm btn-info text-white"
                                               title="View details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="+" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if($products->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">No products found.</td>
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
