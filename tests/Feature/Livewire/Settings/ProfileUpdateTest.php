<?php

declare(strict_types = 1);

use App\Actions\Settings\ResendEmailVerificationNotification;
use App\Livewire\Settings\Profile\Page;
use App\Models\User;
use Livewire\Livewire;

test('displays the profile page', function (): void {
    $this->actingAs(User::factory()->create());

    $this->get(route('settings.profile'))->assertOk();
});

test('updates the profile information and dispatches event', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(Page::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation')
        ->assertDispatched('profile-updated', fn (string $eventName, array $payload): bool => $payload['name'] === 'Test User')
        ->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com')
        ->and($user->email_verified_at)->toBeNull();
});

test('does not change email verification status if email is unchanged', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(Page::class)
        ->set('name', 'New Name')
        ->set('email', $user->email)
        ->call('updateProfileInformation')
        ->assertDispatched('profile-updated', fn (string $eventName, array $payload): bool => $payload['name'] === 'New Name')
        ->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not()->toBeNull();
});

test('resends verification notification successfully', function (): void {
    $user = User::factory()->unverified()->create();
    $this->actingAs($user);

    Livewire::test(Page::class)
        ->call('resendVerificationNotification')
        ->assertSessionHas('status', 'verification-link-sent');
});

test('redirects if verification notification is not sent', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(Page::class)
        ->call('resendVerificationNotification')
        ->assertRedirect(route('dashboard', absolute: false));
});
