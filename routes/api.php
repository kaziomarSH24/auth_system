<?php

use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VerificationController;
use App\Models\User;
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


// Route::get('/index',[ItemController::class,'showApprovePost'])->name('item.indexPage');

Route::post('/forget-password', [PasswordResetController::class, 'forgetPassword']);
Route::get('/forget-password', function () {
    return view('auth.forger-password');
})->name('auth.forgerPass');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);





Route::group(['middleware' => 'api', 'jwt.auth'], function ($routes) {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserAuthController::class, 'profile'])->name("profile");
    Route::get('/email/verify', function () {
        return view('auth.emailVerify');
    });

    Route::get('/send-verify-mail/{email}', [VerificationController::class, 'sentVerifyMail']);

    Route::post('/items', [ItemController::class, 'create']);
    Route::get('/items/data', [ItemController::class, 'showAll']);
    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{id}', [ItemController::class, 'singleItem']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'delete']);


    //Conversation
    Route::get('/conversation', [ConversationController::class, 'getContact']);
    Route::get('/conversation/{id}', [ConversationController::class, 'getMessages']);
    Route::post('/send-message', [ConversationController::class, 'sendMessage']);
    //mark as read
    Route::put('/conversation/{id}', [ConversationController::class, 'markAsRead']);
});



//admin control
Route::middleware(['jwt.auth', 'admin'])->group(function () {
    // Route::get('/admin/all-users', [AdminItemController::class, 'showUsers'])->name('all.users');
    Route::put('/admin/users/{id}/role', [AdminItemController::class, 'updateRole']);
    Route::prefix('admin/items')->group(function () {
        Route::get('/', [AdminItemController::class, 'getPosts']);
        Route::put('/{id}/status', [AdminItemController::class, 'updateItemStatus']);
        Route::delete('/{id}', [AdminItemController::class, 'deleteItem']);
        Route::get('/unapproved', [AdminItemController::class, 'unapprovedItems']);
    });

});



//for testing

// Route::middleware(['jwt'])->group(function () {
//     Route::get('/userrr', function (Request $request) {
//         return response()->json($request->user());
//     });
// });

//socket user status update api
Route::post('/update-status', function (Request $request) {
    $user = User::find($request->userId);
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ], 404);
    }
    $user->is_active = $request->is_active;
    $user->save();
    return response()->json([
        'success' => true,
        'message' => 'User status updated successfully.'
    ]);
});
