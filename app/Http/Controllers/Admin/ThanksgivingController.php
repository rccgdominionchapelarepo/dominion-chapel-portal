<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThanksgivingRegistration;
use Illuminate\Http\Request;

class ThanksgivingController extends Controller
{
    public function index(Request $request)
    {
        // SECURITY: Only super-admins and admins can view this
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403, 'Unauthorized access.');

        $search = $request->input('search');

        // Query the registrations
        $registrations = ThanksgivingRegistration::with('user')
            ->when($search, function ($query, $search) {
                $query->where('display_name', 'like', "%{$search}%")
                      ->orWhere('quarter', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // Calculate Headcount & Total Families
        $allRegistrations = ThanksgivingRegistration::all();
        $totalFamilies = $allRegistrations->count(); // Each row represents one family unit    

        // Calculate Headcount for the current view
        $totalHeadcount = 0;
        foreach (ThanksgivingRegistration::all() as $reg) {
            if ($reg->type === 'individual') {
                $totalHeadcount += 1;
            } elseif ($reg->type === 'family' && is_array($reg->family_members)) {
                // Count the number of names in the JSON array
                $totalHeadcount += count($reg->family_members);
            }
        }

        return view('admin.thanksgiving.index', compact('registrations', 'search', 'totalHeadcount', 'totalFamilies'));
    }
    public function export(Request $request)
    {
        // SECURITY: Only super-admins and admins can export
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403, 'Unauthorized access.');

        // Get all registrations (or filter them if you prefer)
        $registrations = ThanksgivingRegistration::latest()->get();

        $filename = "Thanksgiving_List_" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // The columns for our Excel sheet
        $columns = ['Family Name', 'Quarter', 'Type', 'Total Attendees'];

        $callback = function() use($registrations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Write the header row

            foreach ($registrations as $reg) {
                // 1. Format the Name (Universal Family Rule)
                $rawName = trim($reg->display_name);
                
                // If they didn't type the word "Family", add it automatically
                if (stripos($rawName, 'family') === false) {
                    $formattedName = ucwords($rawName) . " Family";
                } else {
                    // If they already typed "The Adebayo Family", leave it alone
                    $formattedName = ucwords($rawName);
                }

                // 2. Calculate total attendees for this row
                $attendees = 1;
                if ($reg->type === 'family' && is_array($reg->family_members)) {
                    $attendees = count($reg->family_members);
                }

                // 3. Write the row to the Excel/CSV file
                fputcsv($file, [
                    $formattedName, 
                    $reg->quarter,
                    ucfirst($reg->type),
                    $attendees
                ]);
            }

            fclose($file);
        };

        // Stream the file directly to the browser for download
        return response()->stream($callback, 200, $headers);
    }
}