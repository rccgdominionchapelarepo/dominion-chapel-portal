<?php

namespace App\Http\Controllers;

use App\Models\ChurchFamily;
use Illuminate\Http\Request;

class MembershipFormController extends Controller
{
    public function create()
    {
        return view('public.membership-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'members' => 'required|array|min:1',
            'members.*.full_name' => 'required|string|max:255',
            'members.*.church_group' => 'required|string',
        ]);

        $family = ChurchFamily::create([
            'family_name' => $request->family_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'home_address' => $request->home_address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
        ]);

        foreach ($request->members as $memberData) {
            // Ensure arrays (like checkboxes) are cast correctly
            $memberData['areas_to_serve'] = isset($memberData['areas_to_serve']) ? json_encode($memberData['areas_to_serve']) : null;
            $family->members()->create($memberData);
        }

        return back()->with('success', 'Thank you! Your membership details have been securely submitted.');
    }
}