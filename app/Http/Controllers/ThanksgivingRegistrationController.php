<?php

namespace App\Http\Controllers;

use App\Models\ThanksgivingRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ThanksgivingRegistrationController extends Controller
{
    public function create()
    {
        // Calculate the current quarter dynamically (e.g., 'Q3 2026')
        $now = Carbon::now();
        $quarter = 'Q' . ceil($now->month / 3) . ' ' . $now->year; 

        return view('thanksgiving.create', compact('quarter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:individual,family',
            'display_name' => 'required|string|max:255',
            'quarter' => 'required|string',
            // Validate that family_members is an array, and each item is a string
            'family_members' => 'nullable|array',
            'family_members.*' => 'nullable|string|max:255',
        ]);

        // Clean up the array to remove any empty inputs the user might have left blank
        $familyMembers = null;
        if ($request->type === 'family' && $request->has('family_members')) {
            $familyMembers = array_filter($request->family_members, function($value) {
                return !is_null($value) && $value !== '';
            });
            // Re-index the array so it saves cleanly in JSON
            $familyMembers = array_values($familyMembers);
        }

        ThanksgivingRegistration::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'display_name' => $request->display_name,
            'family_members' => $familyMembers, // Laravel casts this to JSON automatically!
            'quarter' => $request->quarter,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your Thanksgiving Registration for ' . $request->quarter . ' has been submitted!');
    }
}