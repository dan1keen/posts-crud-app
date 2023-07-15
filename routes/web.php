<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('app');
});

Route::group(['middleware' => 'guest'], function () {
    Route::prefix('register')->group(function () {
        Route::get('/',  [\App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register.show');
        Route::post('/', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register');
    });

    Route::prefix('login')->group(function () {
        Route::get('/',  [\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login.show');
        Route::post('/', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'posts', 'name' => 'posts.'], function () {
        Route::get('/',        [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
        Route::get('/create',  [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
        Route::post('/',       [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
        Route::get('/{id}',    [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}',    [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
        Route::delete('/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');
    });
});
