<?php

declare(strict_types = 1);

namespace App\Actions\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UpdateUserPassword
{
    public function handle(User $user, string $password): User
    {
        $user->update([
            'password' => Hash::make($password),
        ]);

        return $user;
    }
}
