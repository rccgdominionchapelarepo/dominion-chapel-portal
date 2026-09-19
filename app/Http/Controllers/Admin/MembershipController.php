<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChurchFamily;
use App\Exports\MembershipExport;
use Maatwebsite\Excel\Facades\Excel;

class MembershipController extends Controller
{
    public function index()
    {
        // Ensure only authorized roles can view this
        abort_unless(auth()->user()->hasRole('super-admin|admin|ushers'), 403);
        
        // Fetch families with their related members, newest first
        $families = ChurchFamily::with('members')->latest()->paginate(15);
        
        return view('admin.membership.index', compact('families'));
    }

    public function show(ChurchFamily $family)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin|ushers'), 403);
        
        return view('admin.membership.show', compact('family'));
    }

    public function export()
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin|ushers'), 403);
        
        return Excel::download(new MembershipExport, 'church_membership_database.xlsx');
    }
}