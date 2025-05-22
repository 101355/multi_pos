<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\PasswordController;

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

require __DIR__ . '/auth.php';

Route::get('/logout_page', [DashboardController::class, 'logout_page'])->name('logout_page');

Route::middleware('auth:admin_users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('change-password', [PasswordController::class, 'edit'])->name('change-password.edit');
    Route::put('change-password', [PasswordController::class, 'update'])->name('change-password.update');
});

Route::middleware('auth:admin_users', 'verified')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Role
    Route::resource('role-createPage', RoleController::class);
    Route::get('user-role-datatable', [RoleController::class, 'datatable'])->name('user-role-datatable');

    // Admin User
    Route::resource('admin-user', AdminUserController::class);
    Route::get('admin-user-datatable', [AdminUserController::class, 'datatable'])->name('admin-user-datatable');

    // Category
    Route::resource('category', CategoryController::class);
    Route::get('category-datatable', [CategoryController::class, 'datatable'])->name('category-datatable');

    // Sub Category
    Route::resource('sub-category', SubcategoryController::class);
    Route::get('sub-category-datatable', [SubcategoryController::class, 'datatable'])->name('sub-category-datatable');
});
