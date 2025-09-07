<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = Entry::with(['user', 'team'])->latest()->paginate(10);

        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('entries.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
        ];

        // Non-admins use their own team_id, admins can choose any team
        if (auth()->user()->is_admin && $request->team_id) {
            $data['team_id'] = $request->team_id;
        } else {
            $data['team_id'] = auth()->user()->team_id ?? Team::where('name', 'Uncategorized')->first()->id;
        }

        Entry::create($data);

        return redirect()->route('entries.index')->with('success', 'Entry created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        $entry->load(['user', 'team']);
        return view('entries.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entry $entry)
    {
        $this->authorize('update', $entry);
        $teams = Team::all();
        return view('entries.edit', compact('entry', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        $this->authorize('update', $entry);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
        ];

        // Non-admins use their own team_id, admins can choose any team
        if (auth()->user()->is_admin && $request->team_id) {
            $data['team_id'] = $request->team_id;
        } else {
            $data['team_id'] = auth()->user()->team_id ?? Team::where('name', 'Uncategorized')->first()->id;
        }

        $entry->update($data);

        return redirect()->route('entries.show', $entry)->with('success', 'Entry updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        $this->authorize('delete', $entry);
        $entry->delete();

        return redirect()->route('entries.index')->with('success', 'Entry deleted successfully!');
    }
}
