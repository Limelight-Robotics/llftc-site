<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-200 leading-tight">
            {{ __('Edit Entry: ') . $entry->title }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-100">
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

    <!-- CKEditor 5 Styles -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
    <style>
        .ck-editor__editable {
            background-color: #3f3f46 !important;
            color: #f4f4f5 !important;
            border-color: #52525b !important;
            min-height: 400px;
        }
        .ck-toolbar {
            background-color: #27272a !important;
            border-color: #52525b !important;
        }
        .ck-button {
            color: #f4f4f5 !important;
        }
        .ck-button:hover {
            background-color: #52525b !important;
        }
        .ck-button.ck-on {
            background-color: #3b82f6 !important;
            color: white !important;
        }
        .ck-dropdown__panel {
            background-color: #27272a !important;
            border-color: #52525b !important;
        }
        .ck-list__item {
            color: #f4f4f5 !important;
        }
        .ck-list__item:hover {
            background-color: #52525b !important;
        }
        .ck-content pre {
            background-color: #18181b !important;
            border: 1px solid #27272a !important;
            color: #f4f4f5 !important;
        }
        .ck-content blockquote {
            border-left: 4px solid #3b82f6 !important;
            color: #d4d4d8 !important;
        }
    </style>

    <!-- CKEditor 5 Scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, checking for CKEDITOR...');
            console.log('CKEDITOR object:', typeof CKEDITOR !== 'undefined' ? CKEDITOR : 'undefined');
            
            if (typeof CKEDITOR === 'undefined') {
                console.error('CKEditor not loaded');
                return;
            }

            const {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph
            } = CKEDITOR;

            ClassicEditor
                .create(document.querySelector('#content'), {
                    plugins: [Essentials, Bold, Italic, Font, Paragraph],
                    toolbar: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                })
                .then(editor => {
                    window.editor = editor;
                    console.log('CKEditor 5 initialized successfully');
                    
                    // Set initial content from textarea if any
                    const textareaContent = document.querySelector('#content').value;
                    if (textareaContent) {
                        editor.setData(textareaContent);
                    }
                    
                    // Hide the original textarea
                    document.querySelector('#content').style.display = 'none';
                    
                    // Update textarea on editor change
                    editor.model.document.on('change:data', () => {
                        document.querySelector('#content').value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error('CKEditor 5 error:', error);
                    console.error('Error details:', error.message);
                    // Fall back to plain textarea if editor fails
                    document.querySelector('#content').style.display = 'block';
                });
        });
    </script>
</x-layouts.app>
