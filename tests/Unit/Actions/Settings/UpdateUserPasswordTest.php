<?php

declare(strict_types = 1);

use App\Actions\Settings\UpdateUserPassword;
use App\DTOs\Settings\UpdateUserPasswordDTO;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('updates the user password and returns the user instance', function (): void {
    $user = User::factory()->create([
        'password' => Hash::make('oldpassword'),
    ]);

    $newPassword = 'newpassword';

    $action = new UpdateUserPassword();
    $data   = new UpdateUserPasswordDTO($newPassword);

    $updatedUser = $action->handle($user, $data);

    $user->refresh();

    expect($updatedUser)->toBeInstanceOf(User::class);
    expect(Hash::check($newPassword, $user->password))->toBeTrue();
});
