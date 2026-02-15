<x-layouts::app :title="__('Create User')">
    <div class="mx-auto w-full max-w-2xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Create User') }}</flux:heading>
                <flux:text>{{ __('Add a new user account.') }}</flux:text>
            </div>

            <flux:button :href="route('users.index')" wire:navigate>
                {{ __('Back') }}
            </flux:button>
        </div>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            <flux:input
                name="name"
                :label="__('Name')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
            />

            <flux:input
                name="email"
                :label="__('Email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
            />

            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                viewable
            />

            <flux:input
                name="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
                viewable
            />

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">
                    {{ __('Create User') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
