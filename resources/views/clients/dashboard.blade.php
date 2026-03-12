@extends('layouts.client_layout')

@section('content')
<h1 class="page-title">Dashboard</h1>

<div class="placeholder-content" style="background-color: #f1f3f6; border: 1px solid #e2e8f0; border-radius: 8px; min-height: 500px;">
    <!-- Simple metric summary for functionality -->
    <div class="p-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h6 class="text-muted small uppercase fw-bold mb-3">Jami e'lonlar</h6>
                    <h2 class="fw-bold m-0">{{ $user->products()->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h6 class="text-muted small uppercase fw-bold mb-3">Ko'rishlar</h6>
                    <h2 class="fw-bold m-0">0</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h6 class="text-muted small uppercase fw-bold mb-3">Xabarlar</h6>
                    <h2 class="fw-bold m-0">0</h2>
                </div>
            </div>
        </div>
        
        <div class="mt-5 text-center py-5">
            <p class="text-muted">Bu yerda asosiy ma'lumotlar aks etadi.</p>
        </div>
    </div>
</div>
@endsection
