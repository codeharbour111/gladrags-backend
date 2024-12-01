<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\PermissionManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Products
Route::get('/all-products', [ProductController::class, 'index'])->name('all.products');
Route::get('/all-products/add-new-product', [ProductController::class, 'addProduct'])->name('add.new.product');
Route::get('/all-products/add-new-product/store-product', [ProductController::class, 'storeProduct'])->name('store.product');

// Categories
Route::get('/category-list', [CategoryController::class, 'index'])->name('category.list');
Route::get('/category-list/add-new-category', [CategoryController::class, 'addCategory'])->name('add.new.category');
Route::get('/category-list/add-new-category/store-category', [CategoryController::class, 'storeCategory'])->name('store.category');

// Orders
Route::get('/order-list', [OrderController::class, 'index'])->name('order.list');
Route::get('/order-list/order-detail', [OrderController::class, 'orderDetail'])->name('order.detail');

// Attributes
Route::get('/attribute-list', [AttributeController::class, 'index'])->name('attribute.list');
Route::get('/attribute-list/add-attribute', [AttributeController::class, 'addAttribute'])->name('add.attribute');
Route::get('/attribute-list/add-attribute/store-attribute', [AttributeController::class, 'storeAttribute'])->name('store.attribute');

// Users
Route::get('/user-list', [UserController::class, 'index'])->name('user.list');
Route::get('/user-list/add-user', [UserController::class, 'addUser'])->name('add.user');



require __DIR__ . '/auth.php';
