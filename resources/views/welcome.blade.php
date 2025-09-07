<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lemon - Robotics Documentation</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-zinc-900 text-zinc-50 antialiased">
        <div class="min-h-screen bg-zinc-900">
            <!-- Navigation -->
            <nav class="bg-zinc-800/50 border-b border-zinc-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-zinc-50">{{ config('app.name') }}</h1>
                        </div>
                        
                        @if (Route::has('login'))
                            <div class="flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" 
                                       class="bg-zinc-700 hover:bg-zinc-600 text-zinc-50 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="text-zinc-300 hover:text-zinc-50 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                        Log in
                                    </a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="py-20 lg:py-32">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-5xl font-bold tracking-tight text-zinc-50 sm:text-7xl">
                        {{ config('app.name') }}
                    </h1>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="bg-zinc-50 text-zinc-900 hover:bg-zinc-200 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="bg-zinc-50 text-zinc-900 hover:bg-zinc-200 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            
            <!-- Entries Section -->
            @if($recentEntries->isNotEmpty())
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-zinc-50 sm:text-4xl">
                            Recent Documentation
                        </h2>
                        <p class="mt-4 text-zinc-400">
                            Latest entries from robotics teams
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($recentEntries as $entry)
                            <div class="bg-zinc-800/50 rounded-lg p-6 border border-zinc-700 hover:border-zinc-600 transition-colors">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-flex items-center rounded-md bg-zinc-700 px-2 py-1 text-xs font-medium text-zinc-300">
                                        {{ $entry->team->name }}
                                    </span>
                                    <time class="text-xs text-zinc-500">
                                        {{ $entry->created_at->format('M j, Y') }}
                                    </time>
                                </div>
                                
                                <h3 class="text-lg font-semibold text-zinc-50 mb-2 line-clamp-2">
                                    {{ $entry->title }}
                                </h3>
                                
                                @if($entry->description)
                                    <p class="text-zinc-400 text-sm mb-4 line-clamp-3">
                                        {{ $entry->description }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('entries.show', $entry) }}" 
                                       class="text-zinc-300 hover:text-zinc-50 text-sm font-medium transition-colors">
                                        Read more →
                                    </a>
                                    <span class="text-xs text-zinc-500">
                                        {{ $entry->user->name }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('entries.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-zinc-600 text-zinc-300 rounded-lg hover:bg-zinc-800/50 hover:text-zinc-50 transition-colors">
                            View All Entries
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>