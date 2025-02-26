<?php

declare(strict_types = 1);

namespace App\Livewire\Auth\ForgotPassword;

use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
final class Page extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }

    public function render(): View
    {
        return view('livewire.auth.forgot-password.page');
    }
}
