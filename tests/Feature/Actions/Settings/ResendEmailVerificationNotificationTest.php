<?php

declare(strict_types = 1);

use App\Actions\Settings\ResendEmailVerificationNotification;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

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
    Session::spy();

    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $action = new ResendEmailVerificationNotification();
    $result = $action->handle($user);

    Notification::assertSentTo($user, VerifyEmail::class);

    Session::shouldHaveReceived('flash')->once()->with('status', 'verification-link-sent');

    expect($result)->toBeTrue();
});
