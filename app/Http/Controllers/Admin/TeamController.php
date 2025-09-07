<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::withCount(['users', 'entries'])->get();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
        ]);

        Team::create($request->only('name'));

        return redirect()->route('admin.teams.index')->with('success', 'Team created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
        ]);

        $team->update($request->only('name'));

        return redirect()->route('admin.teams.index')->with('success', 'Team updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Get the "Uncategorized" team
        $uncategorizedTeam = Team::where('name', 'Uncategorized')->first();

        if (!$uncategorizedTeam) {
            return redirect()
                ->route('admin.teams.index')
                ->with('error', 'Cannot delete team: Uncategorized team not found.');
        }

        if ($team->name === 'Uncategorized') {
            return redirect()->route('admin.teams.index')->with('error', 'Cannot delete the Uncategorized team.');
        }

        // Reassign all entries to Uncategorized team
        Entry::where('team_id', $team->id)->update(['team_id' => $uncategorizedTeam->id]);

        // Remove team association from users
        $team->users()->update(['team_id' => null]);

        $team->delete();

        return redirect()
            ->route('admin.teams.index')
            ->with('success', 'Team deleted successfully! Entries have been moved to Uncategorized.');
    }
}
