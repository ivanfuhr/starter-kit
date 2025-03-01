<?php

declare(strict_types = 1);

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('renders the reset password link screen', function (): void {
    $response = $this->get('/forgot-password');
    $response->assertOk();
});

test('can request a reset password link', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test('auth.forgot-password.page')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class);
});

test('renders the reset password screen', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test('auth.forgot-password.page')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification): true {
        $response = $this->get(route('password.reset', $notification->token));
        $response->assertOk();

        return true;
    });
});

test('resets the password with a valid token', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test('auth.forgot-password.page')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user): true {
        $response = Livewire::test('auth.reset-password.page', ['token' => $notification->token])
            ->set('email', $user->email)
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('resetPassword');

        $response->assertHasNoErrors()
            ->assertRedirect(route('login', absolute: false));

        return true;
    });
});
