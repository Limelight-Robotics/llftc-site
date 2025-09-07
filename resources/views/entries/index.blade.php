<x-layouts.app title="Build Documentation Entries">
    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-zinc-100">Build Documentation Entries</h1>
                @auth
                    <a href="{{ route('entries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Create Entry
                    </a>
                @endauth
            </div>
            
            <div class="bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-100">
                    @if($entries->count() > 0)
                        <div class="space-y-6">
                            @foreach($entries as $entry)
                                <div class="bg-zinc-700 rounded-lg p-6 hover:bg-zinc-600 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-semibold text-white mb-2">
                                                <a href="{{ route('entries.show', $entry) }}" class="hover:text-blue-400">
                                                    {{ $entry->title }}
                                                </a>
                                            </h3>
                                            <div class="text-sm text-zinc-300 mb-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'zinc') }}-800 text-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'zinc') }}-100">
                                                    {{ $entry->team->name }}
                                                </span>
                                                <span class="ml-3">by {{ $entry->user->name }}</span>
                                                <span class="ml-3">{{ $entry->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <div class="text-zinc-400 line-clamp-3">
                                                {{ $entry->description }}
                                            </div>
                                        </div>
                                        @auth
                                            @if(auth()->user()->is_admin || auth()->user()->id === $entry->user_id)
                                                <div class="ml-4">
                                                    <a href="{{ route('entries.edit', $entry) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                                        Edit
                                                    </a>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $entries->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <h3 class="text-lg font-medium text-zinc-300 mb-2">No entries yet</h3>
                            <p class="text-zinc-400 mb-4">Start documenting your build process!</p>
                            @auth
                                <a href="{{ route('entries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create First Entry
                                </a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
