<?php

use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorMessageController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\vendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantDetailsController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
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
    Route::delete('products/delete-product-image', [VendorProductController::class, 'deleteProductImage'])->name('product.delete-product-image');
    Route::get('products/get-prodcut-images', [VendorProductController::class, 'getProductImages'])->name('product.get-product-images');
    Route::post('products/product-images-uplaod/{product}', [VendorProductController::class, 'uploadProductImages'])->name('product.upload.images');
    Route::resource('products', VendorProductController::class);

    //subcategories and child categories===============================================
    Route::get('get-sub-categories', [ChildCategoryController::class, 'getSubCategories'])->name('get-sub-categories');
    Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');

    //product variant==============================================================================================
    Route::put('product-variant-status/change-status', [vendorProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
    Route::resource('product-variant', vendorProductVariantController::class);

    //product variant details==============================================================================================
    Route::get('product/product-variant-details/{productId}/{variantId}', [VendorProductVariantDetailsController::class, 'index'])->name('product.product-variant-details.index');
    Route::get('product/product-variant-details/create/{productId}/{variantId}', [VendorProductVariantDetailsController::class, 'create'])->name('product.product-variant-details.create');
    Route::post('product/product-variant-details', [VendorProductVariantDetailsController::class, 'store'])->name('product.product-variant-details.store');
    Route::get('product/product-variant-details-edit/{VariantDetailsId}', [VendorProductVariantDetailsController::class, 'edit'])->name('product.product-variant-details.edit');
    Route::put('product/product-variant-details-update/{VariantDetailsId}', [VendorProductVariantDetailsController::class, 'update'])->name('product.product-variant-details.update');
    Route::delete('product/product-variant-details/{VariantDetailsId}/', [VendorProductVariantDetailsController::class, 'destroy'])->name('product.product-variant-details.destroy');
    Route::put('product/product-variant-details-status/change-status', [VendorProductVariantDetailsController::class, 'changeStatus'])->name('product.product-variant-details.change-status');
    // orders=====================================================================================
    Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [VendorOrderController::class, 'show'])->name('orders.show');
    Route::get('orders/status/{id}', [VendorOrderController::class, 'orderStatus'])->name('orders.status');
    // reviews=====================================================================================
    Route::get('reivews', [VendorProductReviewController::class, 'index'])->name('reviews.index');
    // withdraw=====================================================================================
    Route::get('withdraw-request-details/{id}', [VendorWithdrawController::class, 'showRequestDetails'])->name('withdraw-request-details.show');
    Route::resource('withdraw', VendorWithdrawController::class);
    // messages===============================================================
    Route::post('view-messages', [VendorMessageController::class, 'index'])->name('view-messages.index');
});
