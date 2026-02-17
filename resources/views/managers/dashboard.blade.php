@extends('layouts.managers_layout')

@section('content')
    <style>
        :root {
            --primary-green: #013220;
            --primary-gold: #B9952F;
            --dark-blue: #001F3F;
            --text-dark: #1a1a1a;
            --text-muted: #6c757d;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .dashboard-header {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 100%;
            background: linear-gradient(135deg, rgba(185, 149, 47, 0.1), rgba(1, 50, 32, 0.05));
            border-radius: 0 20px 20px 0;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.03);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Card Variants */
        .card-leads .stat-icon {
            background: rgba(0, 31, 63, 0.1);
            color: var(--dark-blue);
        }

        .card-leads .stat-value {
            color: var(--dark-blue);
        }

        .card-products .stat-icon {
            background: rgba(1, 50, 32, 0.1);
            color: var(--primary-green);
        }

        .card-products .stat-value {
            color: var(--primary-green);
        }

        .card-balls {
            background: linear-gradient(135deg, var(--primary-gold), #d4af37);
            color: white;
        }

        .card-balls .stat-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .card-balls .stat-value {
            color: white;
        }

        .card-balls .stat-label {
            color: rgba(255, 255, 255, 0.9);
        }

        .card-balls .stat-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* Recent Table */
        .recent-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .section-title {
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-table th {
            background: #f8f9fa;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            border: none;
            padding: 1rem;
        }

        .custom-table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: var(--text-dark);
            font-weight: 500;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            background: rgba(1, 50, 32, 0.1);
            color: var(--primary-green);
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="dashboard-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--primary-green);">Xush kelibsiz, {{ $user->name }}!</h2>
                <p class="mb-0 text-muted">Bugungi statistikangiz bilan tanishing.</p>
            </div>
            <div class="text-end d-none d-md-block">
                <h5 class="fw-bold mb-0 text-dark">{{ date('F d, Y') }}</h5>
                <small class="text-muted">{{ date('l') }}</small>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row g-4 mb-4">
            <!-- Balls (Highlight) -->
            <div class="col-md-4">
                <div class="stat-card card-balls">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-value">{{ $ballsCount }}</div>
                            <div class="stat-label">Balansingiz</div>
                            <div class="stat-desc">Mavjud ballar</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top border-white-50 d-flex justify-content-between align-items-center">
                        <span style="font-size: 0.9rem; opacity: 0.9;"> Faol bo'ling! </span>
                        <i class="fas fa-chart-line opacity-75"></i>
                    </div>
                </div>
            </div>

            <!-- Leads -->
            <div class="col-md-4">
                <div class="stat-card card-leads">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-value">{{ $leadsCount }}</div>
                            <div class="stat-label">Biriktirilgan Lidlar</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('manager.leads') }}" class="text-decoration-none fw-bold"
                            style="color: var(--dark-blue); font-size: 0.9rem;">
                            Barchasini ko'rish <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-md-4">
                <div class="stat-card card-products">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-value">{{ $productsCount }}</div>
                            <div class="stat-label">Jami E'lonlar</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-home"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('manager-products') }}" class="text-decoration-none fw-bold"
                            style="color: var(--primary-green); font-size: 0.9rem;">
                            Ro'yxatga o'tish <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity / Links -->
        <div class="row">
            <div class="col-12">
                <div class="recent-section">
                    <div class="section-title">
                        <span><i class="fas fa-bolt me-2 text-warning"></i> Tezkor havolalar</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('manager-create-product') }}"
                                class="btn w-100 py-3 text-white fw-bold d-flex align-items-center justify-content-center"
                                style="background-color: var(--primary-green); border-radius: 12px; transition: 0.3s;">
                                <i class="fas fa-plus-circle me-2"></i> Yangi E'lon
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('manager-products') }}"
                                class="btn w-100 py-3 fw-bold d-flex align-items-center justify-content-center"
                                style="background-color: #f1f3f5; color: var(--dark-blue); border-radius: 12px; transition: 0.3s;">
                                <i class="fas fa-search me-2"></i> Qidiruv
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection