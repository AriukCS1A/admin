<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FilterrController;
use App\Http\Controllers\BabyController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\AccountController;

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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Voyager::routes();
});

// Нэвтрэх
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Гарах
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/admin/upload-banner-image', [BannerController::class, 'uploadBannerImage'])->name('upload.banner.image');

Route::post('/admin/upload-product-image', [ProductsController::class, 'uploadProductsImage'])->name('upload.product.image');

Route::post('/admin/upload-task-image', [TaskController::class, 'uploadTaskImage'])->name('upload.task.image');
Route::post('/admin/upload-filter-info', [FilterrController::class, 'uploadFilterInfo'])->name('upload.filter.info');
Route::post('/admin/upload-reward-image', [RewardController::class, 'uploadRewardImage'])->name('upload.reward.image');

Route::post('/admin/upload-baby-info', [BabyController::class, 'uploadBabyInfo'])->name('upload.baby.info');
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/accounts/{userId}', [AccountController::class, 'show'])->name('accounts.show');

Route::get('/points', [PointsController::class, 'index'])->name('points.index');
Route::get('/points/{id}', [PointsController::class, 'show'])->name('points.show');

Route::get('/user/{userId}/points', [PointsController::class, 'userPoints'])->name('user.points');
Route::get('/user/{userId}/account', [AccountController::class, 'userAccount'])->name('user.account');







