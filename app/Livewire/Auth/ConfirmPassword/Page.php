<?php

declare(strict_types = 1);

namespace App\Livewire\Auth\ConfirmPassword;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
final class Page extends Component
{
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email'    => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => \Carbon\Carbon::now()->timestamp]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.auth.confirm-password.page');
    }
}
