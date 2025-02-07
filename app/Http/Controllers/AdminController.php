<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Volunteer;
use App\Models\Organization;
use App\Models\Opportunity;

class AdminController extends Controller
{
    public function __construct()
    {
        // Apply the 'auth:admin' middleware to all methods except the ones specified
        $this->middleware('auth:admin')->except(['showLoginForm', 'login', 'showRegisterForm', 'register']);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'adminEmail' => 'required|email',
            'adminPass' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt(['adminEmail' => $request->adminEmail, 'password' => $request->adminPass])) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['adminEmail' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $volunteerCount = Volunteer::count();
        $organizationCount = Organization::where('isApproved', 1)->count();
        $waitingApprovalCount = Organization::where('isApproved', 0)->count(); // Count organizations waiting for approval
        $recentVolunteers = Volunteer::where('created_at', '>=', now()->subWeek())->count();
        $recentOrganizations = Organization::where('created_at', '>=', now()->subWeek())->count();

        return view('admin.dashboard', compact('volunteerCount', 'organizationCount', 'waitingApprovalCount', 'recentVolunteers', 'recentOrganizations'));
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'adminName' => 'required|string|max:255',
            'adminEmail' => 'required|email|unique:admins,adminEmail',
            'adminPass' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'adminName' => $request->adminName,
            'adminEmail' => $request->adminEmail,
            'adminPass' => Hash::make($request->adminPass),
        ]);

        if ($admin) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['error' => 'Failed to register admin.']);
        }
    }

    public function showAddAdminForm()
    {
        return view('admin.add-admin');
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'adminName' => 'required|string|max:255',
            'adminEmail' => 'required|email|unique:admins,adminEmail',
            'adminPass' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'adminName' => $request->adminName,
            'adminEmail' => $request->adminEmail,
            'adminPass' => Hash::make($request->adminPass),
        ]);

        if ($admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Admin added successfully.');
        } else {
            return back()->withErrors(['error' => 'Failed to add admin.']);
        }
    }

    public function indexVolunteers()
    {
        $volunteers = Volunteer::all(); // Ensure you have a Volunteer model
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function showVolunteer($vId)
    {
        $volunteer = Volunteer::where('vId', $vId)->firstOrFail();
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function terminateVolunteer($vId)
    {
        $volunteer = Volunteer::where('vId', $vId)->firstOrFail();
        $volunteer->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.volunteers.index')->with('success', 'Volunteer account terminated.');
    }

    public function indexOrganizations()
    {
        $organizations = Organization::where('isApproved', 1)->get(); // Fetch only organizations with isApproved = 1
        return view('admin.organizations.index', compact('organizations'));
    }

    public function showOrganization($id)
    {
        $organization = Organization::findOrFail($id);
        return view('admin.organizations.show', compact('organization'));
    }

    public function terminateOrganization($id)
    {
        // Find the organization by its ID
        $organization = Organization::find($id);

        // If the organization is not found, redirect with an error message
        if (!$organization) {
            return redirect()->route('admin.organizations.index')->with('error', 'Organization not found.');
        }

        // Permanently delete the organization (hard delete)
        $organization->delete();

        // Redirect back with a success message
        return redirect()->route('admin.organizations.index')->with('success', 'Organization terminated successfully.');
    }

    public function showApprovedOrganizations()
    {
        $organizations = Organization::where('isApproved', 0)->get(); // Fetch organizations with isAccepted = 0
        return view('admin.approve_organization', compact('organizations'));
    }

    public function acceptOrganization($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->isApproved = 1; // Set isApproved to 1
        $organization->save();

        return redirect()->route('admin.approved.organizations')->with('success', 'Organization accepted successfully.');
    }

    public function rejectOrganization($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->isApproved = 2; // Set isApproved to 2
        $organization->save();

        return redirect()->route('admin.approved.organizations')->with('success', 'Organization rejected successfully.');
    }

    public function manageAdmins()
    {
        $admins = Admin::where('adminEmail', '!=', 'admin@volcomm.com')->get();
        return view('admin.manage-admin', compact('admins'));
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id); // Fetch the admin by ID
        return view('admin.edit', compact('admin')); // Return the edit view with the admin data
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id); // Fetch the admin by ID
        $admin->update($request->all()); // Update the admin with the request data
        return redirect()->route('admin.manage')->with('success', 'Admin updated successfully!'); // Redirect back with success message
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id); // Fetch the admin by ID
        $admin->delete(); // Delete the admin
        return redirect()->route('admin.manage')->with('success', 'Admin deleted successfully!'); // Redirect back with success message
    }

    public function indexOpportunities()
    {
        $opportunities = Opportunity::with('organization')->orderBy('created_at', 'desc')->get(); // Eager load organization
        return view('admin.opportunities.index', compact('opportunities'));
    }

    public function editOpportunity($id)
    {
        $opportunity = Opportunity::findOrFail($id);
        return view('admin.opportunities.edit', compact('opportunity'));
    }

    public function updateOpportunity(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other fields as necessary
        ]);

        $opportunity = Opportunity::findOrFail($id);
        $opportunity->update($request->all());

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunity updated successfully!');
    }

    public function deleteOpportunity($id)
    {
        $opportunity = Opportunity::findOrFail($id);
        $opportunity->delete();

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunity deleted successfully!');
    }

    public function viewOpportunity($id)
    {
        $opportunity = Opportunity::findOrFail($id);
        return view('admin.opportunities.view', compact('opportunity'));
        
    }
}
