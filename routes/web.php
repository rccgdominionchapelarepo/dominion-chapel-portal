<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagementController;
use App\Models\Event;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ThanksgivingRegistrationController;
use App\Http\Controllers\Admin\ThanksgivingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\Admin\MagazineController as AdminMagazineController;
use App\Http\Controllers\MagazineController;
use App\Models\User;
use App\Models\Sermon;
use App\Models\Magazine;
use App\Models\Inquiry;      // Adjust if your model is named Contact or Message
use App\Http\Controllers\MembershipFormController;
use App\Http\Controllers\Admin\MembershipController;





// 1. The Home Page
Route::get('/', function () {
    // Fetch the 6 most recent events
    $events = Event::latest()->take(6)->get(); 
    return view('welcome', compact('events'));
})->name('home');

// 2. Public Static Pages
Route::view('/contact', 'contact')->name('contact');
Route::view('/give', 'give')->name('give');
Route::view('/downloads', 'downloads')->name('downloads');

// 3. Contact Form Submission Handling
Route::post('/contact/submit', function (Request $request) {
    // Validate the incoming form data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'type' => 'required|string',
        'message' => 'required|string',
    ]);

    // TODO: We will write the logic to save this to the database and send an email later.

    // Redirect the user back to the contact page with a success message
    return back()->with('success', 'Thank you for reaching out! A minister will contact you shortly.');
})->name('contact.submit');

// --- Your Breeze Auth routes (Dashboard, Profile, etc.) will be down here ---
Route::get('/dashboard', function () {
    $totalUsers = User::count();
    $totalEvents = Event::count();
    $totalSermons = Sermon::count();
    $totalMagazines = Magazine::count();

     // You can also filter these if you only want to count specific statuses
    $totalInquiries = Inquiry::where('is_read', false)->count(); // Example: Unread only
    $totalEvents = Event::count();
    

    return view('dashboard', compact(
        'totalUsers', 
        'totalSermons', 
        'totalMagazines', 
        'totalInquiries', 
        'totalEvents', 
    ));
    return view('dashboard', compact('totalUsers', 'totalEvents', 'totalSermons'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // User Management Routes (Protected by controller logic)
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.update-role');
    Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // Event Management Routes (Protected by controller logic)
    Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::post('/admin/events', [EventController::class, 'store'])->name('admin.events.store');

    Route::get('/admin/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/admin/events/{event}', [EventController::class, 'update'])->name('admin.events.update');

    Route::delete('/admin/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');

    // Thanksgiving Management Routes (Protected by controller logic)
    Route::get('/admin/thanksgiving', [ThanksgivingController::class, 'index'])->name('admin.thanksgiving.index');

    // Export Thanksgiving Registrations to CSV
    Route::get('/admin/thanksgiving/export', [ThanksgivingController::class, 'export'])->name('admin.thanksgiving.export');
    
    Route::get('/admin/thanksgiving', [ThanksgivingController::class, 'index'])->name('admin.thanksgiving.index');

    // Inside your Route::middleware('auth')->group(...)
    Route::resource('admin/magazines', AdminMagazineController::class, ['as' => 'admin']);

    //INQUIRIES: Testimonies/thanksgiving
    Route::get('/admin/inquiries', [InquiryController::class, 'index'])->name('admin.inquiries.index');
    Route::patch('/admin/inquiries/{inquiry}/read', [InquiryController::class, 'markAsRead'])->name('admin.inquiries.read');
    Route::delete('/admin/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('admin.inquiries.destroy');

    // Admin Sermon Routes
    Route::resource('admin/sermons', AdminSermonController::class, ['as' => 'admin']);


    // Membership form and view
    Route::get('/admin/membership', [MembershipController::class, 'index'])->name('admin.membership.index');
    Route::get('/admin/membership/export', [MembershipController::class, 'export'])->name('admin.membership.export');
    Route::get('/admin/membership/{family}', [MembershipController::class, 'show'])->name('admin.membership.show');
    Route::delete('/admin/membership/{family}', [MembershipController::class, 'destroy'])->name('admin.membership.destroy');
});

Route::get('/thanksgiving/register', [ThanksgivingRegistrationController::class, 'create'])->name('thanksgiving.create');
Route::post('/thanksgiving/register', [ThanksgivingRegistrationController::class, 'store'])->name('thanksgiving.store');


Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.store');


// Public Sermon Gallery & Details
Route::get('/messages', [SermonController::class, 'index'])->name('sermons.index');
Route::get('/messages/{sermon}', [SermonController::class, 'show'])->name('sermons.show');


// Public Magazine Downloads
Route::get('/downloads', [MagazineController::class, 'index'])->name('magazines.index');

// Membership Form
Route::get('/membership-update', [MembershipFormController::class, 'create'])->name('membership.form');
Route::post('/membership-update', [MembershipFormController::class, 'store'])->name('membership.store');


require __DIR__.'/auth.php';
