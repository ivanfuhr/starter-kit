<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('auth')->group(function (): void {
    Route::get('dashboard', App\Livewire\Dashboard\Page::class)->name('dashboard');

    Route::prefix('settings')->group(function (): void {
        Route::get('profile', App\Livewire\Settings\Profile\Page::class)->name('settings.profile');
        Route::get('password', App\Livewire\Settings\Password\Page::class)->name('settings.password');
        Route::get('appearance', App\Livewire\Settings\Appearance\Page::class)->name('settings.appearance');
    });
});

require __DIR__ . '/auth.php';
