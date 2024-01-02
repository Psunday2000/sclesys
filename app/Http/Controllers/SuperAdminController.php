<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard'); // Adjust the view name as needed
    }

    public function showAddUser()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view ('superadmin.add-user', ['roles' => $roles, 'departments'=>$departments]);
    }

    public function showViewUsers()
    {
        $roles = Role::all();
        $users = User::all();
        $departments = Department::all();
        return view ('superadmin.view-users', ['users' => $users, 'roles' => $roles, 'departments'=>$departments]);
    }

    public function addUser(Request $request)
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

    // Create the new user
    User::create([
        'name' => $request->input('name'),
        'role_id' => $request->input('role_id'),
        'department_id' => $request->input('department_id'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    return redirect()->route('superadmin.add-user')->with('success', 'User added successfully!');
}

    public function viewStudents()
    {
        $students = $this->getUsersByRole('Student');
        return view('superadmin.view-students', compact('students'));
    }

    public function viewStaff()
    {
        $staff = $this->getUsersByRole('Staff');

        return view('superadmin.view-staff', compact('staff'));
    }


    public function viewAdmins()
    {
        $admins = $this->getUsersByRole('Admin');

        return view('superadmin.view-admins', compact('admins'));
    }


    private function getUsersByRole($role)
    {
        return User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role);
        })->get();
    }

    public function editUser($id)
    {
        // Fetch the user based on the ID
        $user = User::findOrFail($id);
        $roles = Role::all();
        $departments = Department::all();

        return view('superadmin.edit-user', compact('user', 'roles', 'departments'));
    }

    public function updateEditedUser(Request $request, $id)
    {
        // Fetch the user based on the ID
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Update the user details
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('superadmin.edit-user', ['id' => $user->id])
            ->with('success', 'User updated successfully!');
    }

}
