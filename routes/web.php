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
    Route::resource('mobiles/comments', BackendMobileCommentsController::class)->names('mobiles.comments');
});