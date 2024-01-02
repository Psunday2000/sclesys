<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use Illuminate\Http\Request;

// class LoginController extends Controller
// {
//     protected function authenticated(Request $request, $user)
//     {
//         // Determine the dashboard route based on the user's role
//         switch ($user->role_id) {
//             case 1:
//                 return redirect()->route('superadmin.dashboard');
//             case 2:
//                 return redirect()->route('admin.dashboard');
//             case 3:
//                 return redirect()->route('staff.dashboard');
//             case 4:
//                 return redirect()->route('student.dashboard');
//             // Add more cases as needed for other roles
//             default:
//                 return redirect()->intended($this->redirectPath());
//         }
//     }
// }
