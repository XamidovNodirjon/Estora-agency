@extends('layouts.managers_layout')
@section('content')
    <h4>Ko‘rilgan mahsulotlar</h4>
    <ul>
        @forelse($products as $product)
            <li>{{ $product->name }} - {{ $product->phone }}</li>
        @empty
            <li>Hali hech qanday mahsulot ko‘rilmagan</li>
        @endforelse
    </ul>
@endsection
