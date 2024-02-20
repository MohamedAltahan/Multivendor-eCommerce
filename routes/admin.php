<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminVendorProfileContorller;
use App\Http\Controllers\Backend\AllVendorsProductsController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\childCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterController;
use App\Http\Controllers\Backend\FooterGridTwoLinkController;
use App\Http\Controllers\Backend\FooterGridThreeLinkController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingContrller;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantDetailsController;
use App\Http\Controllers\Backend\ProductVariantTypesController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRule;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TransactionController;
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
    //product get attribute values ajaxz
    Route::get('product/get-attribute-values', [ProductVariantTypesController::class, 'getProductAttributesValues'])->name('product.get-attribute-values');
    //product get attributes types ajax
    Route::get('product/get-attributes', [ProductVariantTypesController::class, 'getProductAttributes'])->name('product.get-attributes');
    //product variant types
    Route::resource('product-variant-types', ProductVariantTypesController::class);

    //product variant==============================================================================================
    Route::put('product-variant-status/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
    Route::resource('product-variant', ProductVariantController::class);

    //product variant details==============================================================================================
    Route::get('product/product-variant-details/{productId}/{variantId}', [ProductVariantDetailsController::class, 'index'])->name('product.product-variant-details');
    Route::get('product/product-variant-details/create/{productId}/{variantId}', [ProductVariantDetailsController::class, 'create'])->name('product.product-variant-details.create');
    Route::post('product/product-variant-details', [ProductVariantDetailsController::class, 'store'])->name('product.product-variant-details.store');
    Route::get('product/product-variant-details-edit/{VariantDetailsId}', [ProductVariantDetailsController::class, 'edit'])->name('product.product-variant-details.edit');
    Route::put('product/product-variant-details-update/{VariantDetailsId}', [ProductVariantDetailsController::class, 'update'])->name('product.product-variant-details.update');
    Route::delete('product/product-variant-details/{VariantDetailsId}/', [ProductVariantDetailsController::class, 'destroy'])->name('product.product-variant-details.destroy');
    Route::put('product/product-variant-details-status/change-status', [ProductVariantDetailsController::class, 'changeStatus'])->name('product.product-variant-details.change-status');

    //all vendors products=================================================================================================
    Route::get('product/all-vendors', [AllVendorsProductsController::class, 'index'])->name('all-vendors-products.index');
    Route::get('vendor-products/{vendorId}', [AllVendorsProductsController::class, 'getVendorProducts'])->name('get-vendor-products');
    Route::get('pending-products', [AllVendorsProductsController::class, 'pendingProducts'])->name('pending-products.index');
    Route::put('change-approval-status', [AllVendorsProductsController::class, 'changeApprovalStatus'])->name('change-approval-status');

    //flash sale===========================================================================================================
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
    Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
    Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
    Route::put('flash-sale/show_at_home_status', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.show-at-home-status');
    Route::put('flash-sale/status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale.change-status');
    Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');

    //settigs========================================================================================================
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('general-settnig-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update.index');
    //stmp email setting--------------------------------
    Route::put('stmp-setting-update', [SettingController::class, 'stmpSettingUpdate'])->name('stmp-setting-update');


    //Coupons========================================================================================================
    Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
    Route::resource('coupons', CouponController::class);

    //shipping========================================================================================================
    Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
    Route::resource('shipping-rule', ShippingRuleController::class);

    // Payment setting=============================================================================================
    Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting.index');
    Route::resource('paypal-setting', PaypalSettingContrller::class);
    //Stripe ---------------------------------------------
    Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');

    //Order=========================================================================================================
    Route::resource('order', OrderController::class);
    Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
    Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');

    //order transaction=========================================================================================================
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');

    //Home page setting=========================================================================================================
    Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting');
    Route::put('popular-category-section', [HomePageSettingController::class, 'updatePopularCategorySection'])->name('popular-category-section');
    Route::put('products-slider-one', [HomePageSettingController::class, 'updateProductsSliderOne'])->name('products-slider-one');
    Route::put('products-slider-two', [HomePageSettingController::class, 'updateProductsSlidertwo'])->name('products-slider-two');
    Route::put('products-slider-tree', [HomePageSettingController::class, 'updateProductsSliderThree'])->name('products-slider-three');

    //footer============================================================================================
    //footer contact info
    Route::resource('footer', FooterController::class);
    //footer social buttons---------------------------
    Route::put('change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');
    Route::resource('footer-socials', FooterSocialController::class);
    //footer section2---------------------------------
    Route::put('change-status', [FooterGridTwoLinkController::class, 'changeStatus'])->name('footer-grid-two.change-status');
    Route::put('change-title', [FooterGridTwoLinkController::class, 'changeTitle'])->name('footer-grid-two.change-title');
    Route::resource('footer-grid-two', FooterGridTwoLinkController::class);
    //footer section3---------------------------------
    Route::put('section-three-change-status', [FooterGridThreeLinkController::class, 'changeStatus'])->name('footer-grid-three.change-status');
    Route::put('section-three-change-title', [FooterGridThreeLinkController::class, 'changeTitle'])->name('footer-grid-three.change-title');
    Route::resource('footer-grid-three', FooterGridThreeLinkController::class);
});
