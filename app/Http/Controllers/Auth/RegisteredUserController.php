<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate the incoming request, including the new fields
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'whatsapp_number' => ['required', 'string', 'max:20', 'unique:'.User::class],
        'date_of_birth' => ['nullable', 'date', 'before:today'], // Ensures they can't pick a future date
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
    ]);

    // --- Clean and Format the WhatsApp Number ---
    $formattedNumber = $request->whatsapp_number;
    
    // 1. Remove any spaces, dashes, or brackets the user might have typed
    $formattedNumber = preg_replace('/[^0-9+]/', '', $formattedNumber);

    // 2. If it starts with a '0' (e.g., 0813...), replace the '0' with '+234'
    if (str_starts_with($formattedNumber, '0')) {
        $formattedNumber = '+234' . substr($formattedNumber, 1);
    } 
    // 3. If it starts with '234' but misses the '+', add it
    elseif (str_starts_with($formattedNumber, '234')) {
        $formattedNumber = '+' . $formattedNumber;
    }
    // 4. If they just typed '813...' without 0 or 234, prepend +234
    elseif (!str_starts_with($formattedNumber, '+')) {
        $formattedNumber = '+234' . $formattedNumber;
    }

    // 2. Create the user with all the validated data
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'whatsapp_number' => $formattedNumber, // Save the cleaned and formatted number
        'date_of_birth' => $request->date_of_birth,
        'password' => Hash::make($request->password),
    ]);

    // ASSIGN DEFAULT ROLE HERE
    $user->assignRole('member');

    // 3. Trigger the registered event and log them in
    event(new Registered($user));

    Auth::login($user);

    // 4. Redirect them to the dashboard
    return redirect(route('dashboard', absolute: false));
    }
}
