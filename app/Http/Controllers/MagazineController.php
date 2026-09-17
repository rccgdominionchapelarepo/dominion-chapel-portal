<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        // Fetch only published magazines, ordered by newest first
        $magazines = Magazine::where('is_published', true)->latest()->paginate(12);
        
        return view('magazines.index', compact('magazines'));
    }
}