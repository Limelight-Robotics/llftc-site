<x-layouts.app>
    <div class="py-12 bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 min-h-screen rounded-t-2xl">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Create New User Account</h1>
                <p class="text-zinc-400 text-lg">Create a base user account. The user will customize their profile details after first login.</p>
            </div>

            <div class="bg-gradient-to-br from-zinc-800/95 via-zinc-700/90 to-zinc-800/95 overflow-hidden shadow-xl border border-zinc-600/50 backdrop-blur-sm sm:rounded-xl">
                <div class="p-8 text-zinc-100">

                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf

                        <!-- Username Field -->
                        <div>
                            <label for="username" class="block text-sm font-semibold text-zinc-300 mb-2">
                                Username <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   value="{{ old('username') }}" 
                                   required
                                   placeholder="e.g., jsmith, robotics_user"
                                   class="w-full px-4 py-3 bg-zinc-700 border border-zinc-600 rounded-lg text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <p class="mt-2 text-xs text-zinc-500">This will be used as their email: username@limelight-robotics.dev</p>
                            @error('username')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Team Assignment -->
                        <div>
                            <label for="team_id" class="block text-sm font-semibold text-zinc-300 mb-2">
                                Team Assignment
                            </label>
                            <select name="team_id" 
                                    id="team_id" 
                                    class="w-full px-4 py-3 bg-zinc-700 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">No team (unassigned)</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-zinc-500">Users can be reassigned to teams later</p>
                            @error('team_id')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Privileges -->
                        <div>
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" 
                                       name="is_admin" 
                                       id="is_admin" 
                                       value="1"
                                       {{ old('is_admin') ? 'checked' : '' }}
                                       class="mt-1 h-4 w-4 text-indigo-600 bg-zinc-700 border-zinc-600 rounded focus:ring-indigo-500 focus:ring-2">
                                <div>
                                    <label for="is_admin" class="text-sm font-semibold text-zinc-300">
                                        Administrator Privileges
                                    </label>
                                    <p class="mt-1 text-xs text-zinc-500">Grants access to admin panel and user management</p>
                                </div>
                            </div>
                            @error('is_admin')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Auto-generated Info Box -->
                        <div class="bg-zinc-700/50 border border-zinc-600/50 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-zinc-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                Account Defaults
                            </h4>
                            <ul class="text-xs text-zinc-400 space-y-1">
                                <li><strong>Name:</strong> "New User" (user can change)</li>
                                <li><strong>Email:</strong> {username}@limelight-robotics.dev</li>
                                <li><strong>Password:</strong> "ChangeMe123!" (must change on first login)</li>
                                <li><strong>Status:</strong> Active and ready to login</li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6">
                            <a href="{{ route('admin.users.index') }}" 
                               class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-zinc-600 hover:bg-zinc-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Create User Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
