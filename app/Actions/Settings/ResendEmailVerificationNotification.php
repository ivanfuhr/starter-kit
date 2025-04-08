<?php

declare(strict_types = 1);

namespace App\Actions\Settings;

use App\Models\User;

final class ResendEmailVerificationNotification
{
    public function handle(User $user): bool
    {
        if ($user->hasVerifiedEmail()) {
            return false;
        }

        $user->sendEmailVerificationNotification();

        return true;
    }
}
