<?php

declare(strict_types = 1);

namespace App\Livewire\Settings\Profile;

use App\Actions\Settings\ResendEmailVerificationNotification;
use App\Actions\Settings\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Page extends Component
{
    public string $name = '';

    public string $email = '';

    public function mount(): void
    {
        $this->name  = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(UpdateUserProfileInformation $action): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user = $action->handle($user, $validated);

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function resendVerificationNotification(ResendEmailVerificationNotification $action): void
    {
        $user = Auth::user();

        $sent = $action->handle($user);

        if (! $sent) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
        }
    }

    public function render(): View
    {
        return view('livewire.settings.profile.page');
    }
}
