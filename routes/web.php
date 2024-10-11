<?php

use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',[ItemController::class,'showApprovePost'])->name('item.indexPage');

Route::prefix('/user')->group(function () {
    Route::get('/dashboard', function () {
        return view('profile');
    })->name("user.dashboard");
    Route::get('/post-items', function () {
        return view('layouts.user-post-item');
    })->name("user.post.item");
});



Route::get('/verify-email/{token}', [VerificationController::class, 'verifyEmail']);

Route::get('/reset-password', [PasswordResetController::class, 'resetPassLoad']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);





Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminItemController::class, 'index'])->name("admin.dashboard");
    Route::get('/all-users', function () {
        return view('admin.all-users');
    })->name('all.users');
    Route::get('/post-items', function () {
        return view('admin.post-items');
    })->name('post.items');
});
