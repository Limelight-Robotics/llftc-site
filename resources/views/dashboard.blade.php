<x-layouts.app :title="__('Dashboard')">
    <div class="p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-100 mb-2">{{ config('app.name') }}</h1>
            <p class="text-zinc-400">Track your robotics build progress, share insights, and collaborate with your team.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-zinc-800 rounded-lg p-6 border border-zinc-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/10 text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-zinc-100">{{ \App\Models\Entry::count() }}</h3>
                        <p class="text-zinc-400">Total Entries</p>
                    </div>
                </div>
            </div>

            <div class="bg-zinc-800 rounded-lg p-6 border border-zinc-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500/10 text-green-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-zinc-100">{{ \App\Models\Team::count() }}</h3>
                        <p class="text-zinc-400">Teams</p>
                    </div>
                </div>
            </div>

            <div class="bg-zinc-800 rounded-lg p-6 border border-zinc-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500/10 text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-zinc-100">{{ \App\Models\User::count() }}</h3>
                        <p class="text-zinc-400">Team Members</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Entries -->
        <div class="bg-zinc-800 rounded-lg border border-zinc-700">
            <div class="p-6 border-b border-zinc-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-zinc-100">Recent Entries</h2>
                    <a href="{{ route('entries.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">View all</a>
                </div>
            </div>
            <div class="p-6">
                @php
                    $recentEntries = \App\Models\Entry::with(['user', 'team'])->latest()->take(5)->get();
                @endphp
                
                @if($recentEntries->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentEntries as $entry)
                            <div class="flex items-start justify-between p-4 bg-zinc-700/50 rounded-lg">
                                <div class="flex-1">
                                    <h3 class="font-medium text-zinc-100 mb-1">
                                        <a href="{{ route('entries.show', $entry) }}" class="hover:text-blue-400">
                                            {{ $entry->title }}
                                        </a>
                                    </h3>
                                    @if($entry->description)
                                        <p class="text-zinc-400 text-sm mb-2">{{ Str::limit($entry->description, 100) }}</p>
                                    @endif
                                    <div class="flex items-center space-x-3 text-xs text-zinc-500">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'zinc') }}-800 text-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'zinc') }}-200">
                                            {{ $entry->team->name }}
                                        </span>
                                        <span>by {{ $entry->user->name }}</span>
                                        <span>{{ $entry->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="p-3 rounded-full bg-zinc-700 inline-block mb-4">
                            <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-zinc-300 mb-2">No entries yet</h3>
                        <p class="text-zinc-400 mb-4">Start documenting your build process to track progress and share knowledge.</p>
                        <a href="{{ route('entries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Create First Entry
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
