<?php

declare(strict_types = 1);

use App\Actions\Settings\UpdateUserProfileInformation;
use App\Models\User;

it('updates user profile information without resetting email verification when email remains unchanged', function (): void {
    $user = User::factory()->create([
        'name'              => 'Original Name',
        'email'             => 'original@example.com',
        'email_verified_at' => now(),
    ]);

    $attributes = [
        'name'  => 'Updated Name',
        'email' => 'original@example.com',
    ];

    $action      = new UpdateUserProfileInformation();
    $updatedUser = $action->handle($user, $attributes);

    $user->refresh();

    expect($updatedUser)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('Updated Name')
        ->and($user->email)->toBe('original@example.com')
        ->and($user->email_verified_at)->not()->toBeNull();
});

it('updates user profile information and resets email verification when email changes', function (): void {
    $user = User::factory()->create([
        'name'              => 'Original Name',
        'email'             => 'original@example.com',
        'email_verified_at' => now(),
    ]);

    $attributes = [
        'name'  => 'Updated Name',
        'email' => 'new@example.com',
    ];

    $action      = new UpdateUserProfileInformation();
    $updatedUser = $action->handle($user, $attributes);

    $user->refresh();

    expect($updatedUser)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('Updated Name')
        ->and($user->email)->toBe('new@example.com')
        ->and($user->email_verified_at)->toBeNull();
});
