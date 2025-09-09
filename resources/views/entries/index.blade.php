<x-layouts.app title="Build Documentation Entries">
    <div class="py-12 min-h-screen bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-t-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Build Documentation</h1>
                    <p class="text-zinc-400 text-lg">Track and share your robotics development progress</p>
                </div>
                @auth
                    <a href="{{ route('entries.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl group">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Create Entry
                    </a>
                @endauth
            </div>
            
            <div class="bg-zinc-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl border border-zinc-700/50">
                <div class="p-8 text-zinc-100">
                    @if($entries->count() > 0)
                        <div class="grid gap-6">
                            @foreach($entries as $entry)
                                <div class="bg-gradient-to-r from-zinc-700/50 to-zinc-800/50 rounded-xl p-6 hover:from-zinc-600/50 hover:to-zinc-700/50 transition-all duration-300 border border-zinc-600/30 hover:border-zinc-500/50 shadow-lg hover:shadow-xl group">
                                    <div class="flex flex-col lg:flex-row justify-between items-start gap-4">
                                        <div class="flex-1">
                                            <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-indigo-300 transition-colors duration-200">
                                                <a href="{{ route('entries.show', $entry) }}" class="hover:text-indigo-400">
                                                    {{ $entry->title }}
                                                </a>
                                            </h3>
                                            
                                            <!-- Metadata Row -->
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-zinc-300 mb-4">
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
                                                    {{ $entry->created_at->format('M j, Y') }}
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
                                            
                                            <!-- Description -->
                                            @if($entry->description)
                                                <div class="text-zinc-300 text-lg leading-relaxed line-clamp-3 mb-4">
                                                    {{ $entry->description }}
                                                </div>
                                            @endif
                                            
                                            <!-- Read More Link -->
                                            <a href="{{ route('entries.show', $entry) }}" 
                                               class="inline-flex items-center text-indigo-400 hover:text-indigo-300 font-medium transition-colors duration-200 group">
                                                Read full entry
                                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </div>
                                        
                                        @auth
                                            @if(auth()->user()->is_admin || auth()->user()->id === $entry->user_id)
                                                <div class="flex items-center space-x-3">
                                                    <a href="{{ route('entries.edit', $entry) }}" 
                                                       class="inline-flex items-center px-4 py-2 bg-zinc-600 hover:bg-zinc-500 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8 flex justify-center">
                            <div class="bg-zinc-700/50 rounded-lg p-4 border border-zinc-600/30">
                                {{ $entries->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="max-w-md mx-auto">
                                <svg class="w-24 h-24 mx-auto text-zinc-600 mb-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                </svg>
                                <h3 class="text-2xl font-bold text-zinc-300 mb-3">No entries yet</h3>
                                <p class="text-zinc-400 text-lg mb-6">Start documenting your robotics build process and share your progress with the team!</p>
                                @auth
                                    <a href="{{ route('entries.create') }}" 
                                       class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Create Your First Entry
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* Custom pagination styling to match zinc theme */
        .pagination {
            @apply flex space-x-1;
        }
        
        .pagination .page-link {
            @apply px-3 py-2 text-sm font-medium text-zinc-300 bg-zinc-700 border border-zinc-600 hover:bg-zinc-600 hover:text-white transition-all duration-200 rounded-md;
        }
        
        .pagination .page-item.active .page-link {
            @apply bg-indigo-600 text-white border-indigo-600;
        }
        
        .pagination .page-item.disabled .page-link {
            @apply text-zinc-500 bg-zinc-800 border-zinc-700 cursor-not-allowed;
        }
        
        /* Line clamp utility for description truncation */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush
</x-layouts.app>
