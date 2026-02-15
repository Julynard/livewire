<x-layouts::app :title="__('User Details')">
    <div class="mx-auto w-full max-w-2xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('User Details') }}</flux:heading>
                <flux:text>{{ __('View user information.') }}</flux:text>
            </div>

            <div class="flex items-center gap-2">
                <flux:button :href="route('users.edit', $user)" wire:navigate>
                    {{ __('Edit') }}
                </flux:button>
                <flux:button :href="route('users.index')" wire:navigate>
                    {{ __('Back') }}
                </flux:button>
            </div>
        </div>

        <div class="space-y-4 rounded-xl border border-zinc-200 p-6 dark:border-zinc-700">
            <div>
                <flux:text class="text-zinc-500">{{ __('Name') }}</flux:text>
                <flux:heading>{{ $user->name }}</flux:heading>
            </div>

            <div>
                <flux:text class="text-zinc-500">{{ __('Email') }}</flux:text>
                <flux:text>{{ $user->email }}</flux:text>
            </div>

            <div>
                <flux:text class="text-zinc-500">{{ __('Joined') }}</flux:text>
                <flux:text>{{ $user->created_at->toDayDateTimeString() }}</flux:text>
            </div>
        </div>
    </div>
</x-layouts::app>
