<?php

use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/forget-password', [PasswordResetController::class, 'forgetPassword']);
Route::get('/forget-password', function () {
    return view('auth.forger-password');
})->name('auth.forgerPass');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

Route::group(['middleware' => 'api'], function ($routes) {
    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/logout', [UserAuthController::class, 'logout']);
    Route::get('/profile', [UserAuthController::class, 'profile'])->name("profile");
    Route::get('/email/verify', function () {
        return view('auth.emailVerify');
    });

    Route::get('/send-verify-mail/{email}', [VerificationController::class, 'sentVerifyMail']);

    Route::post('/items', [ItemController::class, 'create']);
    Route::get('/items', [ItemController::class, 'index']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'delete']);
});


Route::middleware('admin')->group(function () {
    Route::prefix('admin/items')->group(function () {
        Route::get('/unapproved', [AdminItemController::class, 'unapprovedItems']);
    });
});
