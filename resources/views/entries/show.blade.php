<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
                {{ $entry->title }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-zinc-400">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ $entry->created_at->format('M j, Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-t-2xl">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl border border-zinc-700/50">
                <div class="p-8 text-zinc-100">
                    <!-- Entry Header -->
                    <div class="mb-8">
                        <h1 class="text-4xl font-bold text-white mb-6 leading-tight">{{ $entry->title }}</h1>
                        
                        <div class="flex flex-wrap items-center gap-4 text-sm text-zinc-300 pb-6 border-b border-zinc-700/70">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'purple') }}-900/50 text-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'purple') }}-200 border border-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'purple') }}-700/50">
                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $entry->team->name }}
                            </span>
                            <div class="flex items-center text-zinc-400">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                by <span class="font-medium text-zinc-300 ml-1">{{ $entry->user->name }}</span>
                            </div>
                            <div class="flex items-center text-zinc-400">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $entry->created_at->format('F j, Y \a\t g:i A') }}
                            </div>
                            @if($entry->updated_at != $entry->created_at)
                                <div class="flex items-center text-zinc-500">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                    </svg>
                                    updated {{ $entry->updated_at->format('M j, Y') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description Box -->
                    @if($entry->description)
                    <div class="mb-8 p-6 bg-gradient-to-r from-zinc-700/50 to-zinc-800/50 rounded-lg border-l-4 border-indigo-500 shadow-lg">
                        <h4 class="text-sm font-semibold text-zinc-300 mb-3 uppercase tracking-wide">Description</h4>
                        <p class="text-zinc-200 text-lg leading-relaxed">{{ $entry->description }}</p>
                    </div>
                    @endif

                    <!-- Content Area -->
                    <div class="max-w-none">
                        <div class="wysiwyg-content bg-zinc-900/80 p-8 rounded-lg shadow-inner border border-zinc-700 min-h-[400px]">
                            {!! $entry->content !!}
                        </div>
                    </div>

                    <!-- Footer Navigation -->
                    <div class="mt-12 pt-8 border-t border-zinc-700/70 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <a href="{{ route('entries.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-zinc-700 hover:bg-zinc-600 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl group">
                            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Back to Entries
                        </a>
                        
                        @auth
                            @if(auth()->user()->is_admin || auth()->user()->id === $entry->user_id)
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('entries.edit', $entry) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                        Edit Entry
                                    </a>
                                    <form method="POST" action="{{ route('entries.destroy', $entry) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this entry?')"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Delete Entry
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
