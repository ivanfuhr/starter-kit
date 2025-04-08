<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Event;

it('redirects if the user has already verified the email', function (): void {
    $user = mock(MustVerifyEmail::class);
    $user->shouldReceive('hasVerifiedEmail')->once()->andReturn(true);

    $request = mock(EmailVerificationRequest::class);
    $request->shouldReceive('user')->andReturn($user);

    $response = (new VerifyEmailController())($request);

    expect($response)->toBeInstanceOf(RedirectResponse::class)
        ->and($response->getTargetUrl())->toContain(route('dashboard') . '?verified=1');
});

it('marks email as verified and dispatches event if not verified', function (): void {
    Event::fake();

    $user = mock(MustVerifyEmail::class);
    $user->shouldReceive('hasVerifiedEmail')->once()->andReturn(false);
    $user->shouldReceive('markEmailAsVerified')->once()->andReturn(true);

    $request = mock(EmailVerificationRequest::class);
    $request->shouldReceive('user')->andReturn($user);

    $response = (new VerifyEmailController())($request);

    Event::assertDispatched(Verified::class, fn ($event): bool => $event->user === $user);

    expect($response)->toBeInstanceOf(RedirectResponse::class)
        ->and($response->getTargetUrl())->toContain(route('dashboard') . '?verified=1');
});
