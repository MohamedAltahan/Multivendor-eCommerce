<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminVendorProfileContorller;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\childCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantDetailsController;
use App\Http\Controllers\Backend\ProductVariantTypesController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');
    //profile routes==========================================================================================
    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [AdminProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update/password', [AdminProfileController::class, 'passwordUpdate'])->name('password.update');

    //slider routes============================================================================================
    Route::resource('slider', SliderController::class);

    //category routes==========================================================================================
    Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('category', CategoryController::class);

    //sub category routes=======================================================================================
    Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
    Route::resource('sub-category', SubCategoryController::class);

    //child category routes=====================================================================================
    Route::get('get-sub-categories', [ChildCategoryController::class, 'getSubCategories'])->name('get-sub-categories');
    Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::resource('child-category', ChildCategoryController::class);

    //brand routes===============================================================================================
    Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('brand', BrandController::class);

    //vendor Profile routes======================================================================================
    // Route::put('vendor/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('vendor-profile', AdminVendorProfileContorller::class);

    //products routes============================================================================================
    //product images**
    Route::get('products/get-prodcut-images', [ProductController::class, 'getProductImages'])->name('product.get-product-images');
    Route::delete('products/delete-product-image', [ProductController::class, 'deleteProductImage'])->name('product.delete-product-image');
    Route::post('products/product-images-uplaod/{product}', [ProductController::class, 'uploadProductImages'])->name('product.upload.images');
    //product**
    Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
    Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
    Route::resource('products', ProductController::class);
    //product get attribute values ajax
    Route::get('product/get-attribute-values', [ProductVariantTypesController::class, 'getProductAttributesValues'])->name('product.get-attribute-values');
    //product get attributes types ajax
    Route::get('product/get-attributes', [ProductVariantTypesController::class, 'getProductAttributes'])->name('product.get-attributes');
    //product variant types
    Route::resource('product-variant-types', ProductVariantTypesController::class);

    //product variant==============================================================================================
    Route::resource('product-variant', ProductVariantController::class);

    //product variant details==============================================================================================
    Route::get('product/product-variant-details/{productId}/{variantId}', [ProductVariantDetailsController::class, 'index'])->name('product.product-variant-details');
    Route::get('product/product-variant-details/create/{productId}/{variantId}', [ProductVariantDetailsController::class, 'create'])->name('product.product-variant-details.create');
    Route::post('product/product-variant-details', [ProductVariantDetailsController::class, 'store'])->name('product.product-variant-details.store');
    Route::get('product/product-variant-details-edit/{VariantDetailsId}', [ProductVariantDetailsController::class, 'edit'])->name('product.product-variant-details.edit');
    Route::put('product/product-variant-details-update/{VariantDetailsId}', [ProductVariantDetailsController::class, 'update'])->name('product.product-variant-details.update');
    Route::delete('product/product-variant-details/{VariantDetailsId}/', [ProductVariantDetailsController::class, 'destroy'])->name('product.product-variant-details.destroy');
    Route::put('product/product-variant-details-status/change-status', [ProductVariantDetailsController::class, 'changeStatus'])->name('product.product-variant-details.change-status');
});
