<section class="w-full">
    @include('livewire.settings.partials.settings-heading')

    <x-feature.settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                    wire:model="current_password"
                    id="update_password_current_passwordpassword"
                    label="{{ __('Current password') }}"
                    type="password"
                    name="current_password"
                    required="required"
                    autocomplete="current-password"
            />

            <flux:input
                    wire:model="password"
                    id="update_password_password"
                    label="{{ __('New password') }}"
                    type="password"
                    name="password"
                    required="required"
                    autocomplete="new-password"
            />

            <flux:input
                    wire:model="password_confirmation"
                    id="update_password_password_confirmation"
                    label="{{ __('Confirm Password') }}"
                    type="password"
                    name="password_confirmation"
                    required="required"
                    autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-ui.action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-ui.action-message>
            </div>
        </form>
    </x-feature.settings.layout>
</section>
