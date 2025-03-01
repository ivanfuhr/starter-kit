<?php

declare(strict_types = 1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('login screen can be rendered', function (): void {
    $response = $this->get(route('login'));
    $response->assertOk();
});

test('users can authenticate using the login screen', function (): void {
    $user = User::factory()->create();

    $response = Livewire::test('auth.login.page')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login');

    $response->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function (): void {
    $user = User::factory()->create();

    $this->post(route('login'), [
        'email'    => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $this->assertGuest();
    $response->assertRedirect('/');
});
