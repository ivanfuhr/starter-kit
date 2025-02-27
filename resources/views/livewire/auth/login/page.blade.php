<div class="flex flex-col gap-6">
    <x-feature.auth.header
            :title="__('Log in to your account')"
            :description="__('Enter your email and password below to log in')"
    />

    <!-- Session Status -->
    <x-feature.auth.session-status class="text-center" :status="session('status')"/>

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input wire:model="email"
                    label="{{ __('Email address') }}"
                    type="email"
                    name="email"
                    required="required"
                    autocomplete="email"
                    placeholder="{{ __('email@example.com') }}"
                    autofocus
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                    wire:model="password"
                    label="{{ __('Password') }}"
                    type="password"
                    name="password"
                    required="required"
                    autocomplete="current-password"
                    placeholder="{{ __('Password') }}"
            />

            @if (Route::has('password.request'))
                <x-ui.text-link class="absolute right-0 top-0" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </x-ui.text-link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" label="{{ __('Remember me') }}"/>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Don\'t have an account?') }}
            <x-ui.text-link href="{{ route('register') }}">{{ __('Sign up') }}</x-ui.text-link>
        </div>
    @endif
</div>