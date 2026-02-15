<x-layouts::app :title="__('Edit User')">
    <div class="mx-auto w-full max-w-2xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Edit User') }}</flux:heading>
                <flux:text>{{ __('Update user details.') }}</flux:text>
            </div>

            <flux:button :href="route('users.index')" wire:navigate>
                {{ __('Back') }}
            </flux:button>
        </div>

        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:input
                name="name"
                :label="__('Name')"
                :value="old('name', $user->name)"
                type="text"
                required
                autofocus
                autocomplete="name"
            />

            <flux:input
                name="email"
                :label="__('Email')"
                :value="old('email', $user->email)"
                type="email"
                required
                autocomplete="email"
            />

            <flux:input
                name="password"
                :label="__('New Password (Optional)')"
                type="password"
                autocomplete="new-password"
                viewable
            />

            <flux:input
                name="password_confirmation"
                :label="__('Confirm New Password')"
                type="password"
                autocomplete="new-password"
                viewable
            />

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">
                    {{ __('Save Changes') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
