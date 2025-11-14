@extends('layouts.admin_layout')

@section('content')
    <style>
        :root {
            --gold-primary: #B28F3D;
            --gold-light: #DEAD38;
            --blue-primary: #003D7B;
            --blue-dark: #0A2F5A;
            --red-primary: #A83335;
            --green-primary: #00A859;
        }

        .gradient-gold {
            background: linear-gradient(135deg, #B28F3D 0%, #DEAD38 100%);
        }

        .gradient-blue {
            background: linear-gradient(135deg, #003D7B 0%, #0A2F5A 100%);
        }

        .gradient-green {
            background: linear-gradient(135deg, #00A859 0%, #00C468 100%);
        }

        .hover-gold:hover {
            background-color: #B28F3D;
            transform: translateY(-2px);
        }

        .hover-blue:hover {
            background-color: #003D7B;
            transform: translateY(-2px);
        }

        .hover-green:hover {
            background-color: #00A859;
            transform: translateY(-2px);
        }

        .shadow-gold {
            box-shadow: 0 4px 14px 0 rgba(178, 143, 61, 0.25);
        }

        .shadow-blue {
            box-shadow: 0 4px 14px 0 rgba(0, 61, 123, 0.25);
        }

        .shadow-green {
            box-shadow: 0 4px 14px 0 rgba(0, 168, 89, 0.25);
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        /* Fix horizontal scroll */
        body {
            overflow-x: hidden;
        }

        .table-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: nowrap;
        }

        .table-actions form {
            margin: 0;
            display: flex;
            gap: 0.25rem;
            align-items: center;
        }

        .edit-input {
            min-width: 100px;
            max-width: 120px;
        }
    </style>

    <div class="min-h-screen" style="background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);">
        <div class="container mx-auto px-4 sm:px-6 py-8">

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-4 mb-3">
                    <div class="w-14 h-14 gradient-blue rounded-2xl flex items-center justify-center shadow-blue flex-shrink-0">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold" style="color: #0A2F5A;">Mahsulot Ma'lumotlari</h1>
                        <p class="text-gray-600 text-xs sm:text-sm mt-1">Xususiyatlar, metro bekatlari va universitetlarni boshqarish paneli</p>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 animate-fade-in">
                    <div class="bg-white border-l-4 rounded-xl shadow-lg p-4" style="border-color: #00A859;">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6" style="color: #00A859;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold" style="color: #00A859;">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
        @endif

        <!-- Top 2 Cards (Side by Side) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                <!-- Features Card -->
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden card-hover">
                    <div class="h-2 gradient-gold"></div>
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shadow-gold flex-shrink-0" style="background-color: rgba(178, 143, 61, 0.15);">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: #B28F3D;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold" style="color: #B28F3D;">Xususiyatlar</h2>
                                    <p class="text-xs text-gray-500 hidden sm:block">Mahsulot xususiyatlari</p>
                                </div>
                            </div>
                            <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold text-white flex-shrink-0" style="background-color: #B28F3D;">
                            {{ count($features) }}
                        </span>
                        </div>

                        <!-- Add Form -->
                        <form action="{{ route('product.features.store') }}" method="POST" class="mb-5">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" name="feature_name" placeholder="Yangi xususiyat..."
                                       class="flex-1 border-2 border-gray-200 rounded-xl px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none transition-all"
                                       style="focus:border-color: #B28F3D;" required>
                                <button type="submit"
                                        class="px-4 sm:px-5 py-2 sm:py-2.5 text-white font-semibold rounded-xl shadow-md transition-all duration-300 hover-gold flex-shrink-0"
                                        style="background-color: #B28F3D;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </form>

                        <!-- Table -->
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full text-sm">
                                <thead>
                                <tr style="background-color: rgba(178, 143, 61, 0.08);">
                                    <th class="p-2 sm:p-3 text-left font-bold text-gray-700 w-8 sm:w-12">#</th>
                                    <th class="p-2 sm:p-3 text-left font-bold text-gray-700">Nomi</th>
                                    <th class="p-2 sm:p-3 text-center font-bold text-gray-700" style="width: 180px;">Amallar</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                @forelse($features as $key => $feature)
                                    <tr style="transition: background-color 0.2s;">
                                        <td class="p-2 sm:p-3 text-gray-600 font-medium">{{ $key+1 }}</td>
                                        <td class="p-2 sm:p-3 text-gray-800 font-semibold">{{ $feature->feature_name }}</td>
                                        <td class="p-2 sm:p-3">
                                            <div class="table-actions">
                                                <form action="{{ route('product.features.update', $feature->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="feature_name" value="{{ $feature->feature_name }}"
                                                           class="border border-gray-300 rounded-lg px-2 py-1 text-xs edit-input focus:outline-none"
                                                           style="focus:border-color: #B28F3D;">
                                                    <button type="submit"
                                                            class="px-2 sm:px-3 py-1 text-white rounded-lg text-xs font-medium shadow-sm transition-all duration-200 flex-shrink-0"
                                                            style="background-color: #DEAD38;"
                                                            onmouseover="this.style.backgroundColor='#B28F3D'"
                                                            onmouseout="this.style.backgroundColor='#DEAD38'">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('product.features.destroy', $feature->id) }}" method="POST"
                                                      onsubmit="return confirm('Bu xususiyatni o\'chirishga ishonchingiz komilmi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-2 sm:px-3 py-1 text-white rounded-lg text-xs font-medium shadow-sm transition-all duration-200 flex-shrink-0"
                                                            style="background-color: #A83335;"
                                                            onmouseover="this.style.backgroundColor='#8A2729'"
                                                            onmouseout="this.style.backgroundColor='#A83335'">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-8 text-center">
                                            <div class="flex flex-col items-center text-gray-400">
                                                <svg class="w-12 sm:w-16 h-12 sm:h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                </svg>
                                                <p class="font-medium text-sm">Ma'lumot topilmadi</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Metro Card -->
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden card-hover">
                    <div class="h-2 gradient-green"></div>
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shadow-green flex-shrink-0" style="background-color: rgba(0, 168, 89, 0.15);">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: #00A859;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold" style="color: #00A859;">Metro Bekatlari</h2>
                                    <p class="text-xs text-gray-500 hidden sm:block">Yaqin metro stantsiyalari</p>
                                </div>
                            </div>
                            <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold text-white flex-shrink-0" style="background-color: #00A859;">
                            {{ count($metros) }}
                        </span>
                        </div>

                        <!-- Add Form -->
                        <form action="{{ route('metro.store') }}" method="POST" class="mb-5">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" name="metro_name" placeholder="Yangi bekat..."
                                       class="flex-1 border-2 border-gray-200 rounded-xl px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none transition-all"
                                       style="focus:border-color: #00A859;" required>
                                <button type="submit"
                                        class="px-4 sm:px-5 py-2 sm:py-2.5 text-white font-semibold rounded-xl shadow-md transition-all duration-300 hover-green flex-shrink-0"
                                        style="background-color: #00A859;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </form>

                        <!-- Table -->
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full text-sm">
                                <thead>
                                <tr style="background-color: rgba(0, 168, 89, 0.08);">
                                    <th class="p-2 sm:p-3 text-left font-bold text-gray-700 w-8 sm:w-12">#</th>
                                    <th class="p-2 sm:p-3 text-left font-bold text-gray-700">Nomi</th>
                                    <th class="p-2 sm:p-3 text-center font-bold text-gray-700" style="width: 180px;">Amallar</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                @forelse($metros as $key => $metro)
                                    <tr style="transition: background-color 0.2s;">
                                        <td class="p-2 sm:p-3 text-gray-600 font-medium">{{ $key+1 }}</td>
                                        <td class="p-2 sm:p-3 text-gray-800 font-semibold">{{ $metro->metro_name }}</td>
                                        <td class="p-2 sm:p-3">
                                            <div class="table-actions">
                                                <form action="{{ route('metro.update', $metro->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="metro_name" value="{{ $metro->metro_name }}"
                                                           class="border border-gray-300 rounded-lg px-2 py-1 text-xs edit-input focus:outline-none"
                                                           style="focus:border-color: #00A859;">
                                                    <button type="submit"
                                                            class="px-2 sm:px-3 py-1 text-white rounded-lg text-xs font-medium shadow-sm transition-all duration-200 flex-shrink-0"
                                                            style="background-color: #DEAD38;"
                                                            onmouseover="this.style.backgroundColor='#B28F3D'"
                                                            onmouseout="this.style.backgroundColor='#DEAD38'">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('metro.destroy', $metro->id) }}" method="POST"
                                                      onsubmit="return confirm('Bu bekatni o\'chirishga ishonchingiz komilmi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-2 sm:px-3 py-1 text-white rounded-lg text-xs font-medium shadow-sm transition-all duration-200 flex-shrink-0"
                                                            style="background-color: #A83335;"
                                                            onmouseover="this.style.backgroundColor='#8A2729'"
                                                            onmouseout="this.style.backgroundColor='#A83335'">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-8 text-center">
                                            <div class="flex flex-col items-center text-gray-400">
                                                <svg class="w-12 sm:w-16 h-12 sm:h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                                <p class="font-medium text-sm">Ma'lumot topilmadi</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Universities Card (Full Width Below) -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden card-hover">
                <div class="h-2 gradient-blue"></div>
                <div class="p-4 sm:p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shadow-blue flex-shrink-0" style="background-color: rgba(0, 61, 123, 0.15);">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: #003D7B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg sm:text-xl font-bold" style="color: #003D7B;">Universitetlar</h2>
                                <p class="text-xs text-gray-500 hidden sm:block">Yaqin o'quv muassasalari</p>
                            </div>
                        </div>
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold text-white flex-shrink-0" style="background-color: #003D7B;">
                        {{ count($universities) }}
                    </span>
                    </div>

                    <!-- Add Form -->
                    <form action="{{ route('university.store') }}" method="POST" class="mb-5">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="university_name" placeholder="Yangi universitet..."
                                   class="flex-1 border-2 border-gray-200 rounded-xl px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none transition-all"
                                   style="focus:border-color: #003D7B;" required>
                            <button type="submit"
                                    class="px-4 sm:px-5 py-2 sm:py-2.5 text-white font-semibold rounded-xl shadow-md transition-all duration-300 hover-blue flex-shrink-0"
                                    style="background-color: #003D7B;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full text-sm">
                            <thead>
                            <tr style="background-color: rgba(0, 61, 123, 0.08);">
                                <th class="p-2 sm:p-3 text-left font-bold text-gray-700 w-8 sm:w-12">#</th>
                                <th class="p-2 sm:p-3 text-left font-bold text-gray-700">Nomi</th>
                                <th class="p-2 sm:p-3 text-center font-bold text-gray-700" style="width: 180px;">Amallar</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @forelse($universities as $key => $university)
                                <tr style="transition: background-color 0.2s;">
                                    <td class="p-2 sm:p-3 text-gray-600 font-medium">{{ $key+1 }}</td>
                                    <td class="p-2 sm:p-3 text-gray-800 font-semibold">{{ $university->university_name }}</td>
                                    <td class="p-2 sm:p-3">
                                        <div class="table-actions">
                                            <form action="{{ route('university.update', $university->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="university_name" value="{{ $university->university_name }}"
                                                       class="border border-gray-300 rounded-lg px-2 py-1 text-xs edit-input focus:outline-none"
                                                       style="focus:border-color: #003D7B;">
                                                <button type="submit"
                                                        class="px-2 sm:px-3 py-1 text-white rounded-lg text-xs font-medium shadow-sm transition-all duration-200 flex-shrink-0"
                                                        style="background-color: #DEAD38;"
                                                        onmouseover="this.style.backgroundColor='#B28F3D'"
                                                        onmouseout="this.style.backgroundColor='#DEAD38'">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('university.destroy', $university->id) }}" method="POST"
                                                  onsubmit="return confirm('Bu universitetni o\'chirishga ishonchingiz komilmi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-2 sm:px-3 py-1 text-white rounded-lg text-xs font-medium shadow-sm transition-all duration-200 flex-shrink-0"
                                                        style="background-color: #A83335;"
                                                        onmouseover="this.style.backgroundColor='#8A2729'"
                                                        onmouseout="this.style.backgroundColor='#A83335'">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-8 text-center">
                                        <div class="flex flex-col items-center text-gray-400">
                                            <svg class="w-12 sm:w-16 h-12 sm:h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            <p class="font-medium text-sm">Ma'lumot topilmadi</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
