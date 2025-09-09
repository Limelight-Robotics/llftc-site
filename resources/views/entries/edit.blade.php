<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
            {{ __('Edit Entry: ') . $entry->title }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-zinc-800/95 via-zinc-700/90 to-zinc-800/95 overflow-hidden shadow-xl border border-zinc-600/50 backdrop-blur-sm sm:rounded-xl">
                <div class="p-8 text-zinc-100">
                    <form method="POST" action="{{ route('entries.update', $entry) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-zinc-300 mb-2">Title</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $entry->title) }}" 
                                   required
                                   class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        @if(auth()->user()->is_admin)
                            <div class="mb-6">
                                <label for="team_id" class="block text-sm font-medium text-zinc-300 mb-2">Team</label>
                                <select name="team_id" 
                                        id="team_id" 
                                        class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="">Select a team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ old('team_id', $entry->team_id) == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-zinc-300 mb-2">Description *</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="3" 
                                      required
                                      placeholder="Brief description of this entry..."
                                      class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('description', $entry->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-zinc-300 mb-2">Content</label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="20" 
                                      required
                                      class="w-full px-3 py-2 bg-zinc-700 border border-zinc-600 rounded-lg text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('content', $entry->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('entries.show', $entry) }}" 
                               class="bg-zinc-600 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Update Entry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
