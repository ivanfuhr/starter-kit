<?php

declare(strict_types = 1);

use App\Actions\Settings\ResendEmailVerificationNotification;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

it('returns false if the user has already verified the email', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $action = new ResendEmailVerificationNotification();
    $result = $action->handle($user);

    expect($result)->toBeFalse();
});

it('sends email verification notification if the user is not verified', function (): void {
    Notification::fake();

    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $action = new ResendEmailVerificationNotification();
    $result = $action->handle($user);

    Notification::assertSentTo($user, VerifyEmail::class);

    expect($result)->toBeTrue();
});
