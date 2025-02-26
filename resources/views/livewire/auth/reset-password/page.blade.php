<div class="flex flex-col gap-6">
    <x-feature.auth-header :title="__('Reset password')"
                           :description="__('Please enter your new password below')"
    />

    <!-- Session Status -->
    <x-feature.auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="resetPassword" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div class="grid gap-2">
            <flux:input wire:model="email"
                        id="email"
                        label="{{ __('Email') }}"
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
            />
        </div>

        <!-- Password -->
        <div class="grid gap-2">
            <flux:input
                    wire:model="password"
                    id="password"
                    label="{{ __('Password') }}"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Password') }}"
            />
        </div>

        <!-- Confirm Password -->
        <div class="grid gap-2">
            <flux:input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    label="{{ __('Confirm password') }}"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Confirm password') }}"
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Reset password') }}
            </flux:button>
        </div>
    </form>
</div>