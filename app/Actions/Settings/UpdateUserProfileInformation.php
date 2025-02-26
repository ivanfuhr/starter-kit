<?php

declare(strict_types = 1);

namespace App\Actions\Settings;

use App\Models\User;

final class UpdateUserProfileInformation
{
    /**
     * @param array{ name: string, email: string } $attributes
     */
    public function handle(User $user, array $attributes): User
    {
        $user->fill($attributes);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $user;
    }
}
