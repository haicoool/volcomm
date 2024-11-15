<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        // Ensure the user is authenticated
        $volunteer = Auth::user();
        $interests = !empty($volunteer->interest) ? json_decode($volunteer->interest, true) : [];

        // Fetch opportunities based on user interests or all if no interests or 'all' is specified
        $opportunities = Opportunity::when($request->filter && $request->filter == 'interests' && $interests, function ($query) use ($interests) {
            return $query->whereIn('category', $interests);
        })
        ->when($request->search, function ($query) use ($request) {
            return $query->where('oppTitle', 'like', '%' . $request->search . '%');
        })
        ->paginate(3); // Paginate results if necessary

        // Pass the opportunities to the view
        return view('volunteer.dashboard', compact('opportunities'));
    }


    public function show($id)
    {
        // Fetch the opportunity or fail
        $opportunity = Opportunity::findOrFail($id);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('volunteer.login')->with('error', 'Please login to continue.');
        }

        // Get the authenticated user (volunteer)
        $volunteer = Auth::user();

        // Decode the qualifications array (assuming it's stored as JSON or an array in vQualification)
        $qualifications = !empty($volunteer->vQualification) ? json_decode($volunteer->vQualification, true) : [];

        // Pass both the opportunity and qualifications to the view
        return view('opportunities.show', [
            'opportunity' => $opportunity,
            'qualifications' => $qualifications, // Pass qualifications to the view
        ]);
    }


    public function manage($id)
    {
        // Fetch the opportunity by its id
        $opportunity = Opportunity::findOrFail($id);

        // Get the list of volunteers registered for the opportunity (assuming you have a relationship)
        $volunteers = $opportunity->volunteers; // adjust this based on your actual relationship setup

        // Return the manage view with the opportunity and its volunteers
        return view('opportunities.manage', compact('opportunity', 'volunteers'));
    }

    public function destroy($id)
    {
        // Find the opportunity by its id
        $opportunity = Opportunity::findOrFail($id);

        // Delete the opportunity
        $opportunity->delete();

        // Optionally, add a flash message to confirm the deletion
        return redirect()->route('organization.dashboard')->with('success', 'Opportunity deleted successfully.');
    }

    public function edit($id)
    {
        // Fetch the opportunity by its id
        $opportunity = Opportunity::findOrFail($id);

        // Return the edit view with the opportunity data
        return view('opportunities.edit', compact('opportunity'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
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
            $imagePath = $request->file('oppImage')->store('opportunities', 'public');
        } else {
            $imagePath = null;
        }

        // Find the opportunity by its id
        $opportunity = Opportunity::findOrFail($id);

        // Update the opportunity in the database
        $opportunity->update([
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
        return redirect()->route('opportunities.manage', ['id' => $opportunity->oppId])->with('success', 'Opportunity updated successfully!');
    }



}
