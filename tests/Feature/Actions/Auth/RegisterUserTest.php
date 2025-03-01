<?php

declare(strict_types = 1);

use App\Actions\Auth\RegisterUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

it('registers a new user, hashes the password, and dispatches an event', function (): void {
    $attributes = [
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'password' => 'secret123',
    ];

    Event::fake();

    $action = new RegisterUser();
    $user   = $action->handle($attributes);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe($attributes['name'])
        ->and($user->email)->toBe($attributes['email'])
        ->and(Hash::check($attributes['password'], $user->password))->toBeTrue();

    $this->assertDatabaseHas('users', [
        'id'    => $user->id,
        'name'  => $attributes['name'],
        'email' => $attributes['email'],
    ]);

    Event::assertDispatched(Registered::class, fn ($event): bool => $event->user->id === $user->id);
});
