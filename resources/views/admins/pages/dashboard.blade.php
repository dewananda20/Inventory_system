@extends('admins.pages.main')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen mt-6 p-4">
        <div class="flex flex-col gap-3">
            <!-- Breadcrumb and Welcome Section -->
            <div class="flex justify-between items-center px-2">
                <ul class="flex items-center text-sm">
                    <li class="ml-2">
                        <a href="/admin-dashboard" class="font-medium">
                            <i class="bi bi-house-door-fill text-blue-300 hover:text-blue-500"></i>
                        </a>
                    </li>
                    <li class="text-blue-300 ml-2 font-medium">/</li>
                    <li class="text-blue-300 ml-2 font-medium">@yield('title')</li>
                </ul>
                <button type="button" class="text-2xl font-bold text-gray-600 md:hidden lg:hidden" onclick="Open()">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h1>
        </div>
        

        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold text-gray-700">Total Stock</h2>
                <p class="text-3xl font-bold text-green-500 mt-2">{{ $totalStock }}</p>
                <p class="text-sm text-gray-500 mt-1">Total item stock</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                <h2 class="text-xl font-semibold text-gray-700">Low Stock Items</h2>
                <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $lowStockItems }}</p>
                <p class="text-sm text-gray-500 mt-1">Items with low stock</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold text-gray-700">Total Categories</h2>
                <p class="text-3xl font-bold text-blue-500 mt-2">{{ $totalCategories }}</p>
                <p class="text-sm text-gray-500 mt-1">Total number of categories</p>
            </div>
        </div>

                <!-- Profile View -->
                <div class="mt-8 bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        {{ Auth::user()->username }} Profile
                        <hr class="h-px rounded bg-gray-200 border-0 dark:bg-gray-700">
                    </h2>
                    <div class="flex flex-col md:flex-row items-center mt-6">
                        <!-- Profile Picture -->
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/Admin.jpg') }}" alt="Profile Picture" class="rounded-full" height="150" width="150">
                        </div>
                        <!-- Profile Details -->
                        <div class="ml-4 flex-1">
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Username</h3>
                                    <p class="text-gray-900 dark:text-gray-400">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Email</h3>
                                    <p class="text-gray-900 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
