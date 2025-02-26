<section class="w-full">
    @include('livewire.settings.partials.settings-heading')

    <x-feature.settings-layout heading="Profile" subheading="Update your name and email address">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" label="{{ __('Name') }}" type="text" name="name" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" label="{{ __('Email') }}" type="email" name="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <p class="mt-2 text-sm text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button
                                    wire:click.prevent="resendVerificationNotification"
                                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-ui.action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-ui.action-message>
            </div>
        </form>

        <livewire:settings.profile.delete-user-form />
    </x-feature.settings-layout>
</section>