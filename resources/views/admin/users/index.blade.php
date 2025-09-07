<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-100">
                    <div class="mb-6">
                        <nav class="flex space-x-4 mb-4">
                            <a href="{{ route('admin.users.index') }}" class="bg-zinc-50 text-zinc-900 px-4 py-2 rounded">Users</a>
                            <a href="{{ route('admin.teams.index') }}" class="bg-zinc-600 hover:bg-zinc-700 text-white px-4 py-2 rounded">Teams</a>
                        </nav>
                    </div>

                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-zinc-700 rounded-lg">
                                <thead class="bg-zinc-600">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Team
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Admin
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-600">
                                    @foreach($users as $user)
                                        <tr class="hover:bg-zinc-600">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                                {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                @if($user->team)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-800 text-zinc-100">
                                                        {{ $user->team->name }}
                                                    </span>
                                                @else
                                                    <span class="text-zinc-500">No team</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                @if($user->is_admin)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-800 text-green-100">
                                                        Admin
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-800 text-zinc-100">
                                                        User
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="bg-zinc-50 hover:bg-zinc-200 text-zinc-900 px-3 py-1 rounded text-xs">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <h3 class="text-lg font-medium text-zinc-300 mb-2">No users found</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
