<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\CommentController;

use App\Http\Controllers\Front\CountriesController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\MainProfileController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\RoadMapController;
use App\Http\Controllers\Front\SettingController;

use App\Http\Controllers\Front\UserRelationshipController;
use App\Http\Controllers\HomeController;
use App\Models\Post;
use App\Models\UserRelationship;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('admin/home', [\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('admin');

Route::prefix('/')->middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/posts/more', [PostController::class, 'more'])->name('posts.more');

    Route::get('/home/get', [HomeController::class, 'getPosts'])->name('getPosts');


    Route::get('/home/myprofile', [MainController::class, 'myprofile'])->name('home.myprofile');
    Route::get('/home/setting', [MainController::class, 'setting'])->name('home.setting');

    Route::get('/posts/create', [PostController::class, 'index'])->name('posts.create');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/home/post/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/home/post/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/home/post/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/home/post/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/get_states', [HomeController::class, 'getStates']);
    Route::get('/states/{country}', [PostController::class, 'getStates'])->name('states.index');

    Route::get('/home/profile/connections', [UserRelationshipController::class, 'showUsers'])->name('home.connections');
    Route::get('/home/profile', [MainProfileController::class, 'index'])->name('home.profile');
    Route::get('/home/profile/{id}', [MainProfileController::class, 'show'])->name('home.profile-show');
    Route::post('/home/profile/update', [MainProfileController::class, 'update'])->name('home.profile-update');
    Route::get('/home/account/edit/{id}', [ProfileController::class, 'edit'])->name('home.account-edit');
    Route::put('/home/account/update/{id}', [ProfileController::class, 'update'])->name('home.account-update');
    Route::post('/home/account/destroy/{id}', [ProfileController::class, 'destroy'])->name('home.account-destroy');
    Route::get('/home/setting', [SettingController::class, 'index'])->name('home.setting');
    Route::post('/home/setting', [SettingController::class, 'update'])->name('home.setting-update');


    Route::post('/users/{user}/follow', [UserRelationshipController::class, 'store'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [UserRelationshipController::class, 'destroy'])->name('users.unfollow');

    Route::post('/comments',  [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/update',  [CommentController::class, 'update'])->name('comments.update');
    Route::post('/comments/{comment}/delete',  [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('reply',  [CommentController::class, 'store_reply'])->name('reply.store');

    Route::post('/post/reaction', [PostController::class, 'addReaction'])->name('post.reaction');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.all');
    Route::get('/categories/{id}/posts', [CategoryController::class, 'showCategoryPosts'])->name('category.posts');

    Route::get('/cities', [CountriesController::class, 'index'])->name('cities.all');
    Route::get('/cities/{id}/posts', [CountriesController::class, 'showCityPosts'])->name('city.posts');

    Route::get('/cities/{id}/road-map', [RoadMapController::class, 'showCityRoadMaps'])->name('city.roadMap');
    Route::post('/road-map/store', [RoadMapController::class, 'store'])->name('roadmap.store');

    Route::get('/search', [PostController::class, 'search'])->name('search');

    Route::patch('/fcm-token', [HomeController::class, 'updateToken'])->name('fcmToken');
    Route::post('/send-notification', [HomeController::class, 'notification'])->name('notification');



    // Route::post('/like', [PostController::class, 'likeCount']);
    // Route::get('comments/show',  [HomeController::class, 'show_comment'])->name('comments.show');
    // Route::get('/home/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::resource('/home/post', PostController::class);
    // Route::get('/home/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::get('/test', [PostController::class, 'test']);
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/dashboard/usres', [UserController::class, 'index'])->name('admin.dashboardpage1');

    Route::get('/dashboard/posts', [AdminPostController::class, 'index'])->name('admin.posts');
    Route::post('/dashboard/post/{id}/approved', [AdminPostController::class, 'approved'])->name('admin.posts.update');
    Route::post('/dashboard/post/{id}/delete', [AdminPostController::class, 'destroy'])->name('admin.posts.delete');
    Route::post('/dashboard/posts/create', [AdminPostController::class, 'store'])->name('admin.posts.create');
    Route::get('/dashboard/posts/show/{id}', [AdminPostController::class, 'show'])->name('admin.posts.show');
    Route::get('/dashboard/posts/edit/{id}', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::post('/dashboard/posts/update/{id}', [AdminPostController::class, 'update'])->name('admin.posts.update');


    Route::get('/dashboard/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/dashboard/users/create', [UserController::class, 'store'])->name('admin.users.create');
    Route::get('/dashboard/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/dashboard/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/dashboard/users/delete/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/dashboard/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('/dashboard/categories/create', [AdminCategoryController::class, 'store'])->name('admin.categories.create');
    Route::get('/dashboard/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/dashboard/categories/update/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/dashboard/categories/delete/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/dashboard/myprofile', [DashboardController::class, 'myprofile'])->name('admin.myprofile');
    Route::get('/dashboard/setting', [DashboardController::class, 'setting'])->name('admin.setting');
});
