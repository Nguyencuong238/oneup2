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
use App\Http\Controllers\Front\Dashboard\BranchController;
use App\Http\Controllers\Front\Dashboard\CreatorController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\NewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsBranch;
use App\Http\Middleware\IsKols;


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
Route::get('register', [HomeController::class, 'register'])->name('register')->middleware('guest');
Route::get('forgot-password', [HomeController::class, 'forgotPassword'])->name('forgotPassword');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('tin-tuc', [HomeController::class, 'news'])->name('news');
Route::get('tin-tuc/{post:slug}', [HomeController::class, 'newsDetail'])->name('news_detail');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('resources', [HomeController::class, 'resources'])->name('resources');
Route::get('kols', [HomeController::class, 'kols'])->name('kols');
Route::get('help', [HomeController::class, 'help'])->name('help');
Route::post('newsletters', [NewsletterController::class, 'store'])->name('newsletters');

Route::prefix('branch/')->middleware(['auth', 'verified', IsBranch::class])->group(function () {
	Route::view('profile', 'profile.show')->name('profile.show');

	Route::get('dashboard', [BranchController::class, 'dashboard'])->name('branch.dashboard');
	Route::get('kol-explorer', [BranchController::class, 'kolExplorer'])->name('branch.kolExplorer');
	Route::get('campaign', [BranchController::class, 'campaign'])->name('branch.campaign.index');
	Route::get('campaign-planner/{slug?}', [BranchController::class, 'campaignPlanner'])->name('branch.campaign.planner');
	Route::get('campaign-detail/{slug}', [BranchController::class, 'campaignDetail'])->name('branch.campaign.detail');
	Route::get('campaign-tracker/{slug}', [BranchController::class, 'campaignTracker'])->name('branch.campaign.tracker');
	Route::post('campaign-store', [BranchController::class, 'campaignStore'])->name('branch.campaign.store');
	Route::get('analytic', [BranchController::class, 'analytic'])->name('branch.analytic');
	Route::get('report', [BranchController::class, 'report'])->name('branch.report');
	Route::get('setting', [BranchController::class, 'setting'])->name('branch.setting');
	Route::get('billing', [BranchController::class, 'billing'])->name('branch.billing');
	Route::get('kol-profile/{id}', [BranchController::class, 'kolProfile'])->name('branch.kolProfile');
	Route::get('leaderboard', [BranchController::class, 'leaderboard'])->name('branch.leaderboard');
	Route::post('campaign-status', [BranchController::class, 'changeStatus'])->name('branch.campaign.changeStatus');
});

Route::prefix('creator/')->middleware(['auth', 'verified', IsKols::class])->group(function () {
	Route::view('profile', 'profile.show')->name('profile.show');

	Route::get('dashboard', [CreatorController::class, 'dashboard'])->name('creator.dashboard');
	Route::get('kol-explorer', [CreatorController::class, 'kolExplorer'])->name('creator.kolExplorer');
	Route::get('campaign', [CreatorController::class, 'campaign'])->name('creator.campaign.index');
	Route::get('campaign-planner/{slug?}', [CreatorController::class, 'campaignPlanner'])->name('creator.campaign.planner');
	Route::get('campaign-detail/{slug}', [CreatorController::class, 'campaignDetail'])->name('creator.campaign.detail');
	Route::get('campaign-tracker/{slug}', [CreatorController::class, 'campaignTracker'])->name('creator.campaign.tracker');
	Route::post('campaign-store', [CreatorController::class, 'campaignStore'])->name('creator.campaign.store');
	Route::get('analytic', [CreatorController::class, 'analytic'])->name('creator.analytic');
	Route::get('report', [CreatorController::class, 'report'])->name('creator.report');
	Route::get('setting', [CreatorController::class, 'setting'])->name('creator.setting');
	Route::get('billing', [CreatorController::class, 'billing'])->name('creator.billing');
	Route::get('kol-profile/{id}', [CreatorController::class, 'kolProfile'])->name('creator.kolProfile');
	Route::get('leaderboard', [CreatorController::class, 'leaderboard'])->name('creator.leaderboard');
	Route::post('campaign-status', [CreatorController::class, 'changeStatus'])->name('creator.campaign.changeStatus');
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

