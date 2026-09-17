<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    // 1. Displays the gallery grid
    public function index()
    {
        $sermons = Sermon::latest('date')->paginate(12);
        return view('sermons.index', compact('sermons'));
    }

    // 2. Displays the stylish single sermon page with quotes and downloads
    public function show(Sermon $sermon)
    {
        return view('sermons.show', compact('sermon'));
    }
}