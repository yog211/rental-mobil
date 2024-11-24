<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\AuthController;// Tambahkan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('auth')->group (function () {
Route::middleware (['auth'])->group (function () {
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware (['guest'])->group (function () {
Route::get( uri: 'login', action: [AuthController::class, 'login'])->name('auth.login');
 Route::post('login', [AuthController::class, 'post'])->name('auth.login'); 
 Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');

    /* user
    */
    Route::prefix('users')->group(function() {
    Route::get('index', [UserController::class, 'index'])->name ('users.index');
    });
    /*end
    */
});   