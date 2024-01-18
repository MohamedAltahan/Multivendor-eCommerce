<?php

use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
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
});
