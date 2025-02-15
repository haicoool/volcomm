<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Opportunity;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Mail\RegistrationStatusMail;
use Illuminate\Support\Facades\Mail;

class OrganizationController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('organization.register');
    }

    // Register the organization
    public function register(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'organizationName' => 'required|string|max:255',
            'organizationEmail' => 'required|email|unique:organizations,organizationEmail',
            'organizationPass' => [
                'required',
                'confirmed',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};:\'"\\|,.<>\/?]).+$/',
            ],
            'organizationAbout' => 'nullable|string|max:1000',
        ], [
            'organizationPass.regex' => 'The password must contain at least one uppercase letter, one number, and one symbol.',
        ]);

        // Create the organization in the database
        Organization::create([
            'organizationName' => $validated['organizationName'],
            'organizationEmail' => $validated['organizationEmail'],
            'organizationPass' => Hash::make($validated['organizationPass']),  // Hash the password
            'organizationAbout' => $validated['organizationAbout'],
            'isApproved' => 0, // Set default value
        ]);

        // Redirect with a success message indicating the registration is under review
        return redirect()->back()->with('warning', 'Registration submitted for review.');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('organization.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the login inputs
        $request->validate([
            'organizationEmail' => 'required|email',
            'organizationPass' => 'required|min:6',
        ]);

        // Prepare credentials for Auth::attempt()
        $credentials = [
            'organizationEmail' => $request->organizationEmail,
            'password' => $request->organizationPass,  // Laravel expects 'password' field for hashing
        ];

        // Attempt to log the organization in using the organization guard
        if (Auth::guard('organization')->attempt($credentials)) {
            $organization = Auth::guard('organization')->user();

            // Check the approval status
            if ($organization->isApproved == 2) {
                return back()->withErrors([
                    'organizationEmail' => 'Your registration has been rejected. Please contact admin.',
                ])->withInput($request->except('organizationPass'));
            } elseif ($organization->isApproved == 0) {
                return back()->withErrors([
                    'organizationEmail' => 'Your registration is under review.',
                ])->withInput($request->except('organizationPass'));
            }

            // Proceed to dashboard if approved
            return redirect()->route('organization.dashboard');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'organizationEmail' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('organizationPass'));
    }

    // Show organization dashboard
    public function showDashboard(Request $request)
    {
        // Get the authenticated organization
        $organization = Auth::guard('organization')->user();

        // Build the query for opportunities
        $query = Opportunity::where('organizationId', $organization->organizationId);

        // Apply search filter (if provided)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('oppTitle', 'like', '%' . $request->search . '%')
                    ->orWhere('oppDesc', 'like', '%' . $request->search . '%')
                    ->orWhere('oppLocation', 'like', '%' . $request->search . '%');
            });
        }

        // Apply sort filter (if provided)
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereDate('oppDate', '>=', now()); // Active: Today or future dates
            } elseif ($request->status === 'expired') {
                $query->whereDate('oppDate', '<', now()); // Expired: Past dates
            }
        }

        // Paginate the results (3 per page)
        $opportunities = $query->paginate(3);

        // Return the dashboard view
        return view('organization.dashboard', compact('organization', 'opportunities'));
    }


    // View opportunities
    public function viewOpportunities()
    {
        $organization = Auth::guard('organization')->user();
        $opportunities = Opportunity::where('organizationId', $organization->organizationId)->get();

        return view('organization.dashboard', compact('organization', 'opportunities'));
    }

    // Show create opportunity form
    public function createOpportunity()
    {
        return view('organization.create-opportunity');
    }

    // Store the new opportunity
    public function storeOpportunity(Request $request)
    {
        $organizationId = Auth::guard('organization')->id();

        // Validate the input
        $validated = $request->validate([
            'oppTitle' => 'required|string|max:255',
            'oppDesc' => 'required|string',
            'oppLocation' => 'required|string|max:255',
            'oppDate' => 'required|date',
            'oppTime' => 'required',
            'reqSkill' => 'required|string|max:255',
            'oppImage' => 'nullable|image|max:2048', // Ensure it is an image and max size of 2MB
            'maxCapacity' => 'required|integer|min:1', // Validate maxCapacity as an integer greater than or equal to 1
            'reqQualification' => 'required|boolean', // Validate reqQualification as a boolean (1 for Yes, 0 for No)
            'category' => 'required|string|max:255', // Validate category as a required string
        ]);

        // Handle the file upload if provided
        if ($request->hasFile('oppImage')) {
            $imagePath = $request->file('oppImage')->store('opportunities', 's3');
        } else {
            $imagePath = null;
        }


        // Create the opportunity in the database
        Opportunity::create([
            'organizationId' => $organizationId,
            'oppTitle' => $validated['oppTitle'],
            'oppDesc' => $validated['oppDesc'],
            'oppLocation' => $validated['oppLocation'],
            'oppDate' => $validated['oppDate'],
            'oppTime' => $validated['oppTime'],
            'reqSkill' => $validated['reqSkill'],
            'oppImage' => $imagePath,
            'maxCapacity' => $validated['maxCapacity'], // Store maxCapacity
            'reqQualification' => $validated['reqQualification'], // Store reqQualification
            'category' => $validated['category'], // Store category
        ]);

        // Redirect back to opportunities page with success message
        return redirect()->route('organization.dashboard')->with('success', 'Opportunity created successfully!');
    }


    // Show validate registration page
    public function validateRegistration()
    {
        // Fetch registrations whose status is 'pending'
        $pendingRegistrations = Registration::where('status', 'pending')
            ->get()
            ->map(function ($registration) {
                $registration->qualifications = json_decode($registration->vQualification, true) ?: []; // Ensure qualifications are an array
                return $registration;
            });

        // Return view with the pending registrations
        return view('organization.validate-registration', compact('pendingRegistrations'));
    }

    public function approveRegistration($regId)
    {
        $registration = Registration::findOrFail($regId);
        $volunteer = $registration->volunteer;
        $opportunity = Opportunity::findOrFail($registration->oppId); // Fetch the opportunity

        try {
            $registration->status = 'registered';
            $registration->save();
            Log::info("Registration status updated to 'registered' for ID: $regId");

            // Send approval email
            Mail::to($volunteer->vEmail)->send(new RegistrationStatusMail('approved', $volunteer->vName, $opportunity->oppTitle));
            Log::info("Approval email sent to: " . $volunteer->vEmail);

        } catch (\Exception $e) {
            Log::error("Error sending approval email: " . $e->getMessage());
        }

        return redirect()->route('organization.validate-registration')->with('success', 'Registration approved successfully.');
    }

    public function rejectRegistration($regId)
    {
        $registration = Registration::findOrFail($regId);
        $volunteer = $registration->volunteer;
        $opportunity = Opportunity::findOrFail($registration->oppId); // Fetch the opportunity

        try {
            $registration->status = 'rejected';
            $registration->save();
            Log::info("Registration status updated to 'rejected' for ID: $regId");

            // Send rejection email
            Mail::to($volunteer->vEmail)->send(new RegistrationStatusMail('rejected', $volunteer->vName, $opportunity->oppTitle));
            Log::info("Rejection email sent to: " . $volunteer->vEmail);

        } catch (\Exception $e) {
            Log::error("Error sending rejection email: " . $e->getMessage());
        }

        return redirect()->route('organization.validate-registration')->with('success', 'Registration rejected successfully.');
    }

    public function editProfile()
    {
        $organization = Auth::guard('organization')->user();
        return view('organization.edit-profile', compact('organization'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $organization = Auth::guard('organization')->user();
        $organizationId = $organization->organizationId;

        // Validate input
        $request->validate([
            'organizationName' => 'required|string|max:255',
            'organizationEmail' => 'required|email|max:255',
            'organizationAbout' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed', // Password is optional, but must be at least 8 characters if present
        ]);

        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            // Store the logo in the 'logos' folder on S3
            $organization->logo = $request->file('logo')->store('logos', 's3'); // Save path on S3
        }


        // Save changes to organization
        $organization->save();

        // Update the organization's password if provided
        if ($request->filled('password')) {
            $organization->organizationPass = Hash::make($request->input('password'));
        }

        // Update other fields
        $organization->update([
            'organizationName' => $request->input('organizationName'),
            'organizationEmail' => $request->input('organizationEmail'),
            'organizationAbout' => $request->input('organizationAbout'),
        ]);

        return redirect()->route('organization.dashboard')->with('success', 'Profile updated successfully.');
    }

    // Logout the organization
    public function logout()
    {
        Auth::guard('organization')->logout();
        return redirect()->route('organization.login')->with('success', 'Logged out successfully!');
    }

    // Handle Forgot Password Request
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:organizations,organizationEmail']);

        // Generate Token & Save in Password Reset Table
        $token = Str::random(64);
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Generate Reset Link
        $resetLink = route('organization.reset-password', ['token' => $token, 'email' => $request->email]);

        // For now, show the reset link instead of sending an email
        return back()->with('status', "Click here to reset your password: <a href='$resetLink' class='text-blue-500'>$resetLink</a>");
    }

    // Show Reset Password Form
    public function showResetPasswordForm($token)
    {
        return view('organization.reset-password', compact('token'));
    }

    // Handle Password Reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:organizations,organizationEmail',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        // Find token
        $reset = \DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid or expired token.']);
        }

        // Update Organization Password
        $organization = Organization::where('organizationEmail', $request->email)->first();
        $organization->password = Hash::make($request->password);
        $organization->save();

        // Delete Token
        \DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('organization.login')->with('success', 'Password reset successful! Please login.');
    }


}
