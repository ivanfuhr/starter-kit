<?php

declare(strict_types = 1);

use App\Actions\Settings\DeleteAccount;
use App\Models\User;

test('it deletes the user account', function (): void {
    $user = User::factory()->create();

    (new DeleteAccount())->handle($user);

    expect(User::find($user->id))->toBeNull();
});
