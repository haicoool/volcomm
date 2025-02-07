<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Opportunity;
use App\Models\Volunteer;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\RegistrationNotification;

class VolunteerController extends Controller
{
    public function showRegistrationForm()
    {
        return view('volunteer.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'vName' => 'required|string|max:255',
            'vEmail' => 'required|email|unique:volunteers',
            'vPass' => 'required|min:6|confirmed',
            'vSkill' => 'nullable|string',
            'vProfilepic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vQualification.*' => 'nullable|file|mimes:pdf,doc,docx,zip,jpeg,png,jpg,gif|max:5000',
        ]);

        // Handle profile picture upload
        $profilePicPath = null;
        if ($request->hasFile('vProfilepic')) {
            $profilePicPath = $request->file('vProfilepic')->store('volunteer/profilepics', 'public');
        }

        // Handle qualifications upload
        $qualificationPaths = [];
        if ($request->hasFile('vQualification')) {
            foreach ($request->file('vQualification') as $file) {
                $qualificationPaths[] = $file->store('volunteer/qualifications', 'public');
            }
        }

        // Create new volunteer
        $volunteer = new Volunteer();
        $volunteer->vName = $request->vName;
        $volunteer->vEmail = $request->vEmail;
        $volunteer->vPass = Hash::make($request->vPass);
        $volunteer->vSkill = $request->vSkill;
        $volunteer->vProfilepic = $profilePicPath;
        $volunteer->vQualification = json_encode($qualificationPaths);
        $volunteer->save();

        // Log in the volunteer
        Auth::login($volunteer);

