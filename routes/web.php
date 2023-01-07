<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    dd(123);
});

Route::get('/', [SlotController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', [UserController::class, 'show'])->name('user');
    Route::post('/user', [UserController::class, 'update'])->name('user.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('slot', SlotController::class);


    Route::get('slottest', [SlotController::class, 'listForUser'])->name('slottest');
});

Route::group(['middleware' => ['guest']], function() {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('verify-login/{token}', [AuthController::class, 'verifyLogin'])->name('verify-login');
});
