<?php

use App\Http\Controllers\Backend\VendorController;
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
});
