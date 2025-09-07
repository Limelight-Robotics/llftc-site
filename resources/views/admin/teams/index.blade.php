<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
                {{ __('Manage Teams') }}
            </h2>
            <a href="{{ route('admin.teams.create') }}" class="bg-zinc-50 hover:bg-zinc-200 text-zinc-900 font-bold py-2 px-4 rounded">
                Create Team
            </a>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-100">
                    <div class="mb-6">
                        <nav class="flex space-x-4 mb-4">
                            <a href="{{ route('admin.users.index') }}" class="bg-zinc-600 hover:bg-zinc-700 text-white px-4 py-2 rounded">Users</a>
                            <a href="{{ route('admin.teams.index') }}" class="bg-zinc-50 text-zinc-900 px-4 py-2 rounded">Teams</a>
                        </nav>
                    </div>

                    @if($teams->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-zinc-700 rounded-lg">
                                <thead class="bg-zinc-600">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Users
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Entries
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            ID
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-600">
                                    @foreach($teams as $team)
                                        <tr class="hover:bg-zinc-600">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                                {{ $team->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                {{ $team->users_count }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                {{ $team->entries_count }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.teams.edit', $team) }}" 
                                                       class="bg-zinc-50 hover:bg-zinc-200 text-zinc-900 px-3 py-1 rounded text-xs">
                                                        Edit
                                                    </a>
                                                    @if($team->name !== 'Uncategorized')
                                                        <form method="POST" action="{{ route('admin.teams.destroy', $team) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    onclick="return confirm('Are you sure? All entries will be moved to Uncategorized.')"
                                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                {{ $team->id }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <h3 class="text-lg font-medium text-zinc-300 mb-2">No teams found</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
