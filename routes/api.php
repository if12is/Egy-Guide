<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    // User
    Route::get('/user', [UserController::class, 'user']); //show user details
    Route::put('/user', [UserController::class, 'update']); //update user email and name, Upload image
    Route::delete('/delete-account', [UserController::class, 'delete']); //delete account of user
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword']); // change password of user
    Route::post('/logout', [AuthController::class, 'logout']); //logout from site

    // Posts
    Route::get('/posts', [PostController::class, 'index']); //show the posts
    Route::get('/posts/{id}', [PostController::class, 'show']); //show single post
    Route::post('/posts', [PostController::class, 'store']); //create the post
    Route::put('posts/{id}', [PostController::class, 'update']); //Update the post
    Route::delete('posts/{id}', [PostController::class, 'destroy']); //Update the post


});
