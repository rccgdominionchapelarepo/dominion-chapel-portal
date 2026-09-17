<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate based on whether they checked anonymous
        $request->validate([
            'is_anonymous' => 'nullable',
            'name'         => 'required_without:is_anonymous|nullable|string|max:255',
            'email'        => 'required_without:is_anonymous|nullable|email|max:255',
            'phone'        => 'nullable|string|max:20',
            'subject'      => 'required|string|max:255',
            'message'      => 'required|string|max:2000',
        ]);

        // 2. Prepare the data array
        $data = $request->only(['subject', 'message']);

        // 3. Check for anonymity
        if ($request->has('is_anonymous')) {
            $data['name']  = 'Anonymous';
            $data['email'] = 'hidden@anonymous.local'; // Dummy email for the DB
            $data['phone'] = 'Hidden';
        } else {
            $data['name']  = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
        }

        // 4. Save to database
        Inquiry::create($data);

        return back()->with('success', 'Thank you for reaching out! We have received your message and will get back to you shortly.');
    }
}