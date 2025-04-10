<div class="flex flex-col items-start">
    @include('livewire.settings.partials.settings-heading')

    <x-feature.settings.layout :heading="__('Appearance')" :subheading="__('Update your account\'s appearance settings')">
        <flux:radio.group variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group>
    </x-feature.settings.layout>
</div>
