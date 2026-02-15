<x-layouts::app :title="__('User Management')">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('User Management') }}</flux:heading>
                <flux:text>{{ __('Create, update, and remove users.') }}</flux:text>
            </div>

            <flux:button :href="route('users.create')" variant="primary" wire:navigate>
                {{ __('Create User') }}
            </flux:button>
        </div>

        @if (session('status'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 dark:border-green-900 dark:bg-green-950">
                <flux:text class="text-green-700 dark:text-green-300">{{ session('status') }}</flux:text>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 dark:border-red-900 dark:bg-red-950">
                <flux:text class="text-red-700 dark:text-red-300">{{ session('error') }}</flux:text>
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-900">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Name') }}</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Email') }}</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Created') }}</th>
                        <th scope="col" class="px-4 py-3 text-right text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 bg-white dark:divide-zinc-700 dark:bg-zinc-800">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-4 py-3 text-sm text-zinc-900 dark:text-zinc-100">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <flux:button :href="route('users.show', $user)" size="sm" wire:navigate>
                                        {{ __('View') }}
                                    </flux:button>

                                    <flux:button :href="route('users.edit', $user)" size="sm" wire:navigate>
                                        {{ __('Edit') }}
                                    </flux:button>

                                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button
                                            type="submit"
                                            size="sm"
                                            variant="danger"
                                            onclick="return confirm('{{ __('Delete this user?') }}')"
                                        >
                                            {{ __('Delete') }}
                                        </flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                {{ __('No users found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</x-layouts::app>
