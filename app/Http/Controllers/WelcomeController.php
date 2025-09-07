<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        
        // Get recent entries with their teams
        $recentEntries = Entry::with('team')
            ->latest()
            ->take(6)
            ->get();
        
        return view('welcome', compact('recentEntries'));
    }
}
