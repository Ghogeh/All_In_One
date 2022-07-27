<?php

use App\Http\Controllers\auth\EmailVerificationController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


// authentication
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



//===============forget password=============//

Route::get('/request_password', [ResetPasswordController::class, 'index'])->name('password.request');

Route::post('/request_password', [ResetPasswordController::class, 'sendEmail']);

//===========after return from email==========
Route::get('/reset_password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');

Route::post('/reset_password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');


//=============email verification=============//
Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//============products====/////////
Route::resource('/products', ProductsController::class);


//=================users==========//
Route::resource('/users', UsersController::class);



// ==================import and export excel file===================//
Route::post('/import', [UsersController::class, 'importExcel'])->name('import');
Route::get('/export', [UsersController::class, 'exportExcel'])->name('export');
