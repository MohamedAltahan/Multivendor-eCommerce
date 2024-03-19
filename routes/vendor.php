<?php

use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorMessageController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\vendorProductVariantController;
use App\Http\Controllers\Backend\VendorVariantDetailsController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorVariantController;
use App\Http\Controllers\Backend\VendorWithdrawController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:vendor'], 'prefix' => 'vendor', 'as' => 'vendor.'], function () {
    //dashboard-----------------------------------------------------------------------
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

    //profile routes------------------------------------------------------------------
    Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile', [VendorProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile', [VendorProfileController::class, 'passwordUpdate'])->name('password.update');

    // vendor shop profile=============================================================
    Route::resource('shop-profile', VendorShopProfileController::class);

    // product ========================================================================
    Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])->name('product.change-status');
    Route::delete('products/delete-product-image', [VendorProductController::class, 'deleteProductImage'])->name('product.delete-product-image');
    Route::get('products/get-prodcut-images', [VendorProductController::class, 'getProductImages'])->name('product.get-product-images');
    Route::post('products/product-images-uplaod/{product}', [VendorProductController::class, 'uploadProductImages'])->name('product.upload.images');
    Route::resource('products', VendorProductController::class);

    //subcategories and child categories===============================================
    Route::get('get-sub-categories', [ChildCategoryController::class, 'getSubCategories'])->name('get-sub-categories');
    Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');

    // variants==============================================================================================
    Route::put('variant-status/change-status', [VendorVariantController::class, 'changeStatus'])->name('variant.change-status');
    Route::resource('variant', VendorVariantController::class);

    // variant details==============================================================================================
    Route::get('product/variant-details/{variantId}', [VendorVariantDetailsController::class, 'index'])->name('product.variant-details.index');
    Route::get('product/variant-details/create/{variantId}', [VendorVariantDetailsController::class, 'create'])->name('product.variant-details.create');
    Route::post('product/variant-details', [VendorVariantDetailsController::class, 'store'])->name('product.variant-details.store');
    Route::get('product/variant-details-edit/{VariantDetailsId}', [VendorVariantDetailsController::class, 'edit'])->name('product.variant-details.edit');
    Route::put('product/variant-details-update/{VariantDetailsId}', [VendorVariantDetailsController::class, 'update'])->name('product.variant-details.update');
    Route::delete('product/variant-details/{VariantDetailsId}/', [VendorVariantDetailsController::class, 'destroy'])->name('product.variant-details.destroy');
    Route::put('product/variant-details-status/change-status', [VendorVariantDetailsController::class, 'changeStatus'])->name('product.variant-details.change-status');

    //product variant==============================================================================================
    Route::put('variant-details/change-status', [vendorProductVariantController::class, 'changeStatus'])->name('variant-details.change-status');
    Route::get('get-variant-details', [vendorProductVariantController::class, 'getVariantDetails'])->name('get-variant-details');
    Route::resource('product-variant', vendorProductVariantController::class);
    // orders=====================================================================================
    Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [VendorOrderController::class, 'show'])->name('orders.show');
    Route::get('orders/status/{id}', [VendorOrderController::class, 'orderStatus'])->name('orders.status');

    // reviews=====================================================================================
    Route::get('reivews', [VendorProductReviewController::class, 'index'])->name('reviews.index');

    // withdraw====================================================================================
    Route::get('withdraw-request-details/{id}', [VendorWithdrawController::class, 'showRequestDetails'])->name('withdraw-request-details.show');
    Route::resource('withdraw', VendorWithdrawController::class);

    // messages====================================================================================
    Route::get('messages', [VendorMessageController::class, 'index'])->name('messages.index');
    Route::get('get-messages', [VendorMessageController::class, 'getMessages'])->name('get-messages');
    Route::post('send-message', [VendorMessageController::class, 'sendMessage'])->name('send-message');
});
