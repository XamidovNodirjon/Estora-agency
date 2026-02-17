@extends('layouts.managers_layout')

@section('content')
    <style>
        .page-header {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: none;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #6c757d;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
            color: #333;
        }

        .lead-name {
            font-weight: 600;
            color: #001F3F;
        }

        .lead-phone {
            font-family: monospace;
            font-size: 0.95rem;
            color: #013220;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: #e6f3ff;
            color: #0066cc;
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="page-header">
            <div>
                <h4 class="fw-bold text-dark-blue mb-1">Mening Lidlarim</h4>
                <p class="text-muted mb-0">Sizga biriktirilgan mijozlar ro'yxati</p>
            </div>
            <div>
                <span class="badge bg-light text-dark p-2 border">
                    Jami: <strong>{{ $leads->total() }}</strong> ta
                </span>
            </div>
        </div>

        <div class="card table-card">
            <div class="card-body p-0">
                @if($leads->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <h5>Hozircha lidlar yo'q</h5>
                        <p>Sizga hali hech qanday lid biriktirilmagan.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ism</th>
                                    <th>Telefon</th>
                                    <th>Manzil</th>
                                    <th>Qo'shilgan vaqt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>#{{ $lead->id }}</td>
                                        <td>
                                            <div class="lead-name">{{ $lead->name }}</div>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $lead->phone }}" class="lead-phone text-decoration-none">
                                                {{ $lead->phone }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($lead->address)
                                                <i class="fas fa-map-marker-alt text-muted me-1"></i> {{ $lead->address }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $lead->created_at->format('d.m.Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($leads->hasPages())
                        <div class="p-4 border-top">
                            {{ $leads->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection