<?php

declare(strict_types = 1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('renders the confirm password screen', function (): void {
    $user     = User::factory()->create();
    $response = $this->actingAs($user)->get(route('password.confirm'));
    $response->assertOk();
});

test('confirms the password', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = Livewire::test('auth.confirm-password.page')
        ->set('password', 'password')
        ->call('confirmPassword');

    $response->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));
});

test('does not confirm the password with an invalid password', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = Livewire::test('auth.confirm-password.page')
        ->set('password', 'wrong-password')
        ->call('confirmPassword');

    $response->assertHasErrors(['password']);
});
