<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
            {{ __('Edit User: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-100">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Name</label>
                            <div class="px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-md text-zinc-400">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-zinc-300 mb-2">Email</label>
                            <div class="px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-md text-zinc-400">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="team_id" class="block text-sm font-medium text-zinc-300 mb-2">Team</label>
                            <select name="team_id" 
                                    id="team_id" 
                                    class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:border-zinc-500">
                                <option value="">No team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ old('team_id', $user->team_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('team_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_admin" 
                                       id="is_admin" 
                                       value="1"
                                       {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                                       class="h-4 w-4 text-zinc-600 bg-zinc-700 border-zinc-600 rounded focus:ring-zinc-500 focus:ring-2">
                                <label for="is_admin" class="ml-2 text-sm font-medium text-zinc-300">
                                    Administrator privileges
                                </label>
                            </div>
                            @error('is_admin')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.users.index') }}" 
                               class="bg-zinc-600 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-zinc-50 hover:bg-zinc-200 text-zinc-900 font-bold py-2 px-4 rounded">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
