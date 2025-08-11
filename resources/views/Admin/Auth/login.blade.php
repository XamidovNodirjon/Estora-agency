<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log In | Estora Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Login page for UyTop Admin Dashboard" name="description"/>
    <meta content="Your Company" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
{{-- Faviconni qo'shish, agar mavjud bo'lsa --}}
{{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

<!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the background gradient and overlay */
        .auth-bg-gradient {
            /* Asosiy fon uchun to'q ko'k gradient */
            background: linear-gradient(135deg, #001f3f 0%, #002b5c 100%); /* Dark Navy to Darker Blue */
        }

        .auth-bg-pattern {
            /* Agar naqshli rasm mavjud bo'lsa, bu yerga qo'shishingiz mumkin */
            /* background-image: url('path/to/your/pattern.png'); */
            /* background-repeat: no-repeat; */
            /* background-size: cover; */
            /* background-position: center; */
        }

        .left-panel-gradient {
            /* Chap panel uchun yanada quyuqroq ko'k gradient */
            background: linear-gradient(135deg, #002b5c 0%, #001a35 100%); /* Darker Blue to Even Darker Blue */
            position: relative;
            overflow: hidden;
        }

        .left-panel-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            /* Oq rangli yorug'lik effekti saqlangan */
            background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            transform: rotate(45deg);
            pointer-events: none;
        }

        .right-panel-shadow {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="loading authentication-bg auth-bg-gradient min-h-screen flex items-center justify-center">

<div class="account-pages my-5 w-full max-w-4xl mx-auto">
    <div class="container mx-auto px-4">

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-8 w-full"> {{-- Ikki panelli joylashuv uchun kenglik moslashtirilgan --}}
                <div class="flex bg-white rounded-xl overflow-hidden shadow-2xl"> {{-- Ikki panel uchun asosiy konteyner --}}

                    {{-- Chap panel (Rasm/Matn tomoni) --}}
                    <div class="w-1/2 left-panel-gradient p-8 flex flex-col justify-between items-start text-white relative">
                        <div class="flex items-center mb-8">
                            {{-- Logo uchun joy tutuvchi rasm, agar sizda oq logo bo'lsa, uni ishlatishingiz mumkin --}}
                            <img src="{{asset('logo/logo-white.png')}}" onerror="this.onerror=null;this.src='https://placehold.co/100x30/002b5c/ffffff?text=YOUR+LOGO';" alt="Your Logo" class="h-15 mr-2">
                            {{-- <span class="text-lg font-bold">YOUR LOGO</span> --}} {{-- Agar matnli logo kerak bo'lsa --}}
                        </div>

                        <div class="text-left">
                            <h1 class="text-4xl font-bold mb-4">Hello. Return to the bulletin board.</h1>
                            <button class="bg-white text-[#FFD700] px-6 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition duration-300 ease-in-out">
                                <a href="{{route('dashboard')}}">
                                    View more
                                </a>
                            </button>
                        </div>

                        {{-- Qo'shimcha: Abstrakt shakllar/naqshlar --}}
                        <div class="absolute bottom-0 right-0 w-24 h-24 bg-[#FFD700] opacity-20 rounded-full transform translate-x-1/2 translate-y-1/2"></div>
                        <div class="absolute top-0 left-0 w-16 h-16 bg-[#FFD700] opacity-15 rounded-full transform -translate-x-1/2 -translate-y-1/2"></div>
                    </div>

                    {{-- O'ng panel (Login forma tomoni) --}}
                    <div class="w-1/2 p-8 bg-white right-panel-shadow flex flex-col justify-center">
                        <div class="text-center mb-6">
                            <h4 class="text-gray-800 font-bold text-2xl mb-4">Sign In</h4>
                        </div>

                        <form action="{{route('login.store')}}" method="post" class="space-y-5">
                            @csrf
                            <div class="mb-4">
                                <label for="username" class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                                <input class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FFD700] focus:border-[#FFD700] text-gray-800 placeholder-gray-400"
                                       name="username" type="text" id="username"
                                       placeholder="username">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                                <input class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FFD700] focus:border-[#FFD700] text-gray-800 placeholder-gray-400"
                                       name="password" type="password" required="" id="password"
                                       placeholder="Enter your password">
                            </div>

                            <div class="flex justify-between items-center mb-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input h-4 w-4 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]" id="remember-me">
                                    <label class="form-check-label text-gray-700 text-sm ml-2" for="remember-me">Remember me</label>
                                </div>
                                <a href="{{route('dashboard')}}" class="text-[#FFD700] hover:underline text-sm font-medium">Forgot password?</a>
                            </div>

                            <div class="mb-4">
                                <button class="btn btn-primary w-full bg-[#003366] text-white py-3 rounded-lg font-semibold text-lg shadow-md hover:bg-[#FFD700] hover:text-[#003366] transition duration-300 ease-in-out" type="submit"> Log In</button>
                            </div>
                        </form>

                        <div class="text-center mt-6">
                            <p class="text-gray-700 text-sm mb-3">Not a member yet?</p>
                            <button class="w-full bg-[#004080] text-white py-3 rounded-lg font-semibold text-lg shadow-md hover:bg-[#FFD700] hover:text-[#004080] transition duration-300 ease-in-out" type="button"> Sign up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/app.min.js"></script>

</body>
</html>
