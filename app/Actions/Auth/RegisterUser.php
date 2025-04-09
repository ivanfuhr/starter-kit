<?php

declare(strict_types = 1);

namespace App\Actions\Auth;

use App\DTOs\Auth\RegisterUserDTO;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

final class RegisterUser
{
    public function handle(RegisterUserDTO $data): User
    {
        $user = User::create([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => Hash::make($data->password),
        ]);

        event(new Registered($user));

        return $user;
    }
}
