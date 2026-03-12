<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <title>UyTop Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --sidebar-navy: #1e3a6d;
            --sidebar-active: #325695;
            --bg-gray: #f2f4f7;
            --logout-red: #e11d48;
        }

        body {
            font-family: 'Public Sans', sans-serif;
            background-color: var(--bg-gray);
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-navy);
            color: white;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-logo {
            padding: 25px 30px;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 15px;
            margin: 0;
        }

        .sidebar-item {
            margin-bottom: 5px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .sidebar-link i {
            font-size: 18px;
            margin-right: 15px;
        }

        .sidebar-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-link.active {
            color: white;
            background-color: var(--sidebar-active);
        }

        /* Main Content Styles */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .topbar {
            height: 70px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 40px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-weight: 600;
            color: #334155;
        }

        .btn-logout {
            background-color: var(--logout-red);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-logout:hover {
            opacity: 0.9;
        }

        .content-area {
            padding: 40px;
            flex-grow: 1;
        }

        .content-card {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            min-height: calc(100vh - 220px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 30px;
        }

        @media (max-width: 991px) {
            .sidebar { display: none; }
            .topbar { padding: 0 20px; }
            .content-area { padding: 20px; }
        }
    </style>
    @stack('css')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            LOGO
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('get.client') }}" class="sidebar-link {{ request()->routeIs('get.client') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-chat-dots-fill"></i>
                    Habarlar
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('client.likes') }}" class="sidebar-link {{ request()->routeIs('client.likes') ? 'active' : '' }}">
                    <i class="bi bi-heart-fill"></i>
                    Sevimillar
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-bell-fill"></i>
                    Obunalar
                </a>
            </li>
            <!-- Custom added links for functionality -->
            <li class="sidebar-item mt-4">
                <a href="{{ route('client.products.index') }}" class="sidebar-link {{ request()->routeIs('client.products.index') ? 'active' : '' }}">
                    <i class="bi bi-megaphone-fill"></i>
                    E'lonlarim
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('client.products.create') }}" class="sidebar-link {{ request()->routeIs('client.products.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle-fill"></i>
                    Yangi e'lon
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <div class="topbar">
            <div class="user-info">
                <span class="user-name">{{ explode(' ', Auth::user()->name)[0] }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Log Out</button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="content-card">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('js')
</body>

</html>
