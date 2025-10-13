<?php

use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Front\UserController as FrontUserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\NewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PostController as FrontPostController;
use App\Http\Controllers\ImageController;
use App\Http\Middleware\Filter;
use App\Http\Middleware\IsAdmin;


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

Route::get('dang-nhap', [HomeController::class, 'login'])->name('user.login')->middleware('guest');
Route::get('dang-ky', [HomeController::class, 'register'])->name('user.register')->middleware('guest');
Route::get('quen-mat-khau', [HomeController::class, 'forgotPassword'])->name('user.forgotPassword');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('gioi-thieu', [HomeController::class, 'about'])->name('about');
Route::get('tin-tuc', [HomeController::class, 'news'])->name('news');
Route::get('tin-tuc/{post:slug}', [HomeController::class, 'newsDetail'])->name('news_detail');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('resources', [HomeController::class, 'resources'])->name('resources');
Route::get('kols', [HomeController::class, 'kols'])->name('kols');
Route::get('help', [HomeController::class, 'help'])->name('help');
Route::post('newsletters', [NewsletterController::class, 'store'])->name('newsletters');

Route::middleware(['auth', 'verified'])->group(function () {
	Route::view('/user/profile', 'profile.show')->name('profile.show');
	
	Route::get('user/dashboard', [FrontUserController::class, 'dashboard'])->name('user.dashboard');
	Route::get('user/kol-explorer', [FrontUserController::class, 'kolExplorer'])->name('user.kolExplorer');
	Route::get('user/campaign', [FrontUserController::class, 'campaign'])->name('user.campaign.index');
	Route::get('user/campaign-detail/{slug}', [FrontUserController::class, 'campaignDetail'])->name('user.campaign.detail');
	Route::get('user/campaign-tracker/{slug}', [FrontUserController::class, 'campaignTracker'])->name('user.campaign.tracker');
	Route::get('user/analytic', [FrontUserController::class, 'analytic'])->name('user.analytic');
	Route::get('user/report', [FrontUserController::class, 'report'])->name('user.report');
	Route::get('user/setting', [FrontUserController::class, 'setting'])->name('user.setting');
	Route::get('user/billing', [FrontUserController::class, 'billing'])->name('user.billing');
	Route::get('user/kol-profile', [FrontUserController::class, 'kolProfile'])->name('user.kolProfile');
	Route::get('user/leaderboard', [FrontUserController::class, 'leaderboard'])->name('user.leaderboard');
});
Route::prefix('backend')
	->middleware(['auth', 'verified', IsAdmin::class])
	->group(function () {
		Route::get('/dashboard', [BackendHomeController::class, 'index'])->name('dashboard');

		Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
		Route::resource('posts', PostController::class);

		Route::resource('tags', TagController::class);
		Route::resource('categories', CategoryController::class);
		Route::resource('pages', PageController::class);

		Route::resource('users', UserController::class);
		Route::resource('roles', RoleController::class);

		Route::get('/notifications/search', [NotificationController::class, 'search'])->name('notifications.search');
		Route::resource('notifications', NotificationController::class);

		Route::get('setting/home', [SettingController::class, 'home'])->name('setting.home');
		Route::post('setting/home', [SettingController::class, 'saveHome'])->name('setting.home.save');

		Route::get('newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
		Route::delete('newsletters/destroy/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');

		Route::mediaLibrary();
	});

Route::get('glide/{path}', ImageController::class)->where('path', '.+');
