<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
                {{ $entry->title }}
            </h2>
            @auth
                @if(auth()->user()->is_admin || auth()->user()->id === $entry->user_id)
                    <div class="flex space-x-3">
                        <a href="{{ route('entries.edit', $entry) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('entries.destroy', $entry) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this entry?')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-100">
                    <h1 class="text-3xl font-bold text-white mb-4">{{ $entry->title }}</h1>
                    
                    <div class="mb-6 border-b border-zinc-700 pb-4">
                        <div class="flex items-center space-x-4 text-sm text-zinc-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'zinc') }}-800 text-{{ $entry->team->name === 'Software' ? 'green' : ($entry->team->name === 'CAD' ? 'blue' : 'zinc') }}-100">
                                {{ $entry->team->name }}
                            </span>
                            <span>by {{ $entry->user->name }}</span>
                            <span>{{ $entry->created_at->format('F j, Y \a\t g:i A') }}</span>
                            @if($entry->updated_at != $entry->created_at)
                                <span class="text-zinc-400">(updated {{ $entry->updated_at->format('M j, Y') }})</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6 p-4 bg-zinc-700 rounded-lg border-l-4 border-blue-500">
                        <h4 class="text-sm font-medium text-zinc-300 mb-2">Description</h4>
                        <p class="text-zinc-200">{{ $entry->description }}</p>
                    </div>

                    <div class="prose prose-invert prose-lg max-w-none">
                        <div class="entry-content">
                            {!! $entry->content !!}
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-zinc-700">
                        <a href="{{ route('entries.index') }}" 
                           class="bg-zinc-600 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            ← Back to Entries
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .entry-content {
            color: #f9fafb;
        }
        .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6 {
            color: #ffffff;
            font-weight: 600;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }
        .entry-content p {
            margin-bottom: 1em;
            line-height: 1.6;
        }
        .entry-content ul, .entry-content ol {
            margin-bottom: 1em;
            padding-left: 1.5em;
        }
        .entry-content li {
            margin-bottom: 0.5em;
        }
        .entry-content blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1em;
            margin: 1em 0;
            font-style: italic;
            color: #d1d5db;
        }
        .entry-content pre {
            background-color: #111827;
            border: 1px solid #374151;
            border-radius: 0.375rem;
            padding: 1em;
            overflow-x: auto;
            margin: 1em 0;
        }
        .entry-content code {
            background-color: #111827;
            padding: 0.2em 0.4em;
            border-radius: 0.25rem;
            font-size: 0.875em;
            color: #fbbf24;
        }
        .entry-content pre code {
            background-color: transparent;
            padding: 0;
            color: #f9fafb;
        }
        .entry-content a {
            color: #60a5fa;
            text-decoration: underline;
        }
        .entry-content a:hover {
            color: #3b82f6;
        }
    </style>
    @endpush
</x-layouts.app>
