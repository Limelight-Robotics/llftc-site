<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('team')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('admin.users.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|regex:/^[a-zA-Z0-9_-]+$/|unique:users,email',
            'team_id' => 'nullable|exists:teams,id',
            'is_admin' => 'boolean',
        ], [
            'username.regex' => 'Username can only contain letters, numbers, underscores, and hyphens.',
            'username.unique' => 'This username is already taken.',
        ]);

        // Generate email from username
        $domain = str_replace(['http://', 'https://', '/', ':'], '', config('app.url'));
        // Handle localhost case by adding .local suffix
        if ($domain === 'localhost' || strpos($domain, 'localhost') === 0) {
            $domain = 'localhost.local';
        }
        $email = $request->username . '@' . $domain;

        // Check if the generated email already exists
        if (User::where('email', $email)->exists()) {
            return back()->withErrors(['username' => 'This username is already taken.'])->withInput();
        }

        User::create([
            'name' => 'New User', // Default name that user can change
            'email' => $email,
            'password' => Hash::make('ChangeMe123!'), // Default password they must change
            'team_id' => $request->team_id,
            'is_admin' => $request->boolean('is_admin'),
            'email_verified_at' => now(), // Auto-verify since admin created
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User account created successfully! Login credentials: ' . $email . ' / ChangeMe123!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $teams = Team::all();
        return view('admin.users.edit', compact('user', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'team_id' => 'nullable|exists:teams,id',
            'is_admin' => 'boolean',
        ]);

        $user->update([
            'team_id' => $request->team_id,
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
