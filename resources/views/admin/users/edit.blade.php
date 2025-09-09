<x-layouts.app>
    <div class="py-12 bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 min-h-screen rounded-t-2xl">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Edit User: {{ $user->name }}</h1>
                <p class="text-zinc-400 text-lg">Update user account information</p>
            </div>

            <div class="bg-gradient-to-br from-zinc-800/95 via-zinc-700/90 to-zinc-800/95 overflow-hidden shadow-xl border border-zinc-600/50 backdrop-blur-sm sm:rounded-xl">
                <div class="p-8 text-zinc-100">
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
                            <div class="px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-zinc-400">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="team_id" class="block text-sm font-medium text-zinc-300 mb-2">Team</label>
                            <select name="team_id" 
                                    id="team_id" 
                                    class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
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
                               class="bg-zinc-600 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
