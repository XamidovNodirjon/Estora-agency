<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora - Mening Sahifam</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/208I9p1y2H1G9kYV1D0Fm7q98m9p6L8m7p/S7k7p+W0A8w5w5A5w5w5w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
        }

        .social-icons a {
            color: var(--primary-color);
            margin-right: 15px;
        }

        .main-container {
            min-height: calc(100vh - 128px); /* Footer balandligini hisobga olgan holda */
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
<!-- Yangilangan Header -->
<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main class="main-container flex-grow container mx-auto p-4 md:p-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold text-xl">
                        IMG
                    </div>
                    <div>
                        <p class="font-bold text-lg text-gray-800"><?php echo e($client->name); ?></p>
                        <p class="text-gray-600"><?php echo e($client->sure_name); ?></p>
                        <p class="text-gray-500"><?php echo e($client->phone); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-gray-800 text-xl font-semibold mb-4">Mening sahifam</h2>
                <ul class="space-y-4 text-gray-600 font-medium">
                    <li>
                        <a href="#" class="flex items-center space-x-2 text-amber-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                            <span>Xabarlar</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('client.addList')); ?>" class="flex items-center space-x-2 hover:text-amber-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 11H5m14 0a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2a2 2 0 012-2z"/>
                            </svg>
                            <span>E'lonlarim</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 hover:text-amber-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span>Sevimlilar</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 hover:text-amber-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M10 16h.01"/>
                            </svg>
                            <span>Shartnoma</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Chat</h2>
                    <div class="flex space-x-2">
                        <button class="bg-amber-500 text-white px-4 py-2 rounded-lg font-medium">Sotish</button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium">Sotib olish</button>
                    </div>
                </div>
                <div class="relative mb-4">
                    <input type="text" placeholder="Qidirish"
                           class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <div class="text-center py-12">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 100 4 2 2 0 000-4zm-4 4a2 2 0 100-4 2 2 0 000 4z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Chatlar mavjud emas</p>
                    <p class="text-sm text-gray-400 mt-2">Sotuvchi bilan suhbatni boshlagingizda, u shu yerda paydo
                        bo'ladi</p>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-gray-800 text-white p-8 mt-auto">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <img src="<?php echo e(asset('logo/logo-white.png')); ?>" alt="Estora Logo" class="h-12 mb-4">
                <p class="text-sm">
                    YTT "Estora", 2025 y. Barcha huquqlar himoyalangan.
                    Saytdan foydalanish orqali <a href="#" class="underline">Foydalanuvchi shartnomasi</a> va <a
                        href="#" class="underline">Shaxsiy ma'lumotlarni qayta ishlash siyosati</a> bilan rozilik
                    bildirganingizni angalataadi.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Biz haqimizda</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:underline">Kompaniya haqida</a></li>
                    <li><a href="#" class="hover:underline">Yangiliklar</a></li>
                    <li><a href="#" class="hover:underline">Aloqa</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Xizmatlarimiz</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:underline">Ijara</a></li>
                    <li><a href="#" class="hover:underline">Sotib olish</a></li>
                    <li><a href="#" class="hover:underline">E'lon joylashtirish</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Bog'lanish</h3>
                <p class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.163 18 3 13.837 3 8V6a1 1 0 011-1h2a1 1 0 011 1z"/>
                    </svg>
                    <span>+998 (95) 160 64-46</span>
                </p>
                <div class="social-icons" style="color:#DEAD38">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-telegram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
<?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/clients/index.blade.php ENDPATH**/ ?>