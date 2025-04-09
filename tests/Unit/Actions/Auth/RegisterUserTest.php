<?php

declare(strict_types = 1);

use App\Actions\Auth\RegisterUser;
use App\DTOs\Auth\RegisterUserDTO;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

it('registers a new user, hashes the password, and dispatches an event', function (): void {
    $data = new RegisterUserDTO(
        name:     'Test User',
        email:    'test@example.com',
        password: 'secret123',
    );

    Event::fake();

    $action = new RegisterUser();
    $user   = $action->handle($data);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe($data->name)
        ->and($user->email)->toBe($data->email)
        ->and(Hash::check($data->password, $user->password))->toBeTrue();

    $this->assertDatabaseHas('users', [
        'id'    => $user->id,
        'name'  => $data->name,
        'email' => $data->email,
    ]);

    Event::assertDispatched(Registered::class, fn ($event): bool => $event->user->id === $user->id);
});
