<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('login', App\Livewire\Auth\Login\Page::class)
        ->name('login');

    Route::get('register', App\Livewire\Auth\Register\Page::class)
        ->name('register');

    Route::get('forgot-password', App\Livewire\Auth\ForgotPassword\Page::class)
        ->name('password.request');

    Route::get('reset-password/{token}', App\Livewire\Auth\ResetPassword\Page::class)
        ->name('password.reset');
});

Route::middleware('auth')->group(function (): void {
    Route::get('verify-email', App\Livewire\Auth\VerifyEmail\Page::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', App\Actions\Auth\VerifyEmail::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', App\Livewire\Auth\ConfirmPassword\Page::class)
        ->name('password.confirm');
});

Route::post('logout', App\Actions\Auth\Logout::class)
    ->name('logout');
