<?php

declare(strict_types = 1);

namespace App\Livewire\Settings\Profile;

use App\Actions\Settings\ResendEmailVerificationNotification;
use App\Actions\Settings\UpdateUserProfileInformation;
use App\DTOs\Settings\UpdateUserProfileInformationDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Page extends Component
{
    public string $name = '';

    public string $email = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->name  = $user->name;
        $this->email = $user->email;
    }

    public function updateProfileInformation(UpdateUserProfileInformation $action): void
    {
        $this->validate();

        /** @var User $user */
        $user = Auth::user();

        $data = new UpdateUserProfileInformationDTO(
            name: $this->name,
            email: $this->email,
        );

        $user = $action->handle($user, $data);

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function resendVerificationNotification(ResendEmailVerificationNotification $action): void
    {
        /** @var User $user */
        $user = Auth::user();

        $sent = $action->handle($user);

        if ($sent) {
            Session::flash('status', 'verification-link-sent');
        }

        $this->redirectIntended(default: route('dashboard', absolute: false));
    }

    public function render(): View
    {
        return view('livewire.settings.profile.page');
    }

    /**
     * @return array<string, mixed>
     */
    private function rules(): array
    {
        /** @var User $user */
        $user = Auth::user();

        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ];
    }
}
