<?php

use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\KolController;
use App\Http\Controllers\Backend\OrganizationController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Front\Dashboard\BrandController;
use App\Http\Controllers\Front\Dashboard\CreatorController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\NewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsBrand;
use App\Http\Middleware\IsKols;
use App\Http\Controllers\Auth\LoginController;


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

Route::get('login', [HomeController::class, 'login'])->name('login')->middleware('guest');
// Social login (Google, Facebook)
Route::get('auth/{provider}', [LoginController::class, 'redirectToProvider'])
	->name('login.provider')
	->where('provider', 'google|facebook');

Route::get('auth/{provider}/callback', [LoginController::class, 'handleProviderCallback'])
	->where('provider', 'google|facebook');
Route::get('register', [HomeController::class, 'register'])->name('register')->middleware('guest');
Route::get('forgot-password', [HomeController::class, 'forgotPassword'])->name('forgotPassword');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('resources', [HomeController::class, 'resources'])->name('resources');
Route::get('/resources/{slug}', [HomeController::class, 'show'])->name('resources.show');
Route::get('kols', [HomeController::class, 'kols'])->name('kols');
Route::get('help', [HomeController::class, 'help'])->name('help');
Route::post('newsletters', [NewsletterController::class, 'store'])->name('newsletters');

Route::view('profile', 'profile.show')->name('profile.show')->middleware('auth');

Route::prefix('brand/')->middleware(['auth', 'verified', IsBrand::class])->group(function () {

	Route::get('dashboard', [BrandController::class, 'dashboard'])->name('brand.dashboard');
	Route::get('kol-explorer', [BrandController::class, 'kolExplorer'])->name('brand.kolExplorer');
	Route::get('campaign', [BrandController::class, 'campaign'])->name('brand.campaign.index');
	Route::get('campaign-planner/{slug?}', [BrandController::class, 'campaignPlanner'])->name('brand.campaign.planner');
	Route::get('campaign-detail/{slug}', [BrandController::class, 'campaignDetail'])->name('brand.campaign.detail');
	Route::get('campaign-tracker/{slug}', [BrandController::class, 'campaignTracker'])->name('brand.campaign.tracker');
	Route::post('campaign-store', [BrandController::class, 'campaignStore'])->name('brand.campaign.store');
	Route::get('analytic', [BrandController::class, 'analytic'])->name('brand.analytic');
	Route::get('report', [BrandController::class, 'report'])->name('brand.report');
	Route::get('setting', [BrandController::class, 'setting'])->name('brand.setting');
	Route::post('setting-update', [BrandController::class, 'saveSettings'])->name('brand.setting.update');
	Route::get('billing', [BrandController::class, 'billing'])->name('brand.billing');
	Route::get('profile/{username}', [BrandController::class, 'profile'])->name('brand.profile');
	Route::get('leaderboard', [BrandController::class, 'leaderboard'])->name('brand.leaderboard');
	Route::post('campaign-status', [BrandController::class, 'changeStatus'])->name('brand.campaign.changeStatus');
});

Route::prefix('creator/')->middleware(['auth', 'verified', IsKols::class])->group(function () {

	Route::get('dashboard', [CreatorController::class, 'dashboard'])->name('creator.dashboard');
	Route::get('campaign', [CreatorController::class, 'campaign'])->name('creator.campaign.index');
	Route::get('campaign-detail/{slug}', [CreatorController::class, 'campaignDetail'])->name('creator.campaign.detail');
	Route::post('campaign-join', [CreatorController::class, 'joinCampaign'])->name('creator.campaign.join');
	Route::get('setting', [CreatorController::class, 'setting'])->name('creator.setting');
	Route::post('setting-update', [BrandController::class, 'saveSettings'])->name('creator.setting.update');
	Route::get('profile/{username}', [CreatorController::class, 'profile'])->name('creator.profile');
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

		Route::resource('kols', KolController::class);
		Route::resource('organizations', OrganizationController::class);
		Route::resource('campaigns', CampaignController::class);

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

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'vi'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return back();
})->name('lang.switch');

