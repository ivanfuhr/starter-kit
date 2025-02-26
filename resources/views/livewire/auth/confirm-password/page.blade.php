<div class="flex flex-col gap-6">
    <x-feature.auth-header
            :title="__('Confirm password')"
            :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
    />

    <!-- Session Status -->
    <x-feature.auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
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

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Confirm') }}</flux:button>
    </form>
</div>