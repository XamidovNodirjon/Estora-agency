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
    
@include('layouts.header')


<footer class="bg-gray-800 text-white p-8 mt-auto">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <img src="{{asset('logo-dashboard.png')}}" alt="Estora Logo" class="h-12 mb-4">
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
