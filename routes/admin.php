<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\childCategoryController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');
    //profile routes---------------------------------------------------------
    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [AdminProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update/password', [AdminProfileController::class, 'passwordUpdate'])->name('password.update');
    //slider routes-----------------------------------------------------------
    Route::resource('slider', SliderController::class);
    //category routes---------------------------------------------------------
    Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('category', CategoryController::class);
    //sub category routes---------------------------------------------------------
    Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
    Route::resource('sub-category', SubCategoryController::class);
    //child category routes---------------------------------------------------------
    Route::get('get-sub-categories', [ChildCategoryController::class, 'getSubCategories'])->name('get-sub-categories');
    Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::resource('child-category', ChildCategoryController::class);
});
