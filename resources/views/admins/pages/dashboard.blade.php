@extends('admins.pages.main')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen mt-6 p-4">
        <div class="flex flex-col gap-3">
            <div class="flex justify-between items-center px-2">
                <ul class="flex items-center text-sm">
                    <li class="ml-2">
                        <a href="/admin-dashboard" class="font-medium"><i
                                class="bi bi-house-door-fill text-blue-300 hover:text-blue-500"></i></a>
                    </li>
                    <li class="text-blue-300 ml-2 font-medium">/</li>
                    <li class="text-blue-300 ml-2 font-medium">@yield('title')</li>
                </ul>
                <button type="button" class="text-2xl font-bold text-gray-600 md:hidden lg:hidden lg:float-end"
                    onclick="Open()">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mt-2">Halaman Dashboard</h1>
            {{-- <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h1> --}}
        </div>

        <div class="flex flex-col justify-center items-center md:grid md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-6 mt-3">
            <div class="bg-white w-[280px] shadow-md rounded-lg p-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-700">Total Stock</h2>
                <p class="text-2xl lg:text-3xl font-bold text-green-500 mt-2">{{ $totalStock }}</p>
                <p class="text-sm text-gray-500 mt-1">Total item stock</p>
            </div>
            <div class="bg-white w-[280px] shadow-md rounded-lg p-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-700">Low Stock Items</h2>
                <p class="text-2xl lg:text-3xl font-bold text-yellow-500 mt-2">{{ $lowStockItems }}</p>
                <p class="text-sm text-gray-500 mt-1">Items with low stock</p>
            </div>
            <div class="bg-white w-[280px] shadow-md rounded-lg p-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-700">Total Categories</h2>
                <p class="text-2xl lg:text-3xl font-bold text-blue-500 mt-2">{{ $totalCategories }}</p>
                <p class="text-sm text-gray-500 mt-1">Total number of categories</p>
            </div>
            <div class="bg-white w-[280px] shadow-md rounded-lg p-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-700">Total Customers</h2>
                <p class="text-2xl lg:text-3xl font-bold text-green-500 mt-2">{{ $totalStock }}</p>
                <p class="text-sm text-gray-500 mt-1">Total List Customers</p>
            </div>

            <div class="bg-white w-[280px] shadow-md rounded-lg p-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-700">Low Stock Items</h2>
                <p class="text-2xl lg:text-3xl font-bold text-yellow-500 mt-2">{{ $lowStockItems }}</p>
                <p class="text-sm text-gray-500 mt-1">Items with low stock</p>
            </div>

            <div class="bg-white w-[280px] shadow-md rounded-lg p-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-700">Total Categories</h2>
                <p class="text-2xl lg:text-3xl font-bold text-blue-500 mt-2">{{ $totalCategories }}</p>
                <p class="text-sm text-gray-500 mt-1">Total number of categories</p>
            </div>
        </div>

    </div>
@endsection
