<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('auth')->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('login', [AuthController::class, 'post'])->name('auth.login');

        Route::get('register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('register', [AuthController::class, 'store'])->name('auth.register');
    });
});



Route::middleware(['auth', 'checkUserDetail'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::prefix('users')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('users.index')->middleware('checkRole:SAD');
        Route::get('profile/{id}', [UserController::class, 'profile'])->name('users.profile');
        Route::put('profile/{id}', [UserController::class, 'update'])->name('users.profile');
    });

 

Route::prefix('mobil')->middleware('checkRole:ADM')->group(function () { 
        Route::get('index', [MobilController::class, 'index'])->name('mobil.index');
        Route::get('create', [MobilController::class, 'create'])->name('mobil.create');
        Route::post('create', [MobilController::class, 'store'])->name('mobil.create');
        Route::get('edit/{id}', [MobilController::class, 'edit'])->name('mobil.edit');
        Route::put('edit/{id}', [MobilController::class, 'update'])->name('mobil.update');
        Route::delete('delete/{id}', [MobilController::class, 'destroy'])->name('mobil.delete');
    });
});