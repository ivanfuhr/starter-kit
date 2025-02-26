<?php

declare(strict_types = 1);

namespace App\Livewire\Settings\Password;

use App\Actions\Settings\UpdateUserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;

final class Page extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function updatePassword(UpdateUserPassword $action): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password'         => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        $action->handle(Auth::user(), $validated['password']);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }

    public function render(): View
    {
        return view('livewire.settings.password.page');
    }
}
