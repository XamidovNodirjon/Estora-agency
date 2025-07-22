<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>UyTop admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid"
      data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
      data-sidebar-user='true'>

<div id="wrapper">

    <div class="navbar-custom card-body">
        <ul class="list-unstyled topnav-menu float-end mb-0">
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
        <div class="logo-box">
            <a href="" class="logo logo-light text-center">
            </a>
            <a href="" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="16">
                </span>
            </a>
        </div>
    </div>
    <div class="left-side-menu">
        <div class="h-100" data-simplebar>
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li class="menu-title">Navigation</li>
                    <li>
                        <a href="{{route('users')}}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="badge bg-success rounded-pill float-end"></span>
                            <span> Users </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('products')}}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="badge bg-success rounded-pill float-end"></span>
                            <span> Products </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reservations') }}">
                            <i class="mdi mdi-calendar-check"></i>
                            <span> Reservation Products </span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
        @include('layouts.footer')

    </div>
</div>

<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close"></i>
            </a>
            <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
        </div>
        <div class="tab-content pt-0">
            <div class="tab-pane active" id="settings-tab" role="tabpanel">
                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, Layout, etc.
                    </div>

                    <!-- Color Scheme -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="layout-color" value="light"
                               id="light-mode-check"/>
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="layout-color" value="dark"
                               id="dark-mode-check"/>
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>

                    <!-- Left Sidebar Color -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-color" value="light"
                               id="leftbar-light"/>
                        <label class="form-check-label" for="leftbar-light">Light</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-color" value="dark"
                               id="leftbar-dark"/>
                        <label class="form-check-label" for="leftbar-dark">Dark</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<div id="morris-bar-chart" style="height: 250px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Elementlarni tanlab olish
        const lightModeCheck = document.getElementById('light-mode-check');
        const darkModeCheck = document.getElementById('dark-mode-check');
        const leftbarLight = document.getElementById('leftbar-light');
        const leftbarDark = document.getElementById('leftbar-dark');

        // 2. Saqlangan sozlamalarni yuklash yoki standart qiymatlar
        const savedTheme = localStorage.getItem('theme') || 'light';
        const savedSidebar = localStorage.getItem('sidebar') || 'light';

        // 3. Radio tugmalarga qiymat berish
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

        // 4. Tema klasslarini qo'llash
        applyTheme(savedTheme, savedSidebar);

        // 5. O'zgarishlarni kuzatish
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

        // 6. Tema klasslarini qo'llash funksiyasi
        function applyTheme(theme, sidebar) {
            // Asosiy tema
            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(theme + '-mode');

            // Yon panel
            const leftSidebar = document.querySelector('.left-sidebar');
            if (leftSidebar) {
                leftSidebar.classList.remove('light-sidebar', 'dark-sidebar');
                leftSidebar.classList.add(sidebar + '-sidebar');
            }
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
