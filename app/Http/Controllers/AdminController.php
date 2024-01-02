<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ClearanceData;
use App\Models\ClearancePoint;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Adjust the view name as needed
    }
    public function viewClearanceRequests()
{
    // Fetch the current admin's unit_id from the units table
    $unitId = Unit::where('clearance_officer', auth()->user()->id)->value('id');

    // Fetch clearance requests for the current admin's unit with a status of 'pending'
    $clearanceRequests = ClearancePoint::where('unit_id', $unitId)
        ->where('status', 'pending')
        ->get();

    // Fetch student names
    $studentNames = User::whereIn('id', $clearanceRequests->pluck('user_id'))->pluck('name', 'id');

    // Fetch registration numbers from clearance_data table
    $registrationNumbers = ClearanceData::whereIn('user_id', $clearanceRequests->pluck('user_id'))
        ->pluck('registration_number', 'user_id');

    // Fetch department information from users table
    $departments = User::whereIn('users.id', $clearanceRequests->pluck('user_id'))
    ->join('departments', 'users.department_id', '=', 'departments.id')
    ->pluck('departments.name', 'users.id');

    return view('admin.clearance-requests', [
        'clearanceRequests' => $clearanceRequests,
        'studentNames' => $studentNames,
        'registrationNumbers' => $registrationNumbers,
        'departments' => $departments,
    ]);
}

public function viewData($user_id, $unit_id)
{
    // Fetch the specific unit data for the given user
    $clearanceData = ClearanceData::where('user_id', $user_id)->first();

    // Based on the unit_id, display the relevant data
    $unitSpecificData = [];

    if ($unit_id == 1) {
        // Department-specific data
        $unitSpecificData = [
            'registration_number' => $clearanceData ? $clearanceData->registration_number : null,
            'name_of_student' => $clearanceData ? $clearanceData->name_of_student : null,
            'programme' => $clearanceData ? $clearanceData->programme : null,
        ];
    } elseif ($unit_id == 2) {
        // Library-specific data
        $unitSpecificData = [
            'library_card_image' => $clearanceData ? $clearanceData->library_card_image : null,
        ];
    } elseif ($unit_id == 3) {
        // ICT Center-specific data
        $unitSpecificData = [
            'id_card_image' => $clearanceData ? $clearanceData->id_card_image : null,
        ];
    } elseif ($unit_id == 5) {
        // Student Affairs-specific data
        $unitSpecificData = [
            'convocation_fee_rrr' => $clearanceData ? $clearanceData->convocation_fee_rrr : null,
        ];
    } elseif ($unit_id == 6) {
        // Bursary-specific data
        $unitSpecificData = [
            'first_year_school_fees_image' => $clearanceData ? $clearanceData->first_year_school_fees_image : null,
            'second_year_school_fees_image' => $clearanceData ? $clearanceData->second_year_school_fees_image : null,
        ];
    }

    return view('admin.view-data', ['unitSpecificData' => $unitSpecificData]);
}

public function approveClearance($id)
{
    // Find the clearance request by ID
    $clearanceRequest = ClearancePoint::findOrFail($id);

    // Fetch the unit_id of the authenticated clearance officer
    $clearanceOfficerUnitId = Unit::where('clearance_officer', auth()->user()->id)->value('id');

    // Check if the unit_id of the clearance request matches the clearance officer's unit_id
    if ($clearanceRequest->unit_id != $clearanceOfficerUnitId) {
        // Unauthorized access, handle accordingly (redirect, throw exception, etc.)
        abort(403, 'Unauthorized access');
    }

    // Update the status, cleared_by, and date_cleared in the clearance_points table
    DB::transaction(function () use ($clearanceRequest) {
        $clearanceRequest->update([
            'status' => 'approved',
            'cleared_by' => auth()->user()->id,
            'date_cleared' => Carbon::now(),
        ]);
    });

    // Fetch the student name
    $studentName = User::find($clearanceRequest->user_id)->name;

    // Redirect back with success message
    return redirect()->back()->with('success', "$studentName's request has been approved successfully");
}

public function showRejectionForm($id)
{
    // Find the clearance request by ID
    $clearanceRequest = ClearancePoint::findOrFail($id);

    return view('admin.reject-clearance', compact('clearanceRequest'));
}

public function submitRejection(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Find the clearance request by ID
    $clearanceRequest = ClearancePoint::findOrFail($id);

    // Fetch the unit_id of the authenticated clearance officer
    $clearanceOfficerUnitId = Unit::where('clearance_officer', auth()->user()->id)->value('id');

    // Check if the unit_id of the clearance request matches the clearance officer's unit_id
    if ($clearanceRequest->unit_id != $clearanceOfficerUnitId) {
        // Unauthorized access, handle accordingly (redirect, throw exception, etc.)
        abort(403, 'Unauthorized access');
    }

    // Update the status, comment, date_cleared, and cleared_by in the clearance_points table
    DB::transaction(function () use ($clearanceRequest, $request) {
        $clearanceRequest->update([
            'status' => 'rejected',
            'comment' => $request->input('comment'),
            'date_cleared' => Carbon::now(),
            'cleared_by' => auth()->user()->id,
        ]);
    });

    // Fetch the student name
    $studentName = User::find($clearanceRequest->user_id)->name;

    // Redirect back with success message
    return redirect()->back()->with('success', "$studentName's request has been rejected successfully");
}
public function viewHistory($status)
{
    // Fetch the current admin's unit_id from the units table
    $unitId = Unit::where('clearance_officer', auth()->user()->id)->value('id');

    // Fetch clearance history for the current admin's unit based on the provided status
    $clearanceHistory = ClearancePoint::where('unit_id', $unitId)
        ->where('cleared_by', auth()->user()->id) // Add this line to filter by the clearing admin
        ->where('status', $status)
        ->orderBy('date_cleared', 'desc')
        ->get();

    // Fetch student names
    $studentNames = User::whereIn('id', $clearanceHistory->pluck('user_id'))->pluck('name', 'id');

    // Fetch registration numbers from clearance_data table
    $registrationNumbers = ClearanceData::whereIn('user_id', $clearanceHistory->pluck('user_id'))
        ->pluck('registration_number', 'user_id');

    // Fetch department information from users table
    $departments = User::whereIn('users.id', $clearanceHistory->pluck('user_id'))
        ->join('departments', 'users.department_id', '=', 'departments.id')
        ->pluck('departments.name', 'users.id');

    // Fetch rejection comments from the clearance history
    $rejectionComments = $clearanceHistory->pluck('comment', 'id');

    return view('admin.clearance-history', [
        'clearanceHistory' => $clearanceHistory,
        'studentNames' => $studentNames,
        'registrationNumbers' => $registrationNumbers,
        'departments' => $departments,
        'rejectionComments' => $rejectionComments, // Add rejection comments to the view data
        'status' => $status,
    ]);
}


}
