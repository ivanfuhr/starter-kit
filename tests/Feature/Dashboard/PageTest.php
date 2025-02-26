<?php

declare(strict_types = 1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('redirects guests to the login page', function (): void {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('allows authenticated users to visit the dashboard', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->get(route('dashboard'))->assertOk();
});
