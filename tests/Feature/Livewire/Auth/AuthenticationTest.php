<?php

declare(strict_types = 1);

use App\Livewire\Auth\Login\Page;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('login screen can be rendered', function (): void {
    $this->get(route('login'))->assertOk();
});

test('users can authenticate using the login screen', function (): void {
    $user = User::factory()->create();

    Livewire::test(Page::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    expect(auth()->check())->toBeTrue();
});

test('users can not authenticate with invalid password', function (): void {
    $user = User::factory()->create();

    Livewire::test(Page::class)
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors(['email' => __('auth.failed')]);

    expect(auth()->check())->toBeFalse();
});

test('rate limiting locks the user out after too many attempts', function (): void {
    Event::fake([Lockout::class]);

    $user        = User::factory()->create();
    $throttleKey = strtolower((string) $user->email) . '|' . request()->ip();

    RateLimiter::clear($throttleKey);

    foreach (range(1, 5) as $attempt) {
        Livewire::test(Page::class)
            ->set('email', $user->email)
            ->set('password', 'wrong-password')
            ->call('login')
            ->assertHasErrors(['email']);
    }

    Livewire::test(Page::class)
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors(['email']);

    Event::assertDispatched(Lockout::class);
    expect(RateLimiter::tooManyAttempts($throttleKey, 5))->toBeTrue();
});
