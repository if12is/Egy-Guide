<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MainProfileController;
use App\Http\Controllers\Api\RoadMapController;
use App\Http\Controllers\Api\SearchController;
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


Route::group(['middleware' => ['auth:sanctum', 'checkPassword']], function () {

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

    // comments
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/comments/replies', [CommentController::class, 'store_reply']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // showCategoryPosts
    Route::get('/categories/{id}', [CategoryController::class, 'showCategoryPosts']); //show all post of category
    Route::get('/categories', [CategoryController::class, 'showCategories']); //show categories post

    // Follow sys
    Route::get('/users_can_follow', [FollowController::class, 'showUsers']); //show users not following by auth
    Route::post('/users/{user}/follow', [FollowController::class, 'store']); //follow
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'destroy']); //unfollow

    // Reactions
    Route::post('/users/{id}/getReactions', [LikeController::class, 'getReactions']); //react
    Route::post('/users/{id}/addReact', [LikeController::class, 'addReaction']); //react
    Route::delete('/users/{id}/removeReact', [LikeController::class, 'removeReaction']); //remove react


    // RoadMap
    Route::post('roadways/city/{cityId}', [RoadMapController::class, 'showCityRoadMaps']);

    // search
    Route::post('posts/search/{search}', [SearchController::class, 'search']);

    // MainProfile
    Route::post('users/profile/{id}', [MainProfileController::class, 'show']);
    Route::put('users/profile/updateBio', [MainProfileController::class, 'update']);
});
