<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\StaffMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
route::get('/', [AuthController::class, 'login']);
route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [ItemsController::class, 'index']);
    Route::get('/items', [ItemsController::class, 'items']);
    Route::get('/items', [ItemsController::class, 'items'])->name('items.index');
    Route::post('/items', [ItemsController::class, 'store'])->name('items.store');
    Route::get('/items/{id}', [ItemsController::class, 'show']);
    Route::delete('/items-admin/{id}', [ItemsController::class, 'delete'])->name('items.destroy.admins');
    Route::put('/items-admin/{id}', [ItemsController::class, 'update'])->name('items.update.admin');
    Route::get('/categories', [CategoryController::class, 'categories']); 
    Route::post('/categories-admin', [CategoryController::class, 'store'])->name('categories.store.admin');
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.destroy.admin');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('users.index.admin');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::put('admin/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff-dashboard', [ItemsController::class, 'index']);
    Route::get('/items-staff', [ItemsController::class, 'items']);
    Route::post('/items-staff', [ItemsController::class, 'store'])->name('items.store.staff');
    Route::put('/items/{id}', [ItemsController::class, 'updateStaff'])->name('items.update.staff');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store.staff');
    Route::get('/categories-staff', [CategoryController::class, 'categories']);
    Route::get('/categories-staff/{id}', [CategoryController::class, 'show']);
    Route::put('/categories-staff/{id}', [CategoryController::class, 'update'])->name('categories.update.staff');
    Route::delete('/categories-staff/{id}', [CategoryController::class, 'delete'])->name('categories.destroy.staff');
    Route::get('/staff/users', [UserController::class, 'showUsers'])->name('users.index');
});