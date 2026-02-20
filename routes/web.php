<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/movies', [MovieController::class, 'index'])->name('movies');

    Route::get('/movies/detail/{id}', [MovieController::class, 'detail'])
        ->name('movies.detail');

    Route::get('/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

    Route::post('/favorite/add', [FavoriteController::class, 'add'])
        ->name('favorites.add');

    Route::delete('/favorite/remove/{id}', [FavoriteController::class, 'remove'])
        ->name('favorites.remove');

});
