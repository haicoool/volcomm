<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opportunity;
use App\Models\Registration;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // Display opportunities for the current organization
    public function confirmAttendance(Request $request)
    {
        $organizationId = auth()->user()->organizationId; // Get the logged-in organization's ID

        // Fetch opportunities where at least one registration has 'registered' status
        $opportunities = Opportunity::where('organizationId', $organizationId)
            ->whereIn('oppId', function ($query) {
                $query->select('oppId')
                    ->from('registrations')
                    ->where('status', 'registered'); // Change from 'Pending' to 'registered'
            })
            ->get();

        return view('organization.opportunities', compact('opportunities'));
    }

    // Show registrations for a selected opportunity
    public function showRegistrations($oppId)
    {
        // Retrieve registrations where the oppId matches and status is 'registered'
        $registrations = Registration::where('oppId', $oppId)
            ->where('status', 'registered')
            ->get();

        return view('organization.registrations', compact('registrations', 'oppId'));
    }

    // Store attendance records
    public function storeAttendance(Request $request)
    {
        $validated = $request->validate([
            'registrations' => 'required|array',
            'oppId' => 'required|integer',
        ]);

        foreach ($validated['registrations'] as $regId) {
            // Create attendance record
            Attendance::create([
                'regId' => $regId,
                'oppId' => $validated['oppId'],
            ]);

            // Update the registration status to 'attended'
            Registration::where('regId', $regId)->update(['status' => 'attended']);
        }

        return redirect()->route('attendance.confirm')->with('success', 'Attendance confirmed successfully!');
    }

}
