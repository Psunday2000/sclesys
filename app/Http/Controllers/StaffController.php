<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ClearanceData;
use App\Models\ClearancePoint;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard'); // Adjust the view name as needed
    }
    public function showAddStudent()
{
    $roles = Role::all();
    
    // Get the logged-in staff user
    $staffUser = auth()->user();

    // Check if the staff user has a department
    if ($staffUser->department) {
        // If the staff user has a department, only include that department in the view
        $departments = collect([$staffUser->department]);
    } else {
        // If the staff user does not have a department, include all departments
        $departments = Department::all();
    }

    return view('staff.add-student', ['roles' => $roles, 'departments' => $departments]);
}


    public function addStudent(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'role_id' => [
            'required',
            'exists:roles,id',
        ],
        'department_id' => 'required|exists:departments,id',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    // Create the new student
    User::create([
        'name' => $request->input('name'),
        'role_id' => $request->input('role_id'),
        'department_id' => $request->input('department_id'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    return redirect()->route('staff.add-student')->with('success', 'Student added successfully!');
}

public function viewStudents()
{
    // Get the authenticated user's department_id
    $userDepartmentId = Auth::user()->department_id;

    // Get students from the same department with role_id = 4
    $students = User::where('department_id', $userDepartmentId)
        ->where('role_id', 4)
        ->get();

    return view('staff.view-students', compact('students'));
}

    // private function getUsersByRole($role)
    // {
    //     return User::whereHas('role', function ($query) use ($role) {
    //         $query->where('name', $role);
    //     })->get();
    // }

    public function editStudent($id)
    {
        // Fetch the user based on the ID
        $user = User::findOrFail($id);
        $roles = Role::all();
        $departments = Department::all();

        return view('staff.edit-student', compact('user', 'roles', 'departments'));
    }

    public function updateEditedStudent(Request $request, $id)
    {
        // Fetch the user based on the ID
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Update the user details
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('staff.edit-student', ['id' => $user->id])
            ->with('success', 'Student updated successfully!');
    }

    public function viewClearanceRequests()
{
    // Fetch the current staff's department_id
    $staffDepartmentId = auth()->user()->department_id;

    // Fetch clearance requests for the current staff's department with a status of 'pending' and unit_id = 1
    $clearanceRequests = ClearancePoint::whereIn('user_id', function ($query) use ($staffDepartmentId) {
        // Subquery to get user_ids of students in the same department
        $query->select('id')
              ->from('users')
              ->where('department_id', $staffDepartmentId);
    })
    ->where('status', 'pending')
    ->where('unit_id', 1) // Additional condition for unit_id
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

    return view('staff.clearance-requests', [
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

    return view('staff.view-data', ['unitSpecificData' => $unitSpecificData]);
}

public function approveClearance($id)
{
    // Fetch the specific clearance request
    $clearanceRequest = ClearancePoint::findOrFail($id);

    // Get the department id of the staff clearing the student
    $clearanceOfficerDepartmentId = auth()->user()->department_id;

    // Fetch the department id associated with the student's user_id
    $studentDepartmentId = User::find($clearanceRequest->user_id)->department_id;

    // Check if the department id of the staff is not the same as the student's department id
    if ($clearanceOfficerDepartmentId != $studentDepartmentId) {
        // Unauthorized access, handle accordingly (redirect, throw exception, etc.)
        abort(403, 'Unauthorized access');
    }

    // Update the status and date_cleared in the clearance_points table
    $clearanceRequest->update([
        'status' => 'approved',
        'date_cleared' => now(),
        'cleared_by' => auth()->user()->id,
    ]);

    // Fetch the student name
    $studentName = User::find($clearanceRequest->user_id)->name;

    // Redirect back with success message
    return redirect()->back()->with('success', "$studentName's request has been approved successfully");
}


public function showRejectionForm($id)
{
    // Find the clearance request by ID
    $clearanceRequest = ClearancePoint::findOrFail($id);

    return view('staff.reject-clearance', compact('clearanceRequest'));
}

public function submitRejection(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Fetch the specific clearance request
    $clearanceRequest = ClearancePoint::findOrFail($id);

    // Get the department id of the staff clearing the student
    $clearanceOfficerDepartmentId = auth()->user()->department_id;

    // Fetch the department id associated with the student's user_id
    $studentDepartmentId = User::find($clearanceRequest->user_id)->department_id;

    // Check if the department id of the staff is not the same as the student's department id
    if ($clearanceOfficerDepartmentId != $studentDepartmentId) {
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
    // Fetch the department id of the staff
    $staffDepartmentId = auth()->user()->department_id;

    // Fetch clearance history for the staff's department based on the provided status
    $clearanceHistory = ClearancePoint::where('cleared_by', auth()->user()->id)
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

    return view('staff.clearance-history', [
        'clearanceHistory' => $clearanceHistory,
        'studentNames' => $studentNames,
        'registrationNumbers' => $registrationNumbers,
        'departments' => $departments,
        'rejectionComments' => $rejectionComments, // Add rejection comments to the view data
        'status' => $status,
    ]);
}
}
