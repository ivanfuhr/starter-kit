<div class="flex flex-col gap-6">
    <x-feature.auth.header :title="__('Create an account')"
                           :description="__('Enter your details below to create your account')"
    />

    <!-- Session Status -->
    <x-feature.auth.session-status class="text-center" :status="session('status')"/>

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <div class="grid gap-2">
            <flux:input wire:model="name"
                        id="name"
                        label="{{ __('Name') }}"
                        type="text"
                        name="name"
                        required="required"
                        autofocus
                        autocomplete="name"
                        placeholder="{{ __('Full name') }}"
            />
        </div>

        <!-- Email Address -->
        <div class="grid gap-2">
            <flux:input wire:model="email"
                        id="email"
                        label="{{ __('Email address') }}"
                        type="email"
                        name="email"
                        required="required"
                        autocomplete="email"
                        placeholder="{{ __('email@example.com') }}"
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
                    required="required"
                    autocomplete="new-password"
                    placeholder="Password"
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
                    required="required"
                    autocomplete="new-password"
                    placeholder="Confirm password"
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <x-ui.text-link href="{{ route('login') }}">{{ __('Log in') }}</x-ui.text-link>
    </div>
</div>
