<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\ClearanceData;
use App\Models\ClearancePoint;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard'); // Adjust the view name as needed
    }

    public function showDepartmentForm()
    {
        $programmes = Programme::all();
        return view('student.department')->with('programmes', $programmes);
    }

    public function clearancePhases()
    {
        $programmes = Programme::all();
        return view('student.clearance-phase')->with('programmes', $programmes);
    }

    public function submitDepartmentData(Request $request)
{
    // Validate the form data
    $request->validate([
        'registration_number' => 'required|string',
        'name_of_student' => 'required|string',
        'programme' => 'required|string|exists:programmes,slug',
    ]);

    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the Department phase dynamically from the Unit model
    $departmentUnitId = Unit::where('name', 'Department')->value('id');

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $departmentUnitId,
    ]);

    // Create or update an entry in the ClearanceData table
    ClearanceData::updateOrCreate(
        ['user_id' => $userId],
        [
            'registration_number' => $request->input('registration_number'),
            'name_of_student' => $request->input('name_of_student'),
            'programme' => $request->input('programme'),
        ]
    );

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Department data submitted successfully!');
}


public function submitLibraryData(Request $request)
{
    // Validate the form data
    $request->validate([
        'library_card_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the Library phase (adjust this based on your database)
    $libraryUnitId = 2; // Change this based on the actual ID in your units table

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $libraryUnitId,
    ]);

    // Create or update an entry in the ClearanceData table
    ClearanceData::updateOrCreate(
        ['user_id' => $userId],
        [
            'library_card_image' => $request->file('library_card_image')->store('library_images', 'public'),
            // Add other fields as needed for the Library phase
        ]
    );

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Library data submitted successfully!');
}

public function submitICTCenterData(Request $request)
{
    // Validate the form data
    $request->validate([
        'id_card_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the ICT Center phase (adjust this based on your database)
    $ictCenterUnitId = 3; // Change this based on the actual ID in your units table

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $ictCenterUnitId,
    ]);

    // Create or update an entry in the ClearanceData table
    ClearanceData::updateOrCreate(
        ['user_id' => $userId],
        [
            'id_card_image' => $request->file('id_card_image')->store('id_card_images', 'public'),
            // Add other fields as needed for the ICT Center phase
        ]
    );

    // Redirect back with a success message
    return redirect()->back()->with('success', 'ICT Center data submitted successfully!');
}

public function submitGuidanceData(Request $request)
{
    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the Guidance and Counselling phase (adjust this based on your database)
    $guidanceUnitId = 4; // Change this based on the actual ID in your units table

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $guidanceUnitId,
    ]);

    // Create or update an entry in the ClearanceData table
    ClearanceData::updateOrCreate(
        ['user_id' => $userId],
        [
            // No data needed for Guidance and Counselling phase
        ]
    );

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Guidance and Counselling data submitted successfully!');
}

public function submitStudentAffairsData(Request $request)
{
    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the Student Affairs phase (adjust this based on your database)
    $studentAffairsUnitId = 5; // Change this based on the actual ID in your units table

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $studentAffairsUnitId,
    ]);

    // Create or update an entry in the ClearanceData table
    ClearanceData::updateOrCreate(
        ['user_id' => $userId],
        [
            'convocation_fee_rrr' => $request->input('convocation_fee_rrr'),
        ]
    );

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Student Affairs data submitted successfully!');
}

public function submitBursaryData(Request $request)
{
    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the Bursary phase (adjust this based on your database)
    $bursaryUnitId = 6; // Change this based on the actual ID in your units table

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $bursaryUnitId,
    ]);

    // Create or update an entry in the ClearanceData table
    ClearanceData::updateOrCreate(
        ['user_id' => $userId],
        [
            'first_year_school_fees_image' => $request->file('first_year_school_fees_image')->store('school_fees_images', 'public'),
            'second_year_school_fees_image' => $request->file('second_year_school_fees_image')->store('school_fees_images', 'public'),
        ]
    );

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Bursary data submitted successfully!');
}

public function requestResult()
{
    // Retrieve the user ID of the authenticated student
    $userId = auth()->user()->id;

    // Retrieve the unit ID for the Records phase (adjust this based on your database)
    $recordsUnitId = 7; // Change this based on the actual ID in your units table

    // Create an entry in the ClearancePoint table
    $clearancePoint = ClearancePoint::create([
        'user_id' => $userId,
        'unit_id' => $recordsUnitId,
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Request for Result submitted successfully!');
}

public function allSubmittedData($user_id)
{
    // Fetch the specific unit data for the given user
    $clearanceData = ClearanceData::where('user_id', $user_id)->first();

    // Based on the unit_id, display the relevant data
    $unitSpecificData = [
        'registration_number' => $clearanceData ? $clearanceData->registration_number : null,
        'name_of_student' => $clearanceData ? $clearanceData->name_of_student : null,
        'programme' => $clearanceData ? $clearanceData->programme : null,
        'library_card_image' => $clearanceData ? $clearanceData->library_card_image : null,
        'id_card_image' => $clearanceData ? $clearanceData->id_card_image : null,
        'convocation_fee_rrr' => $clearanceData ? $clearanceData->convocation_fee_rrr : null,
        'first_year_school_fees_image' => $clearanceData ? $clearanceData->first_year_school_fees_image : null,
        'second_year_school_fees_image' => $clearanceData ? $clearanceData->second_year_school_fees_image : null,
    ];

    return view('student.view-data', ['unitSpecificData' => $unitSpecificData]);
}

public function viewHistory($status)
{
    // Fetch clearance history for the logged-in student based on the provided status
    $clearanceHistory = ClearancePoint::where('user_id', auth()->user()->id)
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

    return view('student.clearance-history', [
        'clearanceHistory' => $clearanceHistory,
        'studentNames' => $studentNames,
        'registrationNumbers' => $registrationNumbers,
        'departments' => $departments,
        'rejectionComments' => $rejectionComments, // Add rejection comments to the view data
        'status' => $status,
    ]);
}


}
