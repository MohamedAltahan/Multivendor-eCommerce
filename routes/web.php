<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Frontend\BecomeVendorRequestController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsLetterController;
use App\Http\Controllers\Frontend\OrderTrackController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ShowProductController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\WishlistController;
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
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// user routes==================================================================================
Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
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
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    //paypal ----------------------
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    //stripe-----------------------
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
    //cod---------------------------
    Route::get('cod/payment', [PaymentController::class, 'payOnCod'])->name('cod.payment');
    // orders===============================================================================
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');
    // wishlist===============================================================================
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    //review =================================================================================
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');
    //become a vendor request===============================================================
    Route::get('become-a-vendor-request', [BecomeVendorRequestController::class, 'index'])->name('become-a-vendor-request');
    Route::post('become-a-vendor-request', [BecomeVendorRequestController::class, 'create'])->name('become-a-vendor-request.create');
    // messages===============================================================
    Route::get('messages', [UserMessageController::class, 'index'])->name('messages.index');
    Route::get('get-messages', [UserMessageController::class, 'getMessages'])->name('get-messages');
    Route::post('send-message', [UserMessageController::class, 'sendMessage'])->name('send-message');
}); //end group


//wish list=========================================================================================
Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');

//flash sale===================================================================================
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

// products =========================================================================
Route::get('products', [ShowProductController::class, 'productsIndex'])->name('products.index');
Route::get('show-product-details/{slug}', [ShowProductController::class, 'showProductDetails'])->name('show-product-details');
Route::get('change-product-list-view', [ShowProductController::class, 'changeListView'])->name('change-product-list-view');

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

//apply coupon on cart====================================================================
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

// news letter ===========================================================================
Route::post('newsletter-subscribe', [NewsLetterController::class, 'newsLetterSubscribe'])->name('newsletter-subscribe');
Route::get('newsletter-verify/{token}', [NewsLetterController::class, 'newsLetterEmailVerification'])->name('newsletter-verify');
//vendors pages===========================================================================
Route::get('vendors', [HomeController::class, 'vendorPage'])->name('vendors.page');
Route::get('vendor-products/{id}', [HomeController::class, 'vendorProducts'])->name('vendor-products');

//About page===========================================================================
Route::get('about', [PageController::class, 'about'])->name('about');

//terms and conditions page===========================================================================
Route::get('terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('terms-and-conditions');

//contact us========================================================================================
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');

//order track========================================================================================
Route::get('track-order', [OrderTrackController::class, 'index'])->name('track-order.index');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
