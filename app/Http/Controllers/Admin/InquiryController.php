<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        $subject = $request->input('subject');
        $status = $request->input('status');

        $inquiries = Inquiry::query()
            // Filter by Subject/Type if selected
            ->when($subject, function ($query, $subject) {
                $query->where('subject', $subject);
            })
            // Filter by Read/Unread status if selected
            ->when($status === 'unread', function ($query) {
                $query->where('is_read', false);
            })
            ->when($status === 'read', function ($query) {
                $query->where('is_read', true);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString(); // This ensures pagination remembers your active filters!

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function markAsRead(Inquiry $inquiry)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        $inquiry->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read.');
    }

    public function destroy(Inquiry $inquiry)
    {
        abort_unless(auth()->user()->hasRole('super-admin|admin'), 403);
        
        $inquiry->delete();
        return back()->with('success', 'Message deleted permanently.');
    }
}