<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ShopGramController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\GladragsUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::get('/users', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users-list', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users', function (Request $request) {
        return app(SampleUserApi::class)->create($request);
    });

    Route::get('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->get($id);
    });

    Route::put('/users/{id}', function ($id, Request $request) {
        return app(SampleUserApi::class)->update($id, $request);
    });

    Route::delete('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->delete($id);
    });


    Route::get('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles-list', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->create($request);
    });

    Route::get('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->get($id);
    });

    Route::put('/roles/{id}', function ($id, Request $request) {
        return app(SampleRoleApi::class)->update($id, $request);
    });

    Route::delete('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->delete($id);
    });

    Route::post('/roles/{id}/users', function (Request $request, $id) {
        $request->merge(['id' => $id]);
        return app(SampleRoleApi::class)->usersDatatableList($request);
    });

    Route::delete('/roles/{id}/users/{user_id}', function ($id, $user_id) {
        return app(SampleRoleApi::class)->deleteUser($id, $user_id);
    });



    Route::get('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions-list', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->create($request);
    });

    Route::get('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->get($id);
    });

    Route::put('/permissions/{id}', function ($id, Request $request) {
        return app(SamplePermissionApi::class)->update($id, $request);
    });

    Route::delete('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->delete($id);
    });

    Route::get('/banner', [BannerController::class, 'load']);
    Route::get('/shopgram', [ShopGramController::class, 'load']);

    Route::get('/coupon', [CouponController::class, 'load']);
    Route::get('/coupon/{id}', [CouponController::class, 'show']);
    Route::get('/coupon-by-code', [CouponController::class, 'getCouponByCode']);    

    Route::get('/categories', [CategoriesController::class, 'load']);
    Route::get('/categories/{id}', [CategoriesController::class, 'show']);
    Route::post('/categories/add', [CategoriesController::class, 'store']);
    Route::post('/categories/update/{id}', [CategoriesController::class, 'update_category']);
    Route::get('/categories/{id}/stock/{productId}', [CategoriesController::class, 'getStockByCategoryAndProduct']);

    Route::get('/product', [ProductController::class,'load']);
    Route::get('/product/{id}', [ProductController::class,'loadProduct']);
    Route::post('/product/add', [ProductController::class, 'store']);
    Route::get('/product/latest/all', [ProductController::class, 'loadLatestProduct']);
    Route::post('/products', [ProductController::class, 'loadProducts']);
    Route::post('/products/filter', [ProductController::class, 'filterProducts'])->name('products.filter');

    Route::get('/order', [OrderController::class,'load']);
    Route::get('/order/{id}', [OrderController::class,'index']);
    Route::post('/order/add', [OrderController::class, 'store']);
    Route::post('/order/update-status', [OrderController::class, 'update_status']);
    Route::get('/orders/user/{userId}', [OrderController::class, 'getOrdersByUserId']);
    
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::get('/wishlist/{userId}', [WishlistController::class, 'getWishlistProductIds']);

    Route::post('/cart', [UserCartController::class, 'store']);
    Route::get('/cart/{userId}', [UserCartController::class, 'getCartProducts']);
    
    // Route::get('users/register', [AdminAuthController::class, 'register'])
    //     ->name('gladragsuser.register');
    // Route::get('users/login', [GladragsUserController::class, 'login'])
    //     ->name('gladragsuser.login');
    // Route::post('admin/login', [GladragsUserController::class, 'handle_login'])
    //     ->name('gladragsuser.handle_login');
    // Route::get('admin/logout', [GladragsUserController::class, 'logout'])
    //     ->name('gladragsuser.logout');

    Route::post('/login',  [GladragsUserController::class, 'login'])->name('gladragsuser.login');
    Route::post('/register', [GladragsUserController::class, 'register'])->name('gladragsuser.register');
    Route::post('/update-address',  [GladragsUserController::class, 'update_address'])->name('gladragsuser.update_address');
    Route::post('/update-password',  [GladragsUserController::class, 'update_password'])->name('gladragsuser.update_password');
});

// Route::post('login', [ApiController::class, 'authenticate']);
// Route::post('register', [ApiController::class, 'register']);

// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::get('logout', [ApiController::class, 'logout']);
//     Route::get('get_user', [ApiController::class, 'get_user']);
//     Route::get('products', [ProductController::class, 'index']);
//     Route::get('products/{id}', [ProductController::class, 'show']);
//     Route::post('create', [ProductController::class, 'store']);
//     Route::put('update/{product}',  [ProductController::class, 'update']);
//     Route::delete('delete/{product}',  [ProductController::class, 'destroy']);
// });
