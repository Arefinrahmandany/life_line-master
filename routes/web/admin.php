<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\MerchantManageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserManageController;
use Illuminate\Support\Facades\Route;

Route::domain('admin.')->group(static function(){

});

Route::middleware(['disablePreventBack','htmlMinifier','auth','phoneVerified','activeAccount'])->prefix('admin')->group(static function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
    // Merchant Manage
    // Users Manage
    Route::get('/users',[UserManageController::class,'index'])->name('admin.users');
    Route::get('/users/{id}', [UserManageController::class,'show'])->name('admin.users.profile.show');
    Route::put('/users/{id}',[UserController::class,'update'])->name('admin.user.update');
    // Tag
});
