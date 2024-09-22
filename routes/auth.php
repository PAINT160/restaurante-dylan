<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProviderController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('guest')->group(function () {

    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});


Route::middleware('check')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::get('/auth/github', [ProviderController::class, 'redirectGithub'])->name('github.redirect');
Route::get('/auth/redirect', [ProviderController::class, 'redirectFacebook'])->name('facebook.redirect');
Route::get('/auth/callback', [ProviderController::class, 'callbackAuth'])->name('auth.callback');
Route::get('/google/redirect', [ProviderController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [ProviderController::class, 'handleGoogleCallback'])->name('google.callback');
