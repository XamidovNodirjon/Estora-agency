<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log In | Estora Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="Login page for Estora Admin Dashboard" name="description"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .auth-bg-gradient {
            background: linear-gradient(135deg, #001f3f 0%, #002b5c 100%);
        }

        .left-panel-gradient {
            background: linear-gradient(135deg, #002b5c 0%, #001a35 100%);
            position: relative;
            overflow: hidden;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            overflow: hidden;
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

        .shape:nth-child(1) { top: 20%; left: 10%; width: 60px; height: 60px; animation-delay: 0s; }
        .shape:nth-child(2) { top: 60%; right: 15%; width: 80px; height: 80px; animation-delay: 2s; }
        .shape:nth-child(3) { bottom: 20%; left: 20%; width: 40px; height: 40px; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .input-focus {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
            border-radius: 0.75rem;
        }

        .btn-hover {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
        }
        .btn-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        .btn-hover:hover::before { left: 100%; }

        .mobile-logo { filter: brightness(0) invert(1); }

        .input-icon-container {
            position: relative;
        }

        .input-with-icon {
            padding-right: 2.5rem;
        }

        .input-icon {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            pointer-events: none;
            width: 1.25rem;
            height: 1.25rem;
        }

        .left-panel-rounded {
            border-top-left-radius: 1rem;
            border-bottom-left-radius: 1rem;
        }

        .right-panel-rounded {
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        @media (max-width: 768px) {
            .desktop-panel { display: none; }
            .mobile-header { display: block; }
            .main-container { height: calc(100% - 100px); }
            .form-container { padding: 1rem; }
            .form-input { padding: 0.5rem 2.5rem 0.5rem 0.75rem; font-size: 0.875rem; }
            .form-label { font-size: 0.75rem; }
            .form-button { padding: 0.75rem; font-size: 0.875rem; }
            .form-text { font-size: 0.75rem; }
            .right-panel-rounded {
                border-radius: 1rem;
            }
        }

        @media (min-width: 769px) {
            .desktop-panel { display: flex; }
            .mobile-header { display: none; }
            .main-container { height: 85%; }
            .form-container { padding: 2rem; }
            .form-input { padding: 0.75rem 2.5rem 0.75rem 1rem; font-size: 1rem; }
            .form-label { font-size: 0.875rem; }
            .form-button { padding: 0.75rem; font-size: 1rem; }
            .form-text { font-size: 0.875rem; }
        }
    </style>
</head>

<body class="auth-bg-gradient h-screen flex items-center justify-center">
<!-- Floating Shapes Background -->
<div class="floating-shapes absolute inset-0">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<div class="w-full max-w-6xl mx-auto px-4 relative z-10 h-full flex flex-col justify-center">
    <!-- Mobile Header -->
    <div class="mobile-header text-center mb-4">
        <img src="<?php echo e(asset('logo/logo-white.png')); ?>"
             onerror="this.onerror=null;this.src='https://placehold.co/150x45/ffffff/003366?text=ESTORA';"
             alt="Estora Logo"
             class="h-10 mx-auto mb-2 mobile-logo">
        <h1 class="text-lg font-bold text-white mb-1">Welcome Back</h1>
        <p class="text-blue-200 text-xs">Create your account to access your admin dashboard</p>
    </div>

    <!-- Main Container -->
    <div class="main-container flex flex-col lg:flex-row glassmorphism shadow-2xl">
        <!-- Left Panel -->
        <div class="desktop-panel w-full lg:w-1/2 left-panel-gradient left-panel-rounded p-4 lg:p-6 flex-col justify-between text-white relative">
            <div class="flex items-center mb-4">
                <img src="<?php echo e(asset('logo/logo-white.png')); ?>"
                     onerror="this.onerror=null;this.src='https://placehold.co/150x45/ffffff/003366?text=ESTORA';"
                     alt="Estora Logo"
                     class="h-8 mr-2">
            </div>

            <div class="flex-1 flex items-center">
                <div>
                    <h1 class="text-xl lg:text-3xl font-bold mb-3 leading-tight">
                        Hello.<br>
                        <span class="text-[#FFD700]">Return to the<br>bulletin board.</span>
                    </h1>
                    <p class="text-blue-200 mb-4 text-sm">
                        Access your admin dashboard and manage everything from one place.
                    </p>
                    <a href="<?php echo e(route('dashboard')); ?>"
                       class="inline-flex items-center bg-[#FFD700] text-[#003366] px-4 py-2 rounded-full font-semibold shadow-lg hover:bg-white hover:scale-105 transition-all duration-300 btn-hover">
                        View Dashboard
                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-container w-full lg:w-1/2 bg-white right-panel-rounded flex flex-col justify-center">
            <div class="text-center mb-4">
                <h4 class="text-gray-800 font-bold text-lg lg:text-2xl mb-1">Create account</h4>
                <p class="text-gray-600 form-text">Enter your credentials to access your account</p>
            </div>

            <form action="<?php echo e(route('register')); ?>" method="post" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div class="space-y-1">
                    <label for="name" class="block text-gray-700 form-label font-semibold">Name</label>
                    <div class="input-icon-container">
                        <input
                            class="form-input input-with-icon w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus"
                            name="name" type="text" id="name" placeholder="Enter your name" required>
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="sure_name" class="block text-gray-700 form-label font-semibold">Sure name</label>
                    <div class="input-icon-container">
                        <input
                            class="form-input input-with-icon w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus"
                            name="sure_name" type="text" id="sure_name" placeholder="Enter your sure name" required>
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="phone" class="block text-gray-700 form-label font-semibold">Phone number</label>
                    <div class="input-icon-container">
                        <input
                            class="form-input input-with-icon w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus"
                            name="phone" type="tel" id="phone" placeholder="Enter your phone number" required>
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="email" class="block text-gray-700 form-label font-semibold">Email</label>
                    <div class="input-icon-container">
                        <input
                            class="form-input input-with-icon w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus"
                            name="email" type="email" id="email" placeholder="Enter your email" required>
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-gray-700 form-label font-semibold">Password</label>
                    <div class="input-icon-container">
                        <input
                            class="form-input input-with-icon w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent text-gray-800 placeholder-gray-400 input-focus"
                            name="password" type="password" id="password" placeholder="Enter your password" required>
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
                    <div class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]" id="remember-me">
                        <label class="ml-2 text-gray-700 form-text" for="remember-me">Remember me</label>
                    </div>
                    <a href="<?php echo e(route('login.index')); ?>"
                       class="text-[#FFD700] hover:text-[#003366] hover:underline form-text font-medium transition-colors duration-200">
                        I am already a user
                    </a>
                </div>

                <div class="pt-2">
                    <button
                        class="form-button w-full bg-gradient-to-r from-[#003366] to-[#004080] text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:from-[#FFD700] hover:to-[#FFD700] hover:text-[#003366] transition-all duration-300 btn-hover transform hover:scale-[1.02]"
                        type="submit">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mt-2">
        <p class="text-blue-200 text-xs">
            © 2025 Estora Admin. All rights reserved.
        </p>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/Auth/Register.blade.php ENDPATH**/ ?>