<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Registration;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function showPastOpportunities()
    {
        $opportunities = auth()->user()->pastOpportunities()->with('registrations')->get();

        return view('certificates.past_opportunities', compact('opportunities'));
    }

    public function showCertificateForm(Registration $registration)
    {
        // Ensure the registration status is 'attended'
        if ($registration->status !== 'attended') {
            return redirect()->back()->with('error', 'Certificate can only be generated for attended registrations.');
        }

        return view('certificates.certificate_form', compact('registration'));
    }

    public function generateBulkCertificates(Request $request)
    {
        // Validate the form input
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signerName' => 'required|string|max:255',
            'signerPosition' => 'required|string|max:255',
        ]);

        // Store logo and signature files in S3
        $logoPath = $request->file('logo')->store('certificates/logos', 's3');
        $signaturePath = $request->file('signature')->store('certificates/signatures', 's3');


        foreach ($request->input('registrations', []) as $regId) {
            $registration = Registration::find($regId);

            // Ensure the registration exists and has attended status
            if ($registration && $registration->status === 'attended' && !$registration->certificate) {
                // Create the certificate
                Certificate::create([
                    'registrationId' => $registration->regId,
                    'oppTitle' => $registration->opportunity->oppTitle,
                    'vName' => $registration->volunteer->vName,
                    'oppLocation' => $registration->opportunity->oppLocation,
                    'oppDate' => $registration->opportunity->oppDate,
                    'logo' => $logoPath,
                    'signature' => $signaturePath,
                    'signerName' => $request->signerName,
                    'signerPosition' => $request->signerPosition,
                ]);
            }
        }

        return redirect()->route('certificates.volunteers', $registration->opportunity)
                        ->with('success', 'Certificates generated successfully for selected volunteers.');
    }

    public function showVolunteers(Opportunity $opportunity)
    {
        // Load registrations with status 'attended' and without an existing certificate
        $registrations = $opportunity->registrations()
            ->where('status', 'attended')
            ->whereDoesntHave('certificate')
            ->with('volunteer')
            ->get();

        return view('certificates.volunteer_list', compact('opportunity', 'registrations'));
    }

    public function viewCertificates()
    {
        $volunteer = auth()->user();

        // Fetch certificates for the authenticated volunteer
        $certificates = Certificate::whereHas('registration', function ($query) use ($volunteer) {
            $query->where('vId', $volunteer->vId);
        })->get();

        return view('certificates.view', compact('certificates'));
    }

    public function showCertificate($certificateId)
    {
        $certificate = Certificate::findOrFail($certificateId);

        // Check if the authenticated user is the owner of the certificate
        if (auth()->user()->vId !== $certificate->registration->vId) {
            return redirect()->route('volunteer.certificates')->with('error', 'You do not have permission to view this certificate.');
        }

        return view('certificates.show', compact('certificate'));
    }

    public function showBulkCertificateForm(Request $request)
    {
        // Fetch registrations based on selected registration IDs
        $registrationIds = $request->input('registrations', []);

        // Ensure only attended registrations without certificates are selected
        $registrations = Registration::whereIn('regId', $registrationIds)
            ->where('status', 'attended')
            ->whereDoesntHave('certificate')
            ->with('volunteer')
            ->get();

        if ($registrations->isEmpty()) {
            return redirect()->back()->with('error', 'No valid registrations selected.');
        }

        return view('certificates.certificate_form', compact('registrations'));
    }

}
