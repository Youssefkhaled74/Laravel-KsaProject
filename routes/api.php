<?php

use App\Http\Controllers\Api\orderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetRequestController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    Route::post('/sendPasswordResetLink',[PasswordResetRequestController::class,'sendEmail']);
    Route::post('resetPassword', [App\Http\Controllers\ChangePasswordController::class,'passwordResetProcess']);
});

Route::post('sendEmail', [App\Http\Controllers\MailController::class,'sendEmail']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('orders',[orderController::class,'index']);
    Route::post('Update-order/{id}',[orderController::class,'update']);
    Route::get('order/{id}',[orderController::class,'show']);
    Route::post('Add-order',[orderController::class,'store']);
    Route::post('Finish-order/{id}',[orderController::class,'finish']);
    
});

// Route::get('orders',[orderController::class,'index']);
// Route::post('Update-order/{id}',[orderController::class,'update']);
// Route::get('order/{id}',[orderController::class,'show']);
// Route::post('Add-order',[orderController::class,'store']);
// Route::post('Finish-order/{id}',[orderController::class,'finish']);


