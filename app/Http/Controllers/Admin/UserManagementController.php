<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    
    public function index(Request $request)
    {
        // SECURITY: Kick out anyone who isn't a super-admin
        abort_unless(auth()->user()->hasRole('super-admin'), 403, 'Unauthorized access.');

        $search = $request->input('search');

        // Query users, applying the search filter if a term exists
        $users = User::with('roles')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('whatsapp_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString(); // Ensures ?search=term stays in the URL when clicking page 2, 3, etc.

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles', 'search'));
    }

    public function updateRole(Request $request, User $user)
    {
        // SECURITY: Kick out anyone who isn't a super-admin
        abort_unless(auth()->user()->hasRole('super-admin'), 403, 'Unauthorized access.');

        // Prevent the logged-in super-admin from accidentally demoting themselves
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        // SyncRoles removes all old roles and assigns the new one
        $user->syncRoles([$request->role]);

        return back()->with('success', "{$user->name}'s role has been updated to {$request->role}.");
    }
    public function destroy(User $user)
    {
        // SECURITY: Kick out anyone who isn't a super-admin
        abort_unless(auth()->user()->hasRole('super-admin'), 403, 'Unauthorized access.');

        // Prevent the logged-in super-admin from accidentally deleting themselves
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User {$userName} has been permanently deleted.");
    }
}