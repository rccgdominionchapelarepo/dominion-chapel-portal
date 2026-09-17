<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SermonController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        $sermons = Sermon::latest('date')->paginate(10);
        return view('admin.sermons.index', compact('sermons'));
    }

    public function create()
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        return view('admin.sermons.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);

        $request->validate([
            'type' => 'required|in:sermon,blog',
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'document' => 'nullable|mimes:pdf,ppt,pptx,doc,docx|max:10240', // 10MB max for slides
            'content' => 'nullable|string',
            'quotes' => 'nullable|array',
            'quotes.*' => 'nullable|string|max:1000',
        ]);

        // Upload Image
        $imagePath = $request->file('image')->store('sermons/images', 'public');

        // Upload Document (if provided)
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('sermons/documents', 'public');
        }

        // Clean up empty quotes
        $quotes = null;
        if ($request->has('quotes')) {
            $quotes = array_values(array_filter($request->input('quotes', []), function ($value) {
                return !is_null($value) && $value !== '';
            }));
        }

        Sermon::create([
            'type' => $request->type,
            'title' => $request->title,
            'speaker' => $request->speaker,
            'date' => $request->date,
            'image_path' => $imagePath,
            'document_path' => $documentPath,
            'content' => $request->input('content'),
            'quotes' => $quotes,
        ]);

        return redirect()->route('admin.sermons.index')->with('success', 'Blog published successfully!');
    }
    public function destroy(Sermon $sermon)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);

        // Delete the image from the server
        if ($sermon->image_path) {
            Storage::disk('public')->delete($sermon->image_path);
        }

        // Delete the presentation document if it exists
        if ($sermon->document_path) {
            Storage::disk('public')->delete($sermon->document_path);
        }

        // Delete the database record
        $sermon->delete();

        return redirect()->route('admin.sermons.index')->with('success', 'Blog and attached files were deleted successfully!');
    }
}