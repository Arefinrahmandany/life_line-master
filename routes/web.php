<?php


use App\Http\Controllers\AuthAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


Route::middleware(['disablePreventBack','htmlMinifier'])->group(static function () {
    // Frontend
//Route::get('/', [FrontendController::class,'index'])->name('home');
//Route::get('/about', [FrontendController::class,'about'])->name('pages.about');
//Route::get('/contact', [FrontendController::class,'contact'])->name('pages.contact');
    Route::get('/error404',[FrontendController::class,'error404'])->name('error404');
// end Frontend

Route::middleware(['auth','phoneVerified','activeAccount'])->group(static function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // auth account
    Route::prefix('/auth-account')->group(static function(){
        Route::get('/', [AuthAccountController::class,'index'])->name('auth.account');
        Route::get('/2fa-pwd/checking/{pwd}', [AuthAccountController::class,'tFAPwdChecking']);
        Route::post('/2fa-pwd/active-deactivate', [AuthAccountController::class,'activeDeactivate']);
    });




});
// End Authentication Routes

});
// Any Route for Error Handling
Route::any('{any}',[FrontendController::class,'error404']);
