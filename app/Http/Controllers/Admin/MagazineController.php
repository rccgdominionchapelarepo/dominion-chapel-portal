<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagazineController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        $magazines = Magazine::latest()->paginate(10);
        return view('admin.magazines.index', compact('magazines'));
    }

    public function create()
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        return view('admin.magazines.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'edition' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB for cover
            'file' => 'required|mimes:pdf|max:120000', // Max 100MB for Magazine PDF
        ]);

        // Upload Cover Image locally to storage/app/public/magazines/covers
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('magazines/covers', 'public');
        }

        // Upload PDF Document locally to storage/app/public/magazines/files
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('magazines/files', 'public');
        }

        Magazine::create([
            'title' => $request->title,
            'edition' => $request->edition,
            'cover_image' => $coverPath,
            'file_path' => $filePath,
            'is_published' => true,
        ]);

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine published successfully!');
    }

    public function destroy(Magazine $magazine)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);

        // Delete the cover image from the local public disk
        if ($magazine->cover_image) {
            Storage::disk('public')->delete($magazine->cover_image);
        }

        // Delete the PDF document from the local public disk
        if ($magazine->file_path) {
            Storage::disk('public')->delete($magazine->file_path);
        }

        // Delete the database record
        $magazine->delete();

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine and attached files were deleted successfully!');
    }
}