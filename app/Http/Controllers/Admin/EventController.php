<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);

        $search = $request->input('search');

        // Query events, applying the search filter if a term exists
        $events = Event::when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('tag', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6) // Paginate to 6 flyers per page for the highlights section cards
            ->withQueryString();

        return view('admin.events.index', compact('events', 'search'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
        ]);

        // Save the image to the 'public/events' folder
        $imagePath = $request->file('image')->store('events', 'public');

        Event::create([
            'title' => $request->title,
            'tag' => $request->tag,
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Event flyer uploaded successfully!');
    }

    public function edit(Event $event)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:50',
            // Image is sometimes NOT required on update, so it's 'nullable'
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', 
        ]);

        // Default to the old image path
        $imagePath = $event->image_path;

        // If a new image was uploaded...
        if ($request->hasFile('image')) {
            // 1. Delete the old image from storage to save space
            if (Storage::disk('public')->exists($event->image_path)) {
                Storage::disk('public')->delete($event->image_path);
            }
            // 2. Save the new image
            $imagePath = $request->file('image')->store('events', 'public');
        }

        // Update the database record
        $event->update([
            'title' => $request->title,
            'tag' => $request->tag,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        // Delete the physical image file from storage
        if (Storage::disk('public')->exists($event->image_path)) {
            Storage::disk('public')->delete($event->image_path);
        }
        
        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}