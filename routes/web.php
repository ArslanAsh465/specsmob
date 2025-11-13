<?php

use Illuminate\Support\Facades\Route;

// Frontend Controller
use App\Http\Controllers\Frontend\HomeController;

// Auth Controllers
use App\Http\Controllers\AuthController;

// Backend Controllers
use App\Http\Controllers\Backend\BackendDashboardController;
use App\Http\Controllers\Backend\BackendAdminsController;
use App\Http\Controllers\Backend\BackendManagersController;
use App\Http\Controllers\Backend\BackendUsersController;
use App\Http\Controllers\Backend\BackendBrandsController;
use App\Http\Controllers\Backend\BackendMobilesController;
use App\Http\Controllers\Backend\BackendMobileCommentsController;
use App\Http\Controllers\Backend\BackendNewsController;
use App\Http\Controllers\Backend\BackendNewsCommentsController;
use App\Http\Controllers\Backend\BackendReviewsController;
use App\Http\Controllers\Backend\BackendReviewCommentsController;

// CKEditor Controller
use App\Http\Controllers\CKEditorController;

// Frontend Routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/{slug}', [HomeController::class, 'newsShow'])->name('news.show');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/review/{slug}', [HomeController::class, 'reviewShow'])->name('review.show');
Route::get('/videos', [HomeController::class, 'videos'])->name('videos');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/brands', [HomeController::class, 'brands'])->name('brands');
Route::get('/brand/{slug}', [HomeController::class, 'brandShow'])->name('brand.show');

Route::get('/mobile/{slug}', [HomeController::class, 'mobileShow'])->name('mobile.show');

Route::get('/search', [HomeController::class, 'index'])->name('search');
Route::get('/ajax-search', [HomeController::class, 'ajaxSearch'])->name('ajax.search');

Route::get('/phone-finder', [HomeController::class, 'phoneFinder'])->name('phone.finder');
Route::post('/phone-finder-results', [HomeController::class, 'phoneFinderResults'])->name('phone.finder.results');

Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
Route::post('/ajax-comment', [HomeController::class, 'ajaxComment'])->name('ajax.comment');

// Auth Routes
Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Backend Routes
Route::middleware(['auth'])->prefix('backend')->name('backend.')->group(function () {
    //Dashboard
    Route::get('dashboard', [BackendDashboardController::class, 'dashboard'])->name('dashboard');

    // Admins
    Route::resource('admins', BackendAdminsController::class)->names('admins');

    // Managers
    Route::resource('managers', BackendManagersController::class)->names('managers');

    // Users
    Route::resource('users', BackendUsersController::class)->names('users');

    // Brands
    Route::resource('brands', BackendBrandsController::class)->names('brands');

    // Mobiles
    Route::resource('mobiles', BackendMobilesController::class)->names('mobiles');

    // Mobile Comments
    Route::resource('mobile-comments', BackendMobileCommentsController::class)->names('mobile_comments')->only(['index', 'show', 'destroy']);

    // News
    Route::resource('news', BackendNewsController::class)->names('news');

    // News Comments
    Route::resource('news-comments', BackendNewsCommentsController::class)->names('news_comments')->only(['index', 'show', 'destroy']);

    // Reviews
    Route::resource('reviews', BackendReviewsController::class)->names('reviews');

    // Review Comments
    Route::resource('review-comments', BackendReviewCommentsController::class)->names('review_comments')->only(['index', 'show', 'destroy']);
});

// CKEditor Image upload route
Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
