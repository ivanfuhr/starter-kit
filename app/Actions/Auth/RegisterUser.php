<?php

declare(strict_types = 1);

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

final class RegisterUser
{
    /**
     * @param array{ name: string, email: string, password: string } $attributes
     */
    public function handle(array $attributes): User
    {
        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        event(new Registered($user));

        return $user;
    }
}
