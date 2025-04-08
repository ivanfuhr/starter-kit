<?php

declare(strict_types = 1);

namespace App\Actions\Settings;

use App\Models\User;

final class DeleteAccount
{
    public function handle(User $user): void
    {
        $user->delete();
    }
}
