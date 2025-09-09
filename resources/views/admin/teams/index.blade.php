<x-layouts.app>
    <div class="py-12 bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 min-h-screen rounded-t-2xl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Manage Teams</h1>
                    <p class="text-zinc-400 text-lg">Create and manage robotics teams</p>
                </div>
                <a href="{{ route('admin.teams.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl group">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Create Team
                </a>
            </div>

            <div class="bg-gradient-to-br from-zinc-800/95 via-zinc-700/90 to-zinc-800/95 overflow-hidden shadow-xl border border-zinc-600/50 backdrop-blur-sm sm:rounded-xl">
                <div class="p-8 text-zinc-100">
                    <div class="mb-6">
                        <nav class="flex space-x-4 mb-4">
                            <a href="{{ route('admin.users.index') }}" class="bg-zinc-600 hover:bg-zinc-700 text-white px-4 py-2 rounded-lg transition-colors">Users</a>
                            <a href="{{ route('admin.teams.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">Teams</a>
                        </nav>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 bg-gradient-to-r from-green-600 to-green-700 border border-green-500/50 text-white px-4 py-3 rounded-lg shadow-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($teams->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-zinc-700 rounded-lg">
                                <thead class="bg-zinc-600">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Description
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
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-600">
                                    @foreach($teams as $team)
                                        <tr class="hover:bg-zinc-600">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                                {{ $team->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-zinc-300 max-w-xs">
                                                {{ $team->description ? Str::limit($team->description, 60) : 'No description' }}
                                            </td>
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
                                                       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                                        Edit
                                                    </a>
                                                    @if($team->name !== 'Uncategorized')
                                                        <form method="POST" action="{{ route('admin.teams.destroy', $team) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    onclick="return confirm('Are you sure? All entries will be moved to Uncategorized.')"
                                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
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
