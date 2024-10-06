<?php

use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\ItemController;
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
    Route::get('/email/verify',function(){
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
        Route::put('/{id}/approve', [AdminItemController::class, 'approveItem']);
        Route::put('/{id}/reject', [AdminItemController::class, 'rejectItem']);
        Route::delete('/{id}', [AdminItemController::class, 'destroy']);
    });
});


// Route::get('/send-test-email', function () {
//     Mail::raw('This is a test email using Gmail SMTP server.', function ($message) {
//         $message->to('softeng.kaziomar@gmail.com')  
//                 ->subject('Test Email from Laravel');
//     });

//     return 'Email sent successfully';
// });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
