<?php

declare(strict_types = 1);

namespace App\Livewire\Settings\Profile;

use App\Actions\Auth\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

final class DeleteUserForm extends Component
{
    public string $password = '';

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.settings.profile.delete-user-form');
    }
}
