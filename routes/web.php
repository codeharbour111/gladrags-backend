<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ShopGramController;
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

Route::get('/banner', [BannerController::class, 'viewBanner'])->name('banner.list');
Route::get('/banner/add', [BannerController::class, 'addBanner'])->name('add.new.banner');
Route::post('/banner/add', [BannerController::class, 'storeBanner'])->name('store.banner');
Route::get('/banner/edit/{id}', [BannerController::class, 'editBanner'])->name('banner.edit');
Route::put('/banner/update/{id}', [BannerController::class, 'update'])->name('banner.update');
Route::delete('/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');

Route::get('/coupon', [CouponController::class, 'viewCoupon'])->name('coupon.list');
Route::get('/coupon/add', [CouponController::class, 'addCoupon'])->name('add.new.coupon');
Route::post('/coupon/add', [CouponController::class, 'storeCoupon'])->name('store.coupon');
Route::get('/coupon/edit/{id}', [CouponController::class, 'editCoupon'])->name('coupon.edit');
Route::put('/coupon/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
Route::delete('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');

Route::get('/shopgram', [ShopGramController::class, 'viewShopGram'])->name('shopgram.list');
Route::get('/shopgram/add', [ShopGramController::class, 'addShopGram'])->name('add.new.shopgram');
Route::post('/shopgram/add', [ShopGramController::class, 'storeShopGram'])->name('store.shopgram');
Route::get('/shopgram/edit/{id}', [ShopGramController::class, 'editShopGram'])->name('shopgram.edit');
Route::put('/shopgram/update/{id}', [ShopGramController::class, 'update'])->name('shopgram.update');
Route::delete('/shopgram/delete/{id}', [ShopGramController::class, 'destroy'])->name('shopgram.destroy');

// Products
Route::get('/product', [ProductController::class, 'index'])->name('product.list');
Route::get('/product/add', [ProductController::class, 'addProduct'])->name('add.new.product');
Route::post('/product/add', [ProductController::class, 'storeProduct'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
Route::get('/product/{id}/images/sort', [ProductController::class, 'sortImages'])->name('product.image.sort.view');
Route::post('/product/{id}/images/sort', [ProductController::class, 'sort'])->name('product.image.sort');
//Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::delete('/product_image/delete', [ProductController::class, 'deleteImage'])->name('product_image.delete');

// Categories
Route::get('/category-list', [CategoriesController::class, 'viewCategory'])->name('category.list');
Route::get('/category-list/add-new-category', [CategoriesController::class, 'addCategory'])->name('add.new.category');
Route::post('/category-list/add-new-category/store-category', [CategoriesController::class, 'storeCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoriesController::class, 'editCategory'])->name('category.edit');
Route::put('/category/update/{id}', [CategoriesController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');

// Orders
Route::get('/order-list', [OrderController::class, 'index'])->name('order.list');
Route::get('/order-list/order-detail', [OrderController::class, 'orderDetail'])->name('order.detail');
Route::get('/order/detail/{id}', [OrderController::class, 'detail'])->name('order.detail');

// Attributes
Route::get('/attribute-list', [AttributeController::class, 'index'])->name('attribute.list');
Route::get('/attribute-list/add-attribute', [AttributeController::class, 'addAttribute'])->name('add.attribute');
Route::get('/attribute-list/add-attribute/store-attribute', [AttributeController::class, 'storeAttribute'])->name('store.attribute');

// Users
Route::get('/user-list', [UserController::class, 'index'])->name('user.list');
Route::get('/user-list/add-user', [UserController::class, 'addUser'])->name('add.user');
Route::post('/user-list/add-user', [UserController::class, 'storeUser'])->name('user.store');
Route::get('/user-list/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
Route::post('/user-list/edit/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user-list/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/user-settings', [UserController::class, 'settings'])->name('user.settings');


// multiple image testing
Route::post('/store-images', [ProductController::class, 'storeImages'])->name('images.store');
Route::get('/upload-images', function () {
    return view('pages.products.upload');
})->name('images.upload');



require __DIR__ . '/auth.php';
