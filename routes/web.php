<?php

use Illuminate\Support\Facades\Route;

// CKEditor Controller
use App\Http\Controllers\CKEditorController;

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

// CKEditor Image upload route
Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

// Frontend Routes
Route::get('/', [HomeController::class, 'home'])->name('home');

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