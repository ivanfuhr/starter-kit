<?php

declare(strict_types = 1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('renders the registration screen', function (): void {
    $this->get('/register')->assertOk();
});

test('registers new users', function (): void {
    Livewire::test('auth.register.page')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', false));

    $this->assertAuthenticated();
});
