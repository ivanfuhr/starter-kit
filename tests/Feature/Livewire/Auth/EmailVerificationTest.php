<?php

declare(strict_types = 1);

use App\Livewire\Auth\VerifyEmail\Page;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders the email verification screen', function (): void {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->get(route('verification.notice'))
        ->assertOk();
});

it('verifies the email', function (): void {
    Event::fake();

    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1((string) $user->email)]
    );

    $response = $this->actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();

    $response->assertRedirect(route('dashboard', absolute: false) . '?verified=1');
});

it('does not verify the email with an invalid hash', function (): void {
    $user = User::factory()->unverified()->create();

    $invalidVerificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($invalidVerificationUrl);

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

it('does not send verification if already verified', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Livewire::actingAs($user)
        ->test(Page::class)
        ->call('sendVerification')
        ->assertRedirect(route('dashboard', absolute: false));
});

it('sends verification email if not verified', function (): void {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    Livewire::actingAs($user)
        ->test(Page::class)
        ->call('sendVerification')
        ->assertHasNoErrors();

    Notification::assertSentTo($user, Illuminate\Auth\Notifications\VerifyEmail::class);
});
