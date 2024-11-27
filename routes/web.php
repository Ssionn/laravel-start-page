<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\StartpageController;
use App\Livewire\GithubRepository;
use Illuminate\Support\Facades\Route;

Route::get('/auth/github/redirect', [SocialiteController::class, 'redirect'])->name('github.redirect');
Route::get('/auth/github/callback', [SocialiteController::class, 'callback'])->name('github.callback');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/', [StartpageController::class, 'index'])->name('startpage');
    Route::post('/refresh', [GithubRepository::class, 'refresh'])->name('refresh');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
