<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShowProductController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');



// auth routes--------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// user routes==================================================================================
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'passwordUpdate'])->name('password.update');
    //addresses==================================================================================
    Route::resource('address', UserAddressController::class);
    //checkout===================================================================================
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckoutController::class, 'createAddress'])->name('checkout.create.address');
    Route::post('checkout/submit-checkout', [CheckoutController::class, 'submitCheckout'])->name('checkout.submit-checkout');
    //payment======================================================================================
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
});

//login for admins=============================================================================
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
//flash sale===================================================================================
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');
//view product detials=========================================================================
Route::get('show-product-details/{slug}', [ShowProductController::class, 'showProductDetails'])->name('show-product-details');
// cart==================================================================================
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart-update-quantity', [CartController::class, 'cartUpdateQuantity'])->name('cart-update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('remove-cart-product/{rowId}', [CartController::class, 'removeCartProduct'])->name('remove-cart-product');
Route::get('get-cart-count', [CartController::class, 'getCartCount'])->name('get-cart-count');
Route::get('get-cart-products', [CartController::class, 'getCartProducts'])->name('get-cart-products');
Route::get('get-cart-subtotal', [CartController::class, 'calcCartTotal'])->name('get-cart-subtotal');
Route::post('remove-side-cart-product', [CartController::class, 'removeSideCartProduct'])->name('remove-side-cart-product');
//apply coupon on cart
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
