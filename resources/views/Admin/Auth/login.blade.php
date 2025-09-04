<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log In | Estora Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Login page for UyTop Admin Dashboard" name="description"/>
    <meta content="Your Company" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .auth-bg-gradient {
            background: linear-gradient(135deg, #001f3f 0%, #002b5c 100%);
        }

        .left-panel-gradient {
            background: linear-gradient(135deg, #002b5c 0%, #001a35 100%);
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
            background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            transform: rotate(45deg);
            pointer-events: none;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 215, 0, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            top: 20%;
            left: 10%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            top: 60%;
            right: 15%;
            width: 80px;
            height: 80px;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            width: 40px;
            height: 40px;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
        }

        .btn-hover {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-hover:hover::before {
            left: 100%;
        }

        .mobile-logo {
            filter: brightness(0) invert(1);
        }

        @media (max-width: 768px) {
            .desktop-panel {
                display: none;
            }

            .mobile-header {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .desktop-panel {
                display: flex;
            }

            .mobile-header {
                display: none;
            }
        }
    </style>
</head>

<body class="auth-bg-gradient min-h-screen flex items-center justify-center relative">
<!-- Floating Shapes Background -->
<div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<div class="w-full max-w-6xl mx-auto px-4 relative z-10">
    <!-- Mobile Header (visible only on mobile) -->
    <div class="mobile-header text-center mb-8">
        <img src="{{asset('logo/logo-white.png')}}"
             onerror="this.onerror=null;this.src='https://placehold.co/200x60/ffffff/003366?text=ESTORA';"
             alt="Estora Logo"
             class="h-12 mx-auto mb-4 mobile-logo">
        <h1 class="text-2xl font-bold text-white mb-2">Welcome Back</h1>
        <p class="text-blue-200 text-sm">Sign in to access your admin dashboard</p>
    </div>

    <!-- Main Container -->
    <div class="flex flex-col lg:flex-row bg-white rounded-2xl overflow-hidden shadow-2xl glassmorphism">
        <div class="desktop-panel w-full lg:w-1/2 left-panel-gradient p-8 lg:p-12 flex-col justify-between items-start text-white relative min-h-[500px]">
            <div class="flex items-center mb-8">
                <img src="{{asset('logo/logo-white.png')}}"
                     onerror="this.onerror=null;this.src='https://placehold.co/150x45/ffffff/003366?text=ESTORA';"
                     alt="Estora Logo"
                     class="h-10 mr-3">
            </div>

            <div class="flex-1 flex items-center">
                <div class="text-left">
                    <h1 class="text-3xl lg:text-4xl font-bold mb-6 leading-tight">
                        Hello.<br>
                        <span class="text-[#FFD700]">Return to the<br>bulletin board.</span>
                    </h1>
                    <p class="text-blue-200 mb-8 text-lg">
                        Access your admin dashboard and manage everything from one place.
                    </p>
                    <button class="bg-[#FFD700] text-[#003366] px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-white hover:scale-105 transition-all duration-300 ease-in-out btn-hover">
                        <a href="{{route('dashboard')}}" class="flex items-center">
                            View Dashboard
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </button>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-[#FFD700] opacity-20 rounded-full transform translate-x-1/3 translate-y-1/3"></div>
            <div class="absolute top-1/4 right-1/4 w-20 h-20 bg-[#FFD700] opacity-15 rounded-full"></div>
            <div class="absolute top-0 left-1/4 w-16 h-16 bg-white opacity-10 rounded-full transform -translate-y-1/2"></div>
        </div>

        <!-- Right Panel / Main Panel (Login Form) -->
        <div class="w-full lg:w-1/2 p-6 lg:p-12 bg-white flex flex-col justify-center">
            <div class="text-center mb-8">
                <div class="lg:hidden mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#003366] to-[#004080] rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-gray-800 font-bold text-2xl lg:text-3xl mb-2">Sign In</h4>
                <p class="text-gray-600 text-sm lg:text-base">Enter your credentials to access your account</p>
            </div>

            <form action="{{route('login.store')}}" method="post" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label for="username" class="block text-gray-700 text-sm font-semibold">Username</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 lg:py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus text-base"
                               name="username"
                               type="text"
                               id="username"
                               placeholder="Enter your username"
                               required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-gray-700 text-sm font-semibold">Password</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 lg:py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus text-base"
                               name="password"
                               type="password"
                               required
                               id="password"
                               placeholder="Enter your password">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0">
                    <div class="flex items-center">
                        <input type="checkbox"
                               class="h-4 w-4 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]"
                               id="remember-me">
                        <label class="ml-2 text-gray-700 text-sm" for="remember-me">Remember me</label>
                    </div>
                    <a href="{{route('getRegister')}}"
                       class="text-[#FFD700] hover:text-[#003366] hover:underline text-sm font-medium transition-colors duration-200">
                        Create account
                    </a>
                </div>

                <div class="pt-2">
                    <button class="w-full bg-gradient-to-r from-[#003366] to-[#004080] text-white py-3 lg:py-4 rounded-xl font-semibold text-base lg:text-lg shadow-lg hover:shadow-xl hover:from-[#FFD700] hover:to-[#FFD700] hover:text-[#003366] transition-all duration-300 ease-in-out btn-hover transform hover:scale-[1.02]"
                            type="submit">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
        <p class="text-blue-200 text-xs lg:text-sm">
            © 2025 Estora Admin. All rights reserved.
        </p>
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
