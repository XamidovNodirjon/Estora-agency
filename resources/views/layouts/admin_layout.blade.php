<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <title>UyTop admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="{{asset('assets/logo/logo-white.png')}}">

    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <style>
        .language-selector {
            position: relative;
            cursor: pointer;
            z-index: 1001;
        }

        .select-language {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 5px;
            color: #6c757d;
        }

        .select-language:hover {
            background-color: #f8f9fa;
        }

        .language-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 150px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 8px;
            z-index: 1000;
        }

        .language-dropdown ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .language-dropdown li a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
        }

        .language-dropdown li a:hover {
            background-color: #f1f1f1;
        }

        .flag-icon {
            font-size: 1.2rem;
            line-height: 1; /* Bayroq va matnni bir qatorga to'g'rilash uchun */
            margin-right: 10px;

            /* Aylana shaklida ko'rsatish uchun stillar */
            width: 20px;
            height: 20px;
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid"
      data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
      data-sidebar-user='true'>

<div id="wrapper">

    <div class="navbar-custom card-body">
        <ul class="list-unstyled topnav-menu float-end mb-0 d-flex align-items-center">

            <li class="dropdown notification-list topbar-dropdown d-none d-lg-block">
                <div class="language-selector">
                    <div class="select-language" onclick="toggleLanguageDropdown()">
                        @php
                            $locale = session('locale', config('app.locale'));
                            $flagClass = '';
                            if ($locale === 'en') {
                                $flagClass = 'us';
                            } elseif ($locale === 'ru') {
                                $flagClass = 'ru';
                            } else {
                                $flagClass = 'uz';
                            }
                        @endphp
                        <span class="flag-icon flag-icon-{{ $flagClass }}"></span>
                        <span class="align-middle">{{ strtoupper($locale) }}</span>
                        <i class="mdi mdi-chevron-down ms-1"></i>
                    </div>
                    <div class="language-dropdown" id="languageDropdown">
                        <ul>
                            <li>
                                <a href="{{ route('lang.switch', 'en') }}">
                                    <span class="flag-icon flag-icon-us"></span>
                                    <span class="align-middle">English</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lang.switch', 'uz') }}">
                                    <span class="flag-icon flag-icon-uz"></span>
                                    <span class="align-middle">O‘zbek</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lang.switch', 'ru') }}">
                                    <span class="flag-icon flag-icon-ru"></span>
                                    <span class="align-middle">Русский</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="pro-user-name ms-1">
                        Logout <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="left-side-menu">
        <div class="h-100" data-simplebar>
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li class="menu-title">{{__('Navigation')}}</li>
                    <li>
                        <a href="{{route('users')}}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="badge bg-success rounded-pill float-end"></span>
                            <span>{{__('Users')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('products')}}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="badge bg-success rounded-pill float-end"></span>
                            <span> {{__('Products')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reservations') }}">
                            <i class="mdi mdi-calendar-check"></i>
                            <span>{{__('Reservation Products')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="content-page">
        <div class="content">
            <navigation></navigation>
            @yield('content')
        </div>
{{--        @include('layouts.footer')--}}
    </div>
</div>

<div id="morris-bar-chart" style="height: 250px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightModeCheck = document.getElementById('light-mode-check');
        const darkModeCheck = document.getElementById('dark-mode-check');
        const leftbarLight = document.getElementById('leftbar-light');
        const leftbarDark = document.getElementById('leftbar-dark');

        const savedTheme = localStorage.getItem('theme') || 'light';
        const savedSidebar = localStorage.getItem('sidebar') || 'light';

        if (savedTheme === 'light') {
            lightModeCheck.checked = true;
        } else {
            darkModeCheck.checked = true;
        }

        if (savedSidebar === 'light') {
            leftbarLight.checked = true;
        } else {
            leftbarDark.checked = true;
        }

        applyTheme(savedTheme, savedSidebar);

        lightModeCheck.addEventListener('change', function () {
            if (this.checked) {
                localStorage.setItem('theme', 'light');
                applyTheme('light', savedSidebar);
            }
        });

        darkModeCheck.addEventListener('change', function () {
            if (this.checked) {
                localStorage.setItem('theme', 'dark');
                applyTheme('dark', savedSidebar);
            }
        });

        leftbarLight.addEventListener('change', function () {
            if (this.checked) {
                localStorage.setItem('sidebar', 'light');
                applyTheme(savedTheme, 'light');
            }
        });

        leftbarDark.addEventListener('change', function () {
            if (this.checked) {
                localStorage.setItem('sidebar', 'dark');
                applyTheme(savedTheme, 'dark');
            }
        });

        function applyTheme(theme, sidebar) {
            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(theme + '-mode');

            const leftSidebar = document.querySelector('.left-sidebar');
            if (leftSidebar) {
                leftSidebar.classList.remove('light-sidebar', 'dark-sidebar');
                leftSidebar.classList.add(sidebar + '-sidebar');
            }
        }
    });
</script>

<script>
    function toggleLanguageDropdown() {
        const langDropdown = document.getElementById('languageDropdown');
        langDropdown.style.display = langDropdown.style.display === 'block' ? 'none' : 'block';
    }

    document.addEventListener('click', function (event) {
        const langSelector = document.querySelector('.language-selector');
        const langDropdown = document.getElementById('languageDropdown');

        if (langSelector && langDropdown && !langSelector.contains(event.target)) {
            langDropdown.style.display = 'none';
        }
    });
</script>


<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>

<script src="{{asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

<script src="{{asset('assets/libs/morris.js06/morris.min.js')}}"></script>
<script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>

<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous">
</script>

</body>
</html>
