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
use App\Http\Controllers\GiftController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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

// Banner устгах (шинэ маршрут нэмсэн)
Route::delete('/admin/delete-banner/{id}', [BannerController::class, 'deleteBanner'])->name('delete.banner');

Route::post('/admin/upload-product-image', [ProductsController::class, 'uploadProductsImage'])->name('upload.product.image');

Route::post('/admin/upload-task-image', [TaskController::class, 'uploadTaskImage'])->name('upload.task.image');
Route::post('/admin/upload-filter-info', [FilterrController::class, 'uploadFilterInfo'])->name('upload.filter.info');
Route::post('/admin/upload-reward-image', [RewardController::class, 'uploadRewardImage'])->name('upload.reward.image');
Route::post('/admin/upload-advice-image', [AdviceController::class, 'uploadAdviceImage'])->name('upload.advice.image');
Route::post('/admin/upload-momchange-image', [MomchangeController::class, 'uploadMomchangeImage'])->name('upload.momchange.image');
Route::post('/admin/upload-babydev-image', [BabydevController::class, 'uploadBabydevImage'])->name('upload.babydev.image');
Route::post('/admin/upload-detail-image', [DetailController::class, 'uploadDetailImage'])->name('upload.detail.image');


Route::get('/gift', [GiftController::class, 'getGiftData']);
Route::post('/gift/update', [GiftController::class, 'updateGiftData']);

Route::get('/baby', [BabyController::class, 'getBabyData']);
Route::post('/baby/update', [BabyController::class, 'updateBabyData']);

Route::resource('account', AccountController::class);
Route::resource('points', PointsController::class);

Route::resource('brand', BrandController::class);
Route::resource('branches', BranchesController::class);

Route::resource('invite', InviteController::class);
Route::resource('level', LevelController::class);
Route::resource('review', ReviewController::class);
Route::resource('progress', ProgressController::class);