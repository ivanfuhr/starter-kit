<?php

declare(strict_types = 1);

namespace App\Actions\Settings;

use App\DTOs\Settings\UpdateUserProfileInformationDTO;
use App\Models\User;

final class UpdateUserProfileInformation
{
    public function handle(User $user, UpdateUserProfileInformationDTO $data): User
    {
        $user->fill([
            'name'  => $data->name,
            'email' => $data->email,
        ]);

        if ($user->isDirty('email')) {
            $user->update(['email_verified_at' => null]);
        }

        $user->save();

        return $user;
    }
}
