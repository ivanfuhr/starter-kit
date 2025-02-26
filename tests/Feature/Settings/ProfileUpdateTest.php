<?php

declare(strict_types = 1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('displays the profile page', function (): void {
    $this->actingAs($user = User::factory()->create());

    $this->get(route('settings.profile'))->assertOk();
});

test('updates the profile information', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test('settings.profile.page')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation')
        ->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com')
        ->and($user->email_verified_at)->toBeNull();
});

test('does not change the email verification status when the email remains unchanged', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test('settings.profile.page')
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('updateProfileInformation')
        ->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('deletes the user account', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test('settings.profile.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser')
        ->assertHasNoErrors();

    expect($user->fresh())->toBeNull()
        ->and(auth()->check())->toBeFalse();
});

test('requires the correct password to delete the account', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test('settings.profile.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});
