<?php

declare(strict_types = 1);

namespace App\Actions\Settings;

use App\DTOs\Settings\UpdateUserPasswordDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UpdateUserPassword
{
    public function handle(User $user, UpdateUserPasswordDTO $data): User
    {
        $user->update([
            'password' => Hash::make($data->newPassword),
        ]);

        return $user;
    }
}