        // Redirect to interest selection page
        return redirect()->route('volunteer.interest');
    }

    public function showInterestForm()
    {
        return view('volunteer.interest'); // Ensure this matches the filename of your view
    }

    public function updateInterest(Request $request)
    {
        $request->validate([
            'interests' => 'required|array',
            'interests.*' => 'string',
        ]);

        // Update the volunteer's interests
        $volunteer = Auth::user(); // Get the authenticated volunteer
        $volunteer->interest = json_encode($request->interests);
        $volunteer->save();

        return redirect()->route('volunteer.dashboard');
    }



    public function showLoginForm()
    {
        return view('volunteer.login');
    }

    public function login(Request $request)
    {
        // Validate login data
        $request->validate([
            'vEmail' => 'required|email',
            'vPass' => 'required|min:6',
        ]);

        // Attempt to authenticate the volunteer
        $volunteer = Volunteer::where('vEmail', $request->vEmail)->first();

        if ($volunteer && Hash::check($request->vPass, $volunteer->vPass)) {
            // Log in the volunteer
            Auth::login($volunteer);

            // Redirect to the dashboard
            return redirect()->route('volunteer.dashboard');
        }

        return back()->withErrors([
            'vEmail' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('vPass'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('volunteer.login');
    }



    public function registerForOpportunity(Request $request, $opportunityId)
    {
        // Find the opportunity or fail with a 404 error
        $opportunity = Opportunity::findOrFail($opportunityId);

        // Get the authenticated volunteer
        $volunteer = Auth::user(); // This fetches the logged-in volunteer

        // Check if the opportunity has reached max capacit
        if ($opportunity->currentReg >= $opportunity->maxCapacity) {
            return redirect()->back()->with('error', 'This opportunity has reached its maximum capacity.');
        }

        // Check if the volunteer is already registered for this opportunity
        $existingRegistration = Registration::where('vId', $volunteer->vId)
            ->where('oppId', $opportunityId)
            ->first();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'You are already registered for this opportunity.');
        }

        // Determine registration status based on qualifications
        $status = $opportunity->reqQualification ? 'pending' : 'registered';

        // Capture selected qualification if needed
        $selectedQualification = $request->input('vQualification');

        // Prepare registration data
        $registrationData = [
            'vId' => $volunteer->vId,
            'vName' => $volunteer->vName,
            'vSkill' => $volunteer->vSkill,
            'oppId' => $opportunityId,
            'status' => $status,
            'vQualification' => $opportunity->reqQualification ? json_encode($selectedQualification) : null,
        ];

        // Create registration record
        Registration::create($registrationData);

        // Increment the current registration count if status is 'registered'
        if ($status === 'registered') {
            $opportunity->increment('currentReg');
            // Send email to volunteer
            Mail::to($volunteer->vEmail)->send(new RegistrationNotification($opportunity, 'approved'));
        }

        // Set success message
        $message = $status === 'registered'
            ? ['type' => 'success', 'text' => 'Successfully registered for the opportunity.']
            : ['type' => 'pending', 'text' => 'Registration successful. You will receive a confirmation email if approved.'];

        return redirect()->route('opportunities.show', $opportunityId)->with('message', $message);
    }

    public function editProfile()
    {
        $volunteer = Auth::user(); // Get the currently authenticated user
        return view('volunteer.editProfile', compact('volunteer')); // Pass volunteer data to view
    }

    // Update the profile
    // Update Profile
    public function updateProfile(Request $request)
    {
        $volunteer = Auth::user(); // Get the authenticated volunteer

        $request->validate([
            'vName' => 'sometimes|required|string|max:255',
            'vEmail' => 'sometimes|required|email|unique:volunteers,vEmail,' . $volunteer->vId,
            'vSkill' => 'sometimes|required|string',
            'vProfilepic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'currentPassword' => 'required_with:newPassword|current_password', // Validate current password
            'newPassword' => 'nullable|min:6|confirmed', // Validate new password with confirmation
        ]);

        // Update fields if changed
        if ($request->filled('vName')) $volunteer->vName = $request->vName;
        if ($request->filled('vEmail')) $volunteer->vEmail = $request->vEmail;
        if ($request->filled('vSkill')) $volunteer->vSkill = $request->vSkill;

        // Handle profile picture upload
        if ($request->hasFile('vProfilepic')) {
            $volunteer->vProfilepic = $request->file('vProfilepic')->store('volunteer/profilepics', 'public');
        }

        // Update password if new password is provided
        if ($request->filled('newPassword')) {
            $volunteer->vPass = Hash::make($request->newPassword);
        }

        $volunteer->save(); // Save the updated volunteer information

        // Stay on the same page, highlight the profile section
        return view('volunteer.editProfile', [
            'volunteer' => $volunteer,
            'activeSection' => 'profile', // Indicate that the profile section was updated
            'success' => 'Profile updated successfully!',
        ]);
    }

    // Add Qualification
    public function addQualification(Request $request)
    {
        $request->validate([
            'vQualification.*' => 'nullable|file|mimes:pdf,doc,docx,zip,jpeg,png,jpg,gif|max:5000',
        ]);

        $volunteer = Auth::user();
        $qualificationPaths = [];

        if ($request->hasFile('vQualification')) {
            foreach ($request->file('vQualification') as $file) {
                // Generate a random number prefix
                $randomNumber = rand(1000, 9999);
                // Get the original file name
                $originalFileName = $file->getClientOriginalName();
                // Create a new file name with the random prefix
                $newFileName = $randomNumber . '-' . $originalFileName;
                // Store the file and get the path
                $path = $file->storeAs('volunteer/qualifications', $newFileName, 'public');
                $qualificationPaths[] = $path;
            }

            // Merge old qualifications with new ones
            $existingQualifications = $volunteer->vQualification ? json_decode($volunteer->vQualification, true) : [];
            $volunteer->vQualification = json_encode(array_merge($existingQualifications, $qualificationPaths));
        }

        $volunteer->save(); // Save the updated volunteer information

        return view('volunteer.editProfile', [
            'volunteer' => $volunteer,
            'activeSection' => 'qualifications', // Indicate that the qualifications section was updated
            'success' => 'Qualifications added successfully!',
        ]);
    }

    // Remove Qualification
    public function removeQualification(Request $request)
    {
        $qualification = $request->input('qualification');
        $volunteer = Auth::user();
        $qualifications = json_decode($volunteer->vQualification, true);

        // Remove the qualification
        if (($key = array_search($qualification, $qualifications)) !== false) {
            unset($qualifications[$key]);

            // Full file path to delete the file
            $filePath = 'storage/' . $qualification;
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Save the updated qualifications list
            $volunteer->vQualification = json_encode(array_values($qualifications));
            $volunteer->save();
        }

        return view('volunteer.editProfile', [
            'volunteer' => $volunteer,
            'activeSection' => 'qualifications',
            'success' => 'Qualification removed successfully.',
        ]);
    }


    // Update Interests
    public function updateInterests(Request $request)
    {
        $request->validate([
            'interests' => 'required|array',
            'interests.*' => 'string',
        ]);

        $volunteer = Auth::user();
        $volunteer->interest = json_encode($request->input('interests'));
        $volunteer->save();

        // Stay on the same page, highlight the interests section
        return view('volunteer.editProfile', [
            'volunteer' => $volunteer,
            'activeSection' => 'interests', // Indicate that the interests section was updated
            'success' => 'Interests updated successfully!',
        ]);
    }

    public function viewHistory()
    {
        // Get the authenticated volunteer
        $volunteer = auth()->user();

        // Retrieve registrations for the authenticated volunteer
        $registrations = DB::table('registrations')
            ->join('opportunities', 'registrations.oppId', '=', 'opportunities.oppId')
            ->where('registrations.vId', $volunteer->vId)
            ->whereIn('registrations.status', ['registered', 'attended', 'pending'])
            ->select(
                'registrations.regId',
                'registrations.status',
                'opportunities.oppTitle',
                'opportunities.oppDate'
            )
            ->get();

        // Pass the registrations to the view
        return view('volunteer.history', compact('registrations'));
    }

}
