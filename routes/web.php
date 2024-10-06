<?php

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/profile/data', function () {
    return view('profile');
})->name("profile.data");


Route::get('/verify-email/{token}', [VerificationController::class, 'verifyEmail'])->withoutMiddleware(['auth']);
