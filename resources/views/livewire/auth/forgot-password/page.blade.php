<div class="flex flex-col gap-6">
    <x-feature.auth.header :title="__('Forgot password')"
                           :description="__('Enter your email to receive a password reset link')"
    />

    <!-- Session Status -->
    <x-feature.auth.session-status class="text-center" :status="session('status')"/>

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email address -->
        <div class="grid gap-2">
            <flux:input wire:model="email"
                        label="{{ __('Email address') }}"
                        type="email"
                        name="email"
                        required="required"
                        autofocus="autofocus"
                        placeholder="{{ __('email@example.com') }}"
            />
        </div>

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Email password reset link') }}</flux:button>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-400">
        {{ __('Or, return to') }}
        <x-ui.text-link href="{{ route('login') }}">{{ __('Log in') }}</x-ui.text-link>
    </div>
</div>
