<x-layouts.app>
    <div class="py-12 bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 min-h-screen rounded-t-2xl">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Create Team</h1>
                <p class="text-zinc-400 text-lg">Add a new robotics team to the system</p>
            </div>

            <div class="bg-gradient-to-br from-zinc-800/95 via-zinc-700/90 to-zinc-800/95 overflow-hidden shadow-xl border border-zinc-600/50 backdrop-blur-sm sm:rounded-xl">
                <div class="p-8 text-zinc-100">
                    <form method="POST" action="{{ route('admin.teams.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Team Name *</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}" 
                                   required
                                   class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Enter team name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-zinc-300 mb-2">Description</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="3" 
                                      class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                      placeholder="Enter team description (optional)">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.teams.index') }}" 
                               class="bg-zinc-600 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Create Team
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
