<?php

use App\Http\Controllers\BrowserSessionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('ventas', [VentaController::class, 'index'])->name('ventas');

Route::post('ventas/store', [VentaController::class, 'store'])->name('ventas.store');
Route::get('ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');


//USER

Route::middleware(['very', 'check'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::post('dashboard/show', [DashboardController::class, 'show'])->name('dashboard.show');


    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/users/{id}', 'UserController@show')->name('users.show');
    Route::get('/posts/{id}', 'PostController@show')->name('posts.show');





    Route::get('/profile/browser-sessions', [BrowserSessionsController::class, 'index'])->name('profile.browser-sessions');
    Route::post('/profile/logout-other-devices', [BrowserSessionsController::class, 'destroy'])->name('logout.other.devices');
    Route::post('/profile/logout-other-devices', [BrowserSessionsController::class, 'destroy'])
    ->name('logout.other.devices');

});





require __DIR__ . '/auth.php';
