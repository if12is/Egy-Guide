<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Front\CountriesController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\MainProfileController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\SettingController;
use App\Http\Controllers\HomeController;
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

// Route::get('/country', [CountriesController::class, 'getAllCountries']);

Route::prefix('/')->middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/myprofile', [MainController::class, 'myprofile'])->name('home.myprofile');
    Route::get('/home/setting', [MainController::class, 'setting'])->name('home.setting');
    Route::get('/home/post1', [MainController::class, 'post'])->name('home.post');
    Route::post('/home/post/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/home/post/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/home/post/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/home/post/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/get_states', [HomeController::class, 'getStates']);
    Route::get('/get_states', [PostController::class, 'getStates']);
    Route::get('/home/profile/connections', [MainProfileController::class, 'connections'])->name('home.connections');
    Route::get('/home/profile', [MainProfileController::class, 'index'])->name('home.profile');
    Route::get('/home/profile/{id}', [MainProfileController::class, 'show'])->name('home.profile-show');
    Route::post('/home/profile/update', [MainProfileController::class, 'update'])->name('home.profile-update');
    Route::get('/home/account/edit/{id}', [ProfileController::class, 'edit'])->name('home.account-edit');
    Route::put('/home/account/update/{id}', [ProfileController::class, 'update'])->name('home.account-update');
    Route::post('/home/account/destroy/{id}', [ProfileController::class, 'destroy'])->name('home.account-destroy');
    Route::get('/home/setting', [SettingController::class, 'index'])->name('home.setting');
    Route::post('/home/setting', [SettingController::class, 'update'])->name('home.setting-update');
    // Route::get('/home/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::resource('/home/post', PostController::class);
    // Route::get('/home/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::get('/test', [PostController::class, 'test']);
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/page1', [DashboardController::class, 'page1'])->name('admin.dashboardpage1');
    Route::get('/dashboard/myprofile', [DashboardController::class, 'myprofile'])->name('admin.myprofile');
    Route::get('/dashboard/setting', [DashboardController::class, 'setting'])->name('admin.setting');
});
