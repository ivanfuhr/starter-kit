<?php

declare(strict_types = 1);

namespace App\Livewire\Settings\Profile;

use App\Actions\Settings\DeleteAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

final class DeleteUserForm extends Component
{
    public string $password = '';

    public function deleteUser(DeleteAccount $action): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        $action->handle($user);

        $this->redirectRoute('logout', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.settings.profile.delete-user-form');
    }
}
