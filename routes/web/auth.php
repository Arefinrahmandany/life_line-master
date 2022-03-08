<?php

use App\Http\Controllers\Auth\AccountVerificationController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware(['disablePreventBack','htmlMinifier'])->group(static function () {
// Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showPage'])->name('password.showPage');
    Route::post('/password/code', [ForgotPasswordController::class, 'send'])->name('password.code');
    Route::get('/password/reset/code/{phone}', [ForgotPasswordController::class, 'reset'])->name('password.reset.code');
    Route::post('/password/reset/code/confirm', [ForgotPasswordController::class, 'confirmAdmin'])->name('password.reset.code.confirm');
// Auth
    Auth::routes(['login' => true, 'register' => false, 'reset' => false, 'verify' => false]);
// Redirect to login
    Route::get('/connect-to-login-server',[LoginController::class,'redirectToLogin'])->name('auth.redirectToLogin');
    Route::post('/connect-to/login-server',[LoginController::class,'redirectToLoginChecking'])->name('auth.connectToLogin');
    Route::get('/',[LoginController::class,'redirectToLogin'])->name('auth.redirectToLogin');
// Admin Login
    Route::get('/admin-server/{loginUrl}', [LoginController::class,'loginFormShow'])->name('auth.admin.showForm');
    Route::post('/admin-logout', [LoginController::class,'logout'])->name('auth.admin.logout');
    Route::post('/admin-server/login/check-points', [LoginController::class,'credentials'])->name('admin.login.checking');
    Route::post('/admin-server/login/2fa-check-points', [LoginController::class,'credentials2FA']);
    Route::post('/admin-server/resend/2fa-code', [LoginController::class,'resend2FAuth']);
    Route::post('/account-verify',[AccountVerificationController::class,'verify'])->name('account.verify');

    Route::middleware(['auth','phoneVerified','activeAccount'])->group(static function () {
        // auth account
        Route::prefix('/auth-account')->group(static function(){
            Route::get('/', [AuthAccountController::class,'index'])->name('auth.account');
            Route::get('/2fa-pwd/checking/{pwd}', [AuthAccountController::class,'tFAPwdChecking']);
            Route::post('/2fa-pwd/active-deactivate', [AuthAccountController::class,'activeDeactivate']);
        });
    });

});
