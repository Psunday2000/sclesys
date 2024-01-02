<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
// User login
//     public function login(Request $request)
// {
//     // Implement your login logic here
//     // Example: Authenticate user and redirect to appropriate dashboard

//     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//         // Authentication successful

//         // Check user role and redirect accordingly
//         $user = Auth::user();

//         if ($user->role->name === 'Admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($user->role->name === 'Student') {
//             return redirect()->route('student.dashboard');
//         } elseif ($user->role->name === 'Staff') {
//             return redirect()->route('phases.dashboard');
//         } elseif ($user->role->name === 'Super Admin') {
//             return redirect()->route('admin.super_dashboard');
//         } else {
//             // Handle other roles as needed
//             return redirect()->route('login')->with('error', 'Invalid role');
//         }
//     }

//     // Authentication failed
//     return redirect()->route('login')->with('error', 'Invalid credentials');
// }
    // View users (admin)
    public function viewUsers()
    {
        $staffUsers = User::where('role_id', 2)->get(); 
        $studentUsers = User::where('role_id', 3)->get(); 
        $adminUsers = User::where('role_id', 4)->get(); 

    return view('admin.view_users', [
        'staffUsers' => $staffUsers,
        'studentUsers' => $studentUsers,
        'adminUsers' => $adminUsers,
    ]);
    }

    // Manage users (admin)
    public function manageUsers()
    {
        // Implement logic to manage users
        // Example: return view('admin.manage_users');

        return view('admin.manage_users');
    }

    // Edit user details (any user)
    public function editUserDetails($userId)
    {
        // Implement logic to retrieve and edit user details
        // Example: $user = User::find($userId);

        return view('edit_user_details', ['user' => $user]);
    }

    // Reset password (any user)
    public function resetPassword($token)
    {
        // Implement logic for password reset
        // Example: return view('reset_password', ['token' => $token]);

        return view('reset_password', ['token' => $token]);
    }
}
